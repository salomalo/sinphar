<?php
/*
 * Service class to handle Mailchimp operations
 *
 *
 */
class RM_NLetter_Service {
    
    public $nletter_active= false;
     
    public function __construct() {
      $this->nletter_active= rm_is_nletter_active();
    }
    /*
     * list all the mailing lists
     */
    public function get_list($dropdown= false) {
        global $wpdb;
        $lists= array(""=> "Select List");
        $profile = get_option('newsletter_profile');
        
        // Newsletter list limit is 20
        if(!defined('NEWSLETTER_PROFILE_MAX'))
            return array();
        
        for($i=1;$i<NEWSLETTER_PROFILE_MAX+1 ;$i++)
        {
            if(isset($profile['list_'.$i]) && !empty($profile['list_'.$i]))
            {
                $lists[$i]= $profile['list_'.$i];
            }
        }
 
        if($dropdown)
        {   $list_dropdown= array();
            foreach($lists as $key=>$value){
                $list_dropdown[$key]= $value;
            } 
            return $list_dropdown;
        }
        return $lists;
               
    }

    public function subscribe($data,$list_id)
     {
        if(empty($data['email']))
            return;
           
        if(!class_exists('NewsletterSubscription') && !method_exists('NewsletterSubscription', 'subscribe'))
            return;
        
        $newsletter_subscription=  new NewsletterSubscription();
        // Inserting email and list IDs for newsletter subscription
        $_REQUEST['ne']= $data['email'];
        $_REQUEST['nl']= array($list_id);
        $_REQUEST['nn']= isset($data['nn'])? $data['nn']: '';
        $_REQUEST['ns']= isset($data['ns'])? $data['ns']: '';
        $_REQUEST['nx']= isset($data['nx'])? $data['nx']: '';
        for($i=1;$i<NEWSLETTER_PROFILE_MAX+1 ;$i++)
        {
                $_REQUEST['np' . $i]= '';
        }
        $_REQUEST['np']= ''; // Left blank intentionally to avoid warning.    
        $newsletter_subscription->subscribe();
        
     }
     
     public function get_lists_by_form_id($form_id)
     {
        $form= $this->get_form($form_id);
        $lists= array();
        if(!empty($form))
        {
            // decode form data
            $data = unserialize(base64_decode($form['data']));
            $lists= $data['settings']['lists'];
            if(is_array($lists))
                return $lists;
        }
        return $lists;
     }
     
     public function get_supported_rm_fields($form,$type,$dropdown=false)
     {
         $form_service= new RM_Services();
         $form_fields = $form_service->get_all_form_fields($form);
         
         $fields= array();
         if($dropdown):
            $fields[""]= "Select a Field";  
           
            foreach($form_fields as $form_field)
            {   
                $insert_field= false;
                
                if($type=="nn" && in_array(strtolower($form_field->field_type),array('textbox','nickname','fname')))
                {
                    $insert_field= true;
                }
                
                else if($type=="ns" && in_array(strtolower($form_field->field_type),array('textbox','nickname','lname')))
                {
                    $insert_field= true;
                }
                
                else if($type=="nx" && in_array(strtolower($form_field->field_type),array('radio','select','gender')))
                {
                    $insert_field= true;
                }
                
                if($insert_field)
                    $fields[$form_field->field_type.'_'.$form_field->field_id]= $form_field->field_label;
            }

            return $fields;
         endif;
         return $form_fields;
     }
     
     public function map_fields($request)
     {
         $data= array();
         $enable_newsletter= isset($request['enable_newsletter']) ? (int) $request['enable_newsletter'] : null;
         $newsletter_list_id= isset($request['newsletter_list_id']) ? (int) $request['newsletter_list_id'] : null;
         if(empty($newsletter_list_id) && empty($enable_newsletter))
             return null;
        
         $newsletter_f_fields= $this->get_default_fields($newsletter_list_id);
         if(count($newsletter_f_fields))
         {
             foreach($newsletter_f_fields as $key=>$value)
             {
                 $data[$key]= isset($request[$key]) ? $request[$key] : null;
             }
             
         }
         return $data;
     }
     
     /*
     * Get default fields
     */
    public function get_default_fields($request)
    {
        $data= array();
        $data['nn']= isset($request['nn']) ? $request['nn']: '';
        $data['ns']= isset($request['ns']) ? $request['ns']: '';
        $data['nx']= isset($request['nx']) ? $request['nx']: '';
        return $data;
    }
}