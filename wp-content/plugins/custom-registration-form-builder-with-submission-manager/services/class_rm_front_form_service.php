<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_rm_services
 *
 * @author CMSHelplive
 */
class RM_Front_Form_Service extends RM_Services {

    private $user_service;

    public function __construct() {
        $this->user_service = new RM_User_Services();
    }

    public function get_user_service() {
        return $this->user_service;
    }

    private function get_user_ip() {
        switch (true) {
            case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
            case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
            case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) :
                //This might include multiple IPs separated with comma, pick last IP in that case.
                $ips = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim(end($ips));
            case (!empty($_SERVER['REMOTE_ADDR'])) : return $_SERVER['REMOTE_ADDR'];
            default : return null;
        }
    }

    public function is_ip_banned() {
        return false;        
    }

    public function is_email_banned($email) {
        return false;
    }

    public function create_stat_entry($params) {

        $form_id = (int) $params['form_id'];
        $visited_on = time();

        $user_ip = $this->get_user_ip();

        if ($user_ip == null)
            die("Unauthorised request. Access denied.");

        if (isset($_SERVER['HTTP_USER_AGENT']))
            $ua_string = $_SERVER['HTTP_USER_AGENT'];
        else
            $ua_string = "no_user_agent_found";

        require_once plugin_dir_path(plugin_dir_path(__FILE__)) . 'external/Browser/Browser.php';

        $browser = new RM_Browser($ua_string);
        $browser_name = $browser->getBrowser();

        return RM_DBManager::insert_row('STATS', array('form_id' => $form_id, 'user_ip' => $user_ip, 'ua_string' => $ua_string, 'browser_name' => $browser_name, 'visited_on' => $visited_on), array('%d', '%s', '%s', '%s'));
    }

    //$op = update => update entry
    //$op = ban => update as banned submission
    //$op = delete =>remove stat entry
    public function update_stat_entry($stat_id, $op = 'update') {
        
        if($stat_id === '__uninit')
            return;
        
        switch ($op) {
            case 'update':
                $submitted_on = time();
                $visited_on = RM_DBManager::get_row('STATS', $stat_id);
                if ($visited_on) {
                    $diff_in_secs = $submitted_on - $visited_on->visited_on;
                    return RM_DBManager::update_row('STATS', $stat_id, array('submitted_on' => $submitted_on, 'time_taken' => $diff_in_secs), array('%s', '%d'));
                } else
                    return false;
                break;

            case 'ban':
                return RM_DBManager::update_row('STATS', $stat_id, array('submitted_on' => 'banned'), array('%s'));
                break;

            case 'delete':
                return RM_DBManager::remove_row('STATS', $stat_id);
                break;

            default:
                return null;
        }
    }

    //Check if the form is being submitted through browser reload feature.
    public function is_browser_reload_duplication($stat_id) {
        //Not browser reload related, but if stat_id is not set then form submission is not valid or
        // it is just form creation, hence prevent submission.
        if ($stat_id === null || $stat_id === '__uninit')
            return true;

        $stat_entry = RM_DBManager::get_row('STATS', $stat_id);

        if ($stat_entry) {
            if ($stat_entry->submitted_on == null)
                return false;
            else
                return true;
        }
        return true; //No entry found in db, prevent submission.
    }

    public function is_off_limit_submission($form_id) {
        $submission_limit_per_ip_per_form = (int) $this->get_setting('sub_limit_antispam');

        if ($submission_limit_per_ip_per_form == 0)
            return false;

        //Calculate starting and ending timestamp for today.
        $N = time();
        $n = 24 * 60 * 60;
        $t = $N % $n;

        $start_ts = $N - $t;
        $end_ts = $start_ts + $n - 1;

        $ip = $this->get_user_ip();
        $res = RM_DBManager::get_generic('STATS', "COUNT(#UID#) AS `count`", "`form_id` = $form_id AND `user_ip` = '$ip' AND `submitted_on` != 'banned' AND `submitted_on` BETWEEN '$start_ts' AND '$end_ts'");

        if (!$res)
            return false;

        // IMP: Do not use '<='. As it counts already done submissions which excludes current submission.
        // If already done submissios are limit-1 then allow this one. Otherwise there will be one extra submission.
        if ((int) $res[0]->count < $submission_limit_per_ip_per_form)
            return false;
        else
            return true;
    }

    public function export_to_external_url($url, $submissions_data) {
        $exporter = new RM_Export_POST($url);
        $exporter->prepare_data($submissions_data);
        $exporter->send_data();
    }

    public function subscribe_to_mailchimp($request, $form_options_mc) {
        if (!isset($form_options_mc->mailchimp_mapped_email))
            return;
        $merge_fields_array = array();


        $list_id = $form_options_mc->mailchimp_list;
        $mailchimp = new RM_MailChimp_Service();
        $details = $mailchimp->get_list_field($list_id);

        if (isset($details['merge_fields'])) {

            foreach ($details['merge_fields'] as $det) {
                $mc_tag = str_replace(' ', '', $det['tag']);
                $mc_list_id_tag = $list_id . '_' . $mc_tag;
                $mc_list_id_tag = str_replace(' ', '', $mc_list_id_tag);
                $field_value = null;
                if (isset($form_options_mc->mailchimp_relations->$mc_list_id_tag)) {

                    $field_tag_id = $form_options_mc->mailchimp_relations->$mc_list_id_tag;

                    if ($det['type'] == 'dropdown' || $det['type'] == 'radio') {

                        foreach ($det['options']['choices'] as $choice) {
                            if (isset($request[$field_tag_id]) && ($choice == $request[$field_tag_id])) {
                                $field_value = $request[$field_tag_id];
                            } else {
                                
                            }
                        }
                    } elseif (isset($request[$field_tag_id])) {
                        if(is_array($request[$field_tag_id]))
                            $field_value = implode(',',$request[$field_tag_id]);
                        else
                            $field_value = $request[$field_tag_id];
                    }

                    $field_value = str_replace(' ', '', $field_value);
                } else
                    $field_value = '';
                if ($field_value != null)
                    $merge_fields_array[$mc_tag] = $field_value;
            }
        }
        
        if(isset($request[$form_options_mc->mailchimp_mapped_email]))
        {
            $email = $request[$form_options_mc->mailchimp_mapped_email];
            $mailchimp->subscribe($merge_fields_array, $email, $list_id);
        }
    }

    public function register_user($username, $email, $password, $is_paid = true,$form_id) {
        $gopt = new RM_Options();

        //No password!! Generate one.
        if (!$password)
            $password = wp_generate_password(8, false, false);

        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            foreach ($user_id as $err) {
                foreach ($err as $error) {
                    echo $error[0];
                    die;
                }
            }
        } else {

            $required_params = new stdClass();
            $required_params->email = $email;
            $required_params->username = $username;
            $required_params->password = $password;
            $required_params->form_id= $form_id;
            if ($this->get_setting('send_password') === 'yes' || $this->get_setting('auto_generated_password') === 'yes') {
                RM_Email_Service::notify_new_user($required_params);
            }


            /*
             * Deactivate the user in case auto approval is off
             */

            $user_approval = $gopt->get_value_of('user_auto_approval');
            if (!$is_paid || $user_approval != "yes") {
                $this->user_service->deactivate_user_by_id($user_id);                                
            }
            else
                $this->user_service->activate_user_by_id($user_id);

            if($user_approval != "yes"){
                $link = $this->user_service->create_user_activation_link($user_id);
                $required_params->link = $link;
                RM_Email_Service::notify_admin_to_activate_user($required_params);
            }
        }

        return $user_id;
    }

    public function save_submission($form_id, $data, $email) {
        $submission_row = array('form_id' => $form_id, 'data' => $data, 'user_email' => $email);
        
        $submissions = new RM_Submissions;
        $submissions->set($submission_row);
        $submission_id = $submissions->insert_into_db();
        

        $submission_field = new RM_Submission_Fields;
        $submission_field_row['submission_id'] = $submission_id;
        $submission_field_row['form_id'] = $form_id;

        foreach ($data as $field_id => $field_data) {
            $submission_field_row['field_id'] = $field_id;
            $submission_field_row['value'] = $field_data->value;

            $submission_field->set($submission_field_row);
            $submission_field->insert_into_db(true);
        }

        return (object) array('submission_id' => $submission_id, 'token' => null);
    }
    
    //Save a edited submission
    public function save_edited_submission($form_id, $submission_id, $newdata, $email) {
        $prev_sub = new RM_Submissions;
        $prev_sub->load_from_db($submission_id);
        $old_data = $prev_sub->get_data();
        
        $submission_field_row = array();     
        
        foreach ($old_data as $field_id => $field_data){
            if(!isset($newdata[$field_id]))
                $newdata[$field_id] = $field_data;
            elseif($newdata[$field_id]->type === 'File' || $newdata[$field_id]->type === 'image'){
                if(!$newdata[$field_id]->value)
                    $newdata[$field_id]->value = $field_data->value;
            }
            
            if(isset($newdata[$field_id])) {
                $sub_field_id = RM_DBManager::get('SUBMISSION_FIELDS',
                                                  array('submission_id' => $submission_id,
                                                        'field_id' => $field_id,
                                                        'form_id' => $form_id),
                                                  array('%d','%d','%d'),'var',0,0,'sub_field_id');
                $submission_field = new RM_Submission_Fields;
                $submission_field_row['field_id'] = $field_id;
                $submission_field_row['value'] = $newdata[$field_id]->value;
                if(!$sub_field_id) {
                    $submission_field_row['submission_id'] = $submission_id;
                    $submission_field_row['form_id'] = $form_id;
                    $submission_field->set($submission_field_row);
                    $submission_field->insert_into_db(true);
                } else {
                    $submission_field->load_from_db($sub_field_id);
                    $submission_field->set($submission_field_row);
                    $submission_field->update_into_db();
                }
            }
        }
                  
        $front_service = new RM_Front_Service;
        $modified_by = $front_service->get_user_email();  
        //$user = 'sds';
        $child_sub = (object) array('submission_id' => $submission_id, 'token' => $prev_sub->get_unique_token());//$this->save_submission($form_id, $newdata, $email, $modified_by, $prev_sub->get_unique_token());
        //$prev_sub->set_child_id($child_sub->submission_id);
        //$prev_sub_last_child = $prev_sub->get_last_child();
        $prev_sub->set_data($newdata);
        //if($prev_sub_last_child != 0)
        //    RM_DBManager::update_submission_group_last_child($prev_sub_last_child, $child_sub->submission_id);
        //    $prev_sub->set_last_child ($child_sub->submission_id);  
        
        $prev_sub->update_into_db();
        
        $child_sub->prev_sub_id = $submission_id;
        return $child_sub;
    }

    //Params is an object containing form_options and form name.
    //Right now this function only redirects, it may have other functionality in future, that is why redirect is just a parameter.
    public function after_submission_proc($params, $prevent_redirection = false) {
        $form_options = $params->form_options;

        $msg_str = $form_options->form_success_message != "" ? $form_options->form_success_message : $params->form_name . " Submitted ";

        if (!$prevent_redirection) {
            if ($form_options->redirection_type) {
                $redir_str = "<br>" . RM_UI_Strings::get("MSG_REDIRECTING_TO") . "<br>";
                //echo "<br>", var_dump(),die;

                if ($form_options->redirection_type === "page") {
                    $page_id = $form_options->redirect_page;
                    $page = get_post($page_id);
                    if($page instanceof WP_Post)
                    {
                        $page_title = $page->post_title? : '#' . $page_id . ' (No title)';
                        $redir_str .= $page_title;
                        RM_Utilities::redirect(null, true, $page_id, true);
                    }
                } else {
                    $url = $form_options->redirect_url;
                    $redir_str .= $url;
                    RM_Utilities::redirect($url, false, 0, true);
                }
                return $msg_str . '<br><br>' . $redir_str;
            }
        }
        return $msg_str;
    }

    public function send_user($email, $username, $password, $content) {
        $send_details = parent::get_setting('send_password');

        //echo $content;
        if ($send_details == "yes") {
            RM_Utilities::send_email($email, $content);
        }
    }

    public function register_user_old($request, $form, $is_auto_generate, $is_paid = true) {
        $gopt = new RM_Options();
        $username = $request->req['username'];

        if ($is_auto_generate !== "yes")
            $password = $request->req['password'];
        else
            $password = wp_generate_password(8, false, false);

        $primary_emails = $this->get_primary_email_fields($form->form_id);

        $request_keys = array_keys($request->req);
        $emails = array_intersect($request_keys, $primary_emails);

        foreach ($emails as $email) {
            $email_field_name = $email;
            break;
        }

        $email = $request->req[$email_field_name];

        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            foreach ($user_id as $err) {
                foreach ($err as $error) {
                    echo $error[0];
                    die;
                }
            }
        } else {
            /*
             * User created. Check if details has to send via an email
             */
            $required_params = new stdClass();
            $required_params->email = $email;
            $required_params->username = $username;
            $required_params->password = $password;

            if ($this->get_setting('send_password') === 'yes' || $this->get_setting('auto_generated_password') === 'yes') {
                RM_Email_Service::notify_new_user($required_params);
            }

            /*
             * Deactivate the user in case auto approval is off
             */


            if (!$is_paid || $gopt->get_value_of('user_auto_approval') != "yes") {

                $this->user_service->deactivate_user_by_id($user_id);
            }

            /*
             * If role is chosen by registrar
             */
            if (isset($request->req['role_as']) && !empty($request->req['role_as'])) {
                $this->user_service->set_user_role($user_id, $request->req['role_as']);
            } else {
                $tmp = $form->get_default_form_user_role();
                if (!empty($tmp)) {
                    /*
                     * Assign user role if configured by default
                     */
                    $this->user_service->set_user_role($user_id, $form->get_default_form_user_role());
                }
            }
        }

        return $user_id;
    }

    public function get_primary_email_fields($form_id) { 
        $primary_fields = RM_DBManager::get_primary_fields_by_type($form_id, 'Email');
        // print_r($primary_fields); die;
        if (is_array($primary_fields['emails']))
            $email_fields = $primary_fields['emails'];
        else
            $email_fields = array();

        return $email_fields;
    }

    public function process_payment($form, $request, $params) {
        if (isset($request->req['rm_payment_method']))
            $payment_method = $request->req['rm_payment_method'];
        else {
            $payment_gateways = $this->get_setting('payment_gateway');

            if (!$payment_gateways || count($payment_gateways) == 0)
                return;

            if (!is_array($payment_gateways))
                $payment_gateways = array($payment_gateways);

            $payment_method = $payment_gateways[0];
        }


        // Paypal handling
        if ($payment_method === "paypal") {
            $paypal_service = new RM_Paypal_Service();
            $pricing_details = $form->get_pricing_detail($request->req);
            $data = new stdClass();
            $data->form_id = $form->get_form_id();
            $data->submission_id = $params['sub_detail']->submission_id;
            if ($form->get_form_type() === RM_REG_FORM)
                $data->user_id = $form->get_registered_user_id();

            return $paypal_service->charge($data, $pricing_details);
        }

        if ($payment_method === "stripe") {
            $stripe_service = new RM_Stripe_Service();
            $pricing_details = $form->get_pricing_detail($request->req);
            $data = new stdClass();
            if (isset($request->req['stripeToken']) && !empty($request->req['stripeToken'])) {
                $data->stripeToken = $request->req['stripeToken'];
                $data->form_id = $form->get_form_id();
                $data->submission_id = $params['sub_detail']->submission_id;
                return $stripe_service->charge($data, $pricing_details);
            }
        }
    }

    public function user_exists($form, $request) {
        $valid = false;
        $primary_emails = $this->get_primary_email_fields($form->get_form_id());


        $form_type = $form->get_form_type();
        //var_dump($form_type == RM_REG_FORM);
        if ($form_type == RM_REG_FORM && isset($request->req['username'])) {
            $username = $request->req['username'];
            $email_field_name = '';

            $user = get_user_by('login', $username);
            if (!empty($user)) {
                //RM_PFBC_Form::setError('form_' . $form->form_id,RM_UI_Strings::get("USERNAME_EXISTS"));
                $valid = true;
            }

            $request_keys = array_keys($request->req);
            $emails = array_intersect($request_keys, $primary_emails);

            foreach ($emails as $e) {
                $email_field_name = $e;
            }

            if (isset($request->req[$email_field_name])) {
                $email = $request->req[$email_field_name];
                $user = get_user_by('email', $email);
                if (!empty($user)) {
                    //RM_PFBC_Form::setError('form_' . $form->form_id,RM_UI_Strings::get("USEREMAIL_EXISTS"));
                    $valid = true;
                }
            }
        }

        return $valid;
    }

    public function update_user_profile($user_id_or_email, array $profile, $is_email = false) {

        
        $return = true;
        
        if (!$is_email) {
            $user_id = $user_id_or_email;
        } else {
             
                $user = get_user_by('email', $user_id_or_email);
                if (!isset($user->ID))
                    return false;
                if ((int) $user->ID)
                    $user_id = $user->ID;
                else
                    return false;
            
        } 
        
        foreach ($profile as $type => $pr) {
            if ($type === 'Fname' || $type === 'Lname' || $type === 'BInfo'|| $type === 'Nickname'|| $type === 'SecEmail'|| $type === 'Website'){
                switch ($type) {
                    case 'Fname' :
                        $return = update_user_meta($user_id, 'first_name', $pr);
                        break;
                    case 'Lname' :
                        $return = update_user_meta($user_id, 'last_name', $pr);
                        break;
                    case 'BInfo' :
                        $return = update_user_meta($user_id, 'description', $pr);
                        break;
                    case 'Nickname' :
                        $return = update_user_meta($user_id, 'nickname', $pr);
                        break;
                    case 'Website' :
                        $return = wp_update_user( array( 'ID' => $user_id, 'user_url' => $pr ) );
                        break;
                }
            }
            else{

              $return  = update_user_meta( $user_id, $type, $pr ); 
            }
        }

        return $return;
    }

    public function set_properties(stdClass $options) {
        $properties = array();
        if (null != $options->field_placeholder)
            $properties['placeholder'] = $options->field_placeholder;
        
            $properties['longDesc'] = isset($options->help_text) ? $options->help_text: '';
        if (null != $options->field_css_class)
            $properties['class'] = $options->field_css_class;
        if (null != $options->field_max_length)
            $properties['maxlength'] = $options->field_max_length;
        if (null != $options->field_textarea_columns)
            $properties['cols'] = $options->field_textarea_columns;
        if (null != $options->field_textarea_rows)
            $properties['rows'] = $options->field_textarea_rows;
        if (null != $options->field_is_required)
            $properties['required'] = $options->field_is_required;
        if (isset($options->field_is_required_scroll) && null != $options->field_is_required_scroll)
            $properties['required_scroll'] = $options->field_is_required_scroll;
        if (isset($options->field_is_show_asterix))
            $properties['show_asterix'] = $options->field_is_show_asterix;
        if (null != $options->field_default_value)
            $properties['value'] = maybe_unserialize($options->field_default_value);
        if (isset($options->field_is_other_option) && null != $options->field_is_other_option)
            $properties['rm_is_other_option'] = $options->field_is_other_option;
        if (isset($options->style_textfield) && null != $options->style_textfield)
            $properties['style'] = $options->style_textfield;
        if (isset($options->style_label) && null != $options->style_label)
            $properties['labelStyle'] = $options->style_label;
        if (isset($options->field_validation))
            $properties['field_validation'] = $options->field_validation;
        if (isset($options->custom_validation))
            $properties['custom_validation'] = $options->custom_validation;
        if (isset($options->field_is_multiline))
            $properties['field_is_multiline'] = $options->field_is_multiline;
        if (isset($options->date_format))
            $properties['date_format'] = $options->date_format;
        
        return $properties;
    }
   
}
