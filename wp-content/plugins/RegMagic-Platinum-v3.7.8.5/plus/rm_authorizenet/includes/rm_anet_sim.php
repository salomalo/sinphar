<?php
/*
 * Class to handle Server Integration Method (SIM) payemtn
 */
class RM_Anet_Sim
{
     protected $msg = array();
     private $rm_anet;
     private $live_url;
     private $test_url;
     
     public function __construct(){
         $this->rm_anet= rm_anet();
         $this->live_url          = 'https://secure2.authorize.net/gateway/transact.dll';
         $this->test_url          = 'https://test.authorize.net/gateway/transact.dll';
     }
      
     /**
       * Check for valid Authorize.net server callback to validate the transaction response.
      **/
      function check_authorize_response()
      { 
        $options= new RM_Anet_Options();
        $login_id= $options->get_value_of('anet_login_id'); 
      //  echo $_SERVER['REQUEST_URI'];
        //print_r($_REQUEST); die;
         if (count($_POST)){
            $redirect_url = '';
            if(!isset($_POST['x_invoice_num']) || !isset($_GET['log_id']))
                return;
            
            $log_id= $_GET['log_id'];
            $x_invoice_num = $_POST['x_invoice_num'];
            $log = RM_DBManager::get_row('PAYPAL_LOGS', $log_id);
            if($log->invoice!=$x_invoice_num || empty($log))
                             return;
              
            
            $hash_key = $options->get_value_of('anet_hash_key');
            $ex_data = maybe_unserialize($log->ex_data);
            $user_id = (int)$ex_data['user_id'];
            $form_id = $log->form_id;
            $form = new RM_Forms;
            $form->load_from_db($form_id);
                   
            if ( $_POST['x_response_code'] != '' &&  ($_POST['x_MD5_Hash'] ==  strtoupper(md5( $hash_key . $login_id . $_POST['x_trans_id'] .  $_POST['x_amount']))) ){               
                  $amount           = $_POST['x_amount'];
                  $hash             = $_POST['x_MD5_Hash'];
                  
                  $curr_date = RM_Utilities::get_current_time(); // date_i18n(get_option('date_format'));
                  $_POST['first_name'] = $_POST['x_first_name'];
                  $_POST['last_name'] =  $_POST['x_last_name'];
                  $_POST['payer_email']= $_POST['x_email'];
                  $log_array = maybe_serialize($_POST);
                
                  $status= '';
                     if ( $_POST['x_response_code'] == 1 ){ 
                        $status= 'completed';
                           if($form->form_options->user_auto_approval == 'default')
                            {
                               $check_setting = $options->get_value_of('user_auto_approval');
                            }
                            else
                            {
                                $check_setting = $form->form_options->user_auto_approval;
                            }
                            if ($user_id && $check_setting == "yes")
                            {   
                                $user_service = new RM_User_Services();
                                $user_service->activate_user_by_id($user_id);                                    
                            } 
                    
                     }
                  else{
                        $status= "pending";
                  }
                  
                  RM_DBManager::update_row('PAYPAL_LOGS', $log_id, array(
                  'status' => $status,
                  'txn_id' => $_REQUEST['x_trans_id'],
                  'posted_date' => $curr_date,  
                  'log' => $log_array), array('%s', '%s', '%s', '%s'));
                  
                  $page_url= empty($_REQUEST['p'])? home_url('/').'wp-admin/admin-ajax.php?action=registrationmagic_embedform&form_id='.$form_id :  get_permalink($_REQUEST['p']);
                  $page_url= add_query_arg(array("anet"=>1,"log_id"=>$log_id,"hash"=>$_POST['x_MD5_Hash']), $page_url);
                  $redirect_url= add_query_arg(array("anet"=>1,"log_id"=>$log_id,"hash"=>$_POST['x_MD5_Hash']), $page_url);
                  echo '<script>window.location = "'. $redirect_url.'";</script>';
                

            }
            exit;
         }
         
      }
      
      
     
      /**
      * Generate authorize.net button link
      **/
      private function generate_authorize_form($data)
      {
         global $wp; 
         $options= new RM_Anet_Options();
         $p= get_the_ID();
         
         // Insert log
          $curr_date = RM_Utilities::get_current_time(); //date_i18n(get_option('date_format'));
          $total_amount= $data->pricing_details->total_price;
          $ex_data['user_id'] = isset($data->user_id) ? $data->user_id : null;
          if ($total_amount <= 0.0)
          {
                $log_entry_id = RM_DBManager::insert_row('PAYPAL_LOGS', array('submission_id' => $data->submission_id,
                            'form_id' => $data->form_id,
                            'invoice' => $data->order_id,
                            'status' => 'Completed',
                            'total_amount' => $total_amount,
                            'currency' => $data->currency,
                            'posted_date' => $curr_date,
                            'pay_proc' => 'anet_sim',
                            'bill' => maybe_serialize($data->pricing_details),
                            'ex_data' => maybe_serialize($ex_data)),
                             array('%d', '%d', '%s', '%s', '%f', '%s', '%s', '%s', '%s','%s'));
                
                return true;
           } else
            {
                $log_entry_id = RM_DBManager::insert_row('PAYPAL_LOGS', array('submission_id' => $data->submission_id,
                            'form_id' => $data->form_id,
                            'invoice' => $data->order_id,
                            'status' => 'Pending',
                            'total_amount' => $total_amount,
                            'currency' => $data->currency,
                            'posted_date' => $curr_date,
                            'pay_proc' => 'anet_sim',
                            'bill' => maybe_serialize($data->pricing_details),
                            'ex_data' => maybe_serialize($ex_data)),
                             array('%d', '%d', '%s', '%s', '%f', '%s', '%s', '%s', '%s','%s'));
            }
            
         $login_id= $options->get_value_of('anet_login_id'); 
         $trans_key= $options->get_value_of('anet_trans_key'); 
         $anet_test_mode= $options->get_value_of('anet_test_mode');
         
         //format URL for authoriznet
         $current_url = rtrim(home_url(add_query_arg(array(),$wp->request)),'/').'/';
         $current_url= add_query_arg(array("submission_id"=>$data->submission_id,"log_id"=>$log_entry_id,
                                     "form_id"=>$data->form_id,"p"=>$p),$current_url );
         $timestamp= time();
         //echo $login_id  . "^".$data->order_id."^". $timestamp . "^" . $data->pricing_details->total_price . "^",$trans_key;
         $fingerprint = hash_hmac("md5", $login_id  . "^".$data->order_id."^". $timestamp . "^" . $data->pricing_details->total_price . "^".$data->currency,$trans_key); 
         $authorize_args = array(
            
            'x_login'                  => $login_id,
            'x_amount'                 => $data->pricing_details->total_price,
            'x_invoice_num'            => $data->order_id,
            'x_relay_response'         => "TRUE",
            'x_fp_hash'                => $fingerprint,
            'x_version'                => '3.1',
            'x_fp_sequence'            => $data->order_id, 
            'x_show_form'              => 'PAYMENT_FORM',
            'x_fp_timestamp'           => $timestamp,
            'x_relay_url'              => $current_url,
            'x_email'                  => $data->user_email,
            'x_currency_code'           => $data->currency, 
            );

         $authorize_args['x_type'] = 'AUTH_CAPTURE';
         if($anet_test_mode=="yes"){
           $processURI = $this->test_url;
           $authorize_args['x_test_request'] = 'TRUE';
         }
         else{
            $processURI = $this->live_url;
            $authorize_args['x_test_request'] = 'FALSE';
         }
         
         $authorize_args_array = array();
         
         foreach($authorize_args as $key => $value){
           $authorize_args_array[] = "<input type='hidden' name='$key' value='$value'/>";
         }
         
     

       //  ob_start();
         $html_form = '<center><h2>Please wait, your order is being processed and you will be redirected to the payment website.</h2></center>';
         $html_form .= '<center><br><br>If you are not automatically redirected to Authorize.Net within 5 seconds...<br><br>';
         $html_form .= '<form target="_parent" action="'.$processURI.'" method="post" id="rm_submit_authorize_payment_form">' 
               . implode('', $authorize_args_array) 
               . '<input type="submit" class="button" onclick="rm_anet_sim_submit()" value="'.__('Click Here').'" />'
               . '<script type="text/javascript">
                   setTimeout(function() { rm_anet_sim_submit(); }, 5000);
                  
                  function rm_anet_sim_submit()
                  {
                    jQuery("#rm_submit_authorize_payment_form").submit();
                  }
               </script>
               </form>';
         
         
       // $html_content = ob_get_contents();
        $data=array();
        $data['html']= $html_form;
        $data['status']='do_not_redirect';
       //  ob_end_clean();
        // echo $html_form;
         return $data;
      }
      
      
      public function process_payment($form, $request, $params)
      { 
        $data= new stdClass();
        if ($form->get_form_type() === RM_REG_FORM)
        $data->user_id = $form->get_registered_user_id();
        $data->user_email= $params['user_email'];
        $data->pricing_details = $form->get_pricing_detail($request->req);
        $options= new RM_Anet_Options();
        $data->currency= $options->get_value_of('currency'); 
        $data->order_id = (string) date("His") . rand(1234, 9632);
        $data->form_name= $form->get_form_name();
        $data->form_id= $params['form_id'];
        $data->submission_id= $params['sub_detail']->submission_id;
            
        return $this->generate_authorize_form($data);
      }
      
   
}
