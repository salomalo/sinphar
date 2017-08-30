<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_options_controller
 *
 * @author CMSHelplive
 */
class RM_Options_Controller
{

    public $mv_handler;

    function __construct()
    {
        $this->mv_handler = new RM_Model_View_Handler();
    }

    public function add()
    {
        $this->service->add();
        $this->view->render();
    }

    public function get_options()
    {
        $data = $this->service->get_options();
        $this->view->render($data);
    }

    public function user($model, $service, $request, $params)
    {
        if ($this->mv_handler->validateForm("options_users"))
        {
            $options = array();

            $options['auto_generated_password'] = isset($request->req['auto_generated_password']) ? "yes" : null;
            $options['send_password'] = isset($request->req['send_password']) ? "yes" : null;
            $options['user_auto_approval'] = isset($request->req['user_auto_approval']) ? "yes" : null;

            $service->set_model($model);
            $service->save_options($options);
            RM_Utilities::redirect(admin_url('/admin.php?page=' . $params['xml_loader']->request_tree->success));
        } else
        {
            $view = $this->mv_handler->setView('options_user');
            $service->set_model($model);
            $data = $service->get_options();
            $view->render($data);
        }
    }

    public function manage($model, RM_Setting_Service $service, $request, $params)
    {
        $view = $this->mv_handler->setView('options_manager');
        $view->render();
    }

    public function general(RM_Options $model, RM_Setting_Service $service, $request, $params)
    {
        if ($this->mv_handler->validateForm("options_general"))
        {
            $options = array();
            $options['theme'] = $request->req['theme'];
            $options['allowed_file_types'] = $request->req['allowed_file_types'];
            $options['default_registration_url'] = $request->req['default_registration_url'];
            $options['post_submission_redirection_url'] = $request->req['post_submission_redirection_url'];
            $options['post_logout_redirection_page_id'] = $request->req['post_logout_redirection_page_id'];
            $options['user_ip'] = isset($request->req['user_ip']) ? "yes" : null;
            $options['allow_multiple_file_uploads'] = isset($request->req['allow_multiple_file_uploads']) ? "yes" : null;
            $options['form_layout'] = $request->req['form_layout'];
            $options['display_progress_bar'] = isset($request->req['display_progress_bar']) ? "yes" : null;
            $options['sub_pdf_header_text'] = $request->req['sub_pdf_header_text'];
            $options['submission_on_card'] = $request->req['submission_on_card'];
            $options['show_asterix'] = isset($request->req['show_asterix']) ? "yes" : null;
            $options['redirect_admin_to_dashboard_post_login'] = isset($request->req['redirect_admin_to_dashboard_post_login']) ? "yes" : null;
            
            if(isset($_FILES['sub_pdf_header_img'])){
                $att_service = new RM_Attachment_Service;
                $attach_id = $att_service->media_handle_attachment('sub_pdf_header_img', 0);
                if (!is_wp_error($attach_id))
                {
                    $options['sub_pdf_header_img'] = $attach_id;
                }
                else
                {
                    if($request->req['rm_pdf_logo_removal']=='true')
                    {
                        $options['sub_pdf_header_img'] = null;
                    }
                }
            }
            
            $service->set_model($model);

            $service->save_options($options);
            RM_Utilities::redirect(admin_url('/admin.php?page=' . $params['xml_loader']->request_tree->success));
        } else
        {
            $view = $this->mv_handler->setView('options_general');
            $service->set_model($model);
            $data = $service->get_options();

            //Add an extra space around the extensions for better visibility for end user.
            //While saving they are automatically stripped off.
            $data['allowed_file_types'] = str_replace("|", " | ", $data['allowed_file_types']);
            
            $view->render($data);
        }
    }
    
    public function fab(RM_Options $model, RM_Setting_Service $service, $request, $params)
    {
        if ($this->mv_handler->validateForm("options_fab"))
        {
            $options = array();
            $options['display_floating_action_btn'] = isset($request->req['display_floating_action_btn']) ? "yes" : null;
            $options['fab_icon'] = $request->req['fab_icon'];
            $link_type1=isset($request->req['fab_link_type1']) ? $request->req['fab_link_type1']: null;
            $link_type2=isset($request->req['fab_link_type2']) ? $request->req['fab_link_type2']: null;
            $link_type3=isset($request->req['fab_link_type3']) ? $request->req['fab_link_type3']: null;
            $fab_links=array(
                "1"=>array(
                    "flag"=>isset($request->req['fab_link1']['0']) ? $request->req['fab_link1']['0']: null,
                    "type"=>$link_type1,
                    "visibility"=>isset($request->req['fab_link_role_'.$link_type1.'1']) ? $request->req['fab_link_role_'.$link_type1.'1'] : null,
                    "link"=>isset($request->req['fab_link_'.$link_type1.'1']) ? $request->req['fab_link_'.$link_type1.'1']: null,
                    "label"=>isset($request->req['fab_link_'.$link_type1.'_label1']) ? $request->req['fab_link_'.$link_type1.'_label1'] : null
                ),
                "2"=>array(
                    "flag"=>isset($request->req['fab_link2']['0']) ? $request->req['fab_link2']['0']: null,
                    "type"=>$link_type2,
                    "visibility"=>isset($request->req['fab_link_role_'.$link_type2.'2']) ? $request->req['fab_link_role_'.$link_type2.'2'] : null,
                    "link"=>isset($request->req['fab_link_'.$link_type2.'2']) ? $request->req['fab_link_'.$link_type2.'2']: null,
                    "label"=>isset($request->req['fab_link_'.$link_type2.'_label2']) ? $request->req['fab_link_'.$link_type2.'_label2'] : null
                ),
                "3"=>array(
                    "flag"=>isset($request->req['fab_link3']['0']) ? $request->req['fab_link3']['0']: null,
                    "type"=>$link_type3,
                    "visibility"=>isset($request->req['fab_link_role_'.$link_type3.'3']) ? $request->req['fab_link_role_'.$link_type3.'3'] : null,
                    "link"=>isset($request->req['fab_link_'.$link_type3.'3']) ? $request->req['fab_link_'.$link_type3.'3']: null,
                    "label"=>isset($request->req['fab_link_'.$link_type3.'_label3']) ? $request->req['fab_link_'.$link_type3.'_label3'] : null
                )
                
            );
            
            
            $options['fab_links']=$fab_links;
            
     // echo "<pre>",var_dump($fab_links);die;
            $options['show_tabs']=array(
            'payment'=>isset($request->req['pay_tab']) ? 1: 0,
            'details'=>isset($request->req['det_tab']) ? 1: 0,
            'submissions'=>isset($request->req['sub_tab']) ?1: 0);
            $service->set_model($model);

            $service->save_options($options);
            RM_Utilities::redirect(admin_url('/admin.php?page=' . $params['xml_loader']->request_tree->success));
        } else
        {
            $view = $this->mv_handler->setView('options_fab');
            $service->set_model($model);
            $data = $service->get_options();            
            $view->render($data);
        }
    }

    public function security($model, RM_Setting_Service $service, $request, $params)
    {
        if ($this->mv_handler->validateForm("options_security"))
        {
            $options = array();

            $options['enable_captcha'] = isset($request->req['enable_captcha']) ? "yes" : null;
           // $options['captcha_language'] = $request->req['captcha_language'];
            $options['public_key'] = isset($request->req['public_key']) ? $request->req['public_key'] : null;
            $options['private_key'] = isset($request->req['private_key']) ? $request->req['private_key'] : null;
            $options['sub_limit_antispam'] = $request->req['sub_limit_antispam'];
            $options['banned_ip'] = $request->req['banned_ip'];
            $options['banned_email'] = $request->req['banned_email'];
            $options['blacklisted_usernames'] = $request->req['blacklisted_usernames'];
            $options['enable_captcha_under_login'] = isset($request->req['enable_captcha_under_login']) ? "yes" : null;
           // $options['captcha_req_method'] = $request->req['captcha_req_method'];
            $options['enable_custom_pw_rests'] = isset($request->req['enable_custom_pw_rests']) ? "yes" : null;
             $custom_pw_rests = isset($request->req['custom_pw_rests']) ? $request->req['custom_pw_rests'] : null;
             
             if(!$custom_pw_rests)
             {
                 $custom_pw_rests = (object) array('selected_rules' => array(), 'min_len' => $request->req['PWR_MINLEN'], 'max_len' => $request->req['PWR_MAXLEN']);
             }
             else
             {
                 $custom_pw_rests = (object) array('selected_rules' => $custom_pw_rests, 'min_len' => $request->req['PWR_MINLEN'], 'max_len' => $request->req['PWR_MAXLEN']);
             }
             
             $options['custom_pw_rests'] = $custom_pw_rests;
             
            $service->set_model($model);

            $service->save_options($options);
           RM_Utilities::redirect(admin_url('/admin.php?page=' . $params['xml_loader']->request_tree->success));
        } else
        {
            $view = $this->mv_handler->setView('options_security');
            $service->set_model($model);
            $data = $service->get_options();
            $view->render($data);
        }
    }

    public function autoresponder($model, $service, $request, $params)
    {
        if ($this->mv_handler->validateForm("options_autoresponder"))
        {
            $options = array();

            $options['admin_notification'] = isset($request->req['admin_notification']) ? "yes" : null;
            $options['user_notification_for_notes'] = isset($request->req['user_notification_for_notes']) ? "yes" : null;
            if (isset($request->req['resp_emails']))
                $options['admin_email'] = implode(",", $request->req['resp_emails']);
            $options['admin_notification_includes_pdf'] = isset($request->req['admin_notification_includes_pdf']) ? "yes" : 'no';
            //var_dump($options['admin_email']);die;
            $options['senders_display_name'] = $request->req['senders_display_name'];
            $options['senders_email'] = $request->req['senders_email'];

            $options['enable_smtp'] = isset($request->req['enable_smtp']) ? "yes" : null;
            $options['smtp_encryption_type'] = $request->req['smtp_encryption_type'];
            $options['smtp_host'] = $request->req['smtp_host'];
            $options['smtp_port'] = $request->req['smtp_port'];
            
            $options['smtp_auth'] = isset($request->req['smtp_auth']) ? "yes" : null;
            $options['smtp_user_name'] = $request->req['smtp_user_name'];
            $options['smtp_password'] = $request->req['smtp_password'];

            $service->set_model($model);

            $service->save_options($options);
            RM_Utilities::redirect(admin_url('/admin.php?page=' . $params['xml_loader']->request_tree->success));
        } else
        {
            $view = $this->mv_handler->setView('options_autoresponder');
            $service->set_model($model);
            $data = $service->get_options();
            $view->render($data);
        }
    }

    public function thirdparty($model, RM_Setting_Service $service, $request, $params)
    {
        if ($this->mv_handler->validateForm("options_thirdparty"))
        {
            $options = array();
            $options['enable_facebook'] = isset($request->req['enable_facebook']) ? "yes" : null;
            $options['enable_gplus'] = isset($request->req['enable_gplus']) ? "yes" : null;
            $options['enable_linked'] = isset($request->req['enable_linked']) ? "yes" : null;
            $options['enable_window_login'] = isset($request->req['enable_window_login']) ? "yes" : null;
            $options['facebook_app_id'] = $request->req['facebook_app_id'];
            $options['gplus_client_id'] = $request->req['gplus_client_id'];
            $options['linkedin_api_key'] = $request->req['linkedin_api_key']; 
            $options['windows_client_id'] = $request->req['windows_client_id']; 
        //    $options['facebook_app_secret'] = $request->req['facebook_app_secret'];
            $options['enable_mailchimp'] = isset($request->req['enable_mailchimp']) ? "yes" : null;
            $options['mailchimp_key'] = $request->req['mailchimp_key'];
            $options['google_map_key'] = $request->req['google_map_key'];
            $options['enable_ccontact'] = isset($request->req['enable_ccontact']) ? "yes" : null;
            $options['cc_app_key'] = $request->req['cc_app_key'];
            $options['cc_access_token'] = $request->req['cc_access_token'];
            $options['enable_aweber'] = isset($request->req['enable_aweber']) ? "yes" : null;
            $options['aw_consumer_key'] = $request->req['aw_consumer_key'];
            $options['aw_consumer_secret'] = $request->req['aw_consumer_secret'];
            $options['aw_access_key'] = $request->req['aw_access_key'];
            $options['aw_access_secret'] = $request->req['aw_access_secret'];
            $options['enable_twitter_login'] = isset($request->req['enable_twitter_login']) ? "yes" : null;
            $options['tw_consumer_key'] = $request->req['tw_consumer_key'];
            $options['tw_consumer_secret'] = $request->req['tw_consumer_secret'];
            $options['enable_instagram_login'] = isset($request->req['enable_instagram_login']) ? "yes" : null;
            $options['instagram_client_id'] = $request->req['instagram_client_id'];
            //Pass it to extensions
            do_action('rm_gopts_thirdparty_save', $request->req);
            $service->set_model($model);

            $service->save_options($options);
            RM_Utilities::redirect(admin_url('/admin.php?page=' . $params['xml_loader']->request_tree->success));
        } else
        {

            $view = $this->mv_handler->setView('options_thirdparty');
            $service->set_model($model);
            $data = $service->get_options();
            $data = apply_filters('rm_extend_thirdparty_config',$data);
            $view->render($data);
        }
    }

    public function payment($model, RM_Setting_Service $service, $request, $params)
    {
        if ($this->mv_handler->validateForm("options_payment"))
        {
            $options = array();

            $options['payment_gateway'] = isset($request->req['payment_gateway']) ? $request->req['payment_gateway'] : null;
            $options['paypal_test_mode'] = isset($request->req['paypal_test_mode']) ? "yes" : null;

            $options['currency'] = $request->req['currency'];
            $options['currency_symbol_position'] = $request->req['currency_symbol_position'];
                       
            if(isset($request->req['paypal_page_style']))
                $options['paypal_page_style'] = $request->req['paypal_page_style'];
            
            if(isset($request->req['paypal_email']))
                $options['paypal_email'] = $request->req['paypal_email'];
            
            if(isset($request->req['stripe_api_key']))
                $options['stripe_api_key'] = $request->req['stripe_api_key'];
            
            if(isset($request->req['stripe_publish_key']))
                $options['stripe_publish_key'] = $request->req['stripe_publish_key'];
            
            //Pass it to extensions
            do_action('rm_gopts_payment_save', $request->req);
            
            $service->set_model($model);

            $service->save_options($options);
            RM_Utilities::redirect(admin_url('/admin.php?page=' . $params['xml_loader']->request_tree->success));
        } else
        {

            $view = $this->mv_handler->setView('options_payment');
            $service->set_model($model);
            $data = $service->get_options();
            
            $options_s_api = array("id" => "rm_s_api_key_tb", "value" => $data['stripe_api_key'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_PYMNT_STRP_API_KEY'), "disabled" => true);
            $options_s_pub = array("id" => "rm_s_publish_key_tb", "value" => $data['stripe_publish_key'], "disabled" => true);
            $options_pp_test_cb = array("id" => "rm_pp_test_cb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_PYMNT_TESTMODE'), "disabled" => true);
            $options_pp_email = array("id" => "rm_pp_email_tb", "value" => $data['paypal_email'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_PYMNT_PP_EMAIL'), "disabled" => true);
            $options_pp_pstyle = array("id" => "rm_pp_style_tb", "value" => $data['paypal_page_style'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_PYMNT_PP_PAGESTYLE'), "disabled" => true);
            if(null != $data['payment_gateway'] && is_array($data['payment_gateway'])){
                foreach($data['payment_gateway'] as $gateway){
                    switch($gateway){
                        case 'paypal' : 
                            unset($options_pp_test_cb['disabled']);
                            unset($options_pp_email['disabled']);
                            unset($options_pp_pstyle['disabled']);

                        case 'stripe' : 
                            if(RM_Utilities::is_ssl())
                            {
                                unset($options_s_api['disabled']);
                                unset($options_s_pub['disabled']);
                            }
                    }
                }
            }

            if($data['paypal_test_mode'] == 'yes')
                $options_pp_test_cb['value'] = 'yes';
            
            $pay_procs_options = array("paypal" => "<img src='" . RM_IMG_URL . "/paypal-logo.png" . "'>",
                                      "stripe" => "<img src='" . RM_IMG_URL . "/stripe-logo.png" . "'>");
            
            $pay_procs_configs = array("paypal" => array(
                                            new Element_Checkbox(RM_UI_Strings::get('LABEL_TEST_MODE'), "paypal_test_mode", array("yes" => ''), $options_pp_test_cb),
                                            new Element_Email(RM_UI_Strings::get('LABEL_PAYPAL_EMAIL'), "paypal_email", $options_pp_email),
                                            new Element_Textbox(RM_UI_Strings::get('LABEL_PAYPAL_STYLE'), "paypal_page_style", $options_pp_pstyle)
                                            ),
                                      "stripe" => array(
                                            new Element_Textbox(RM_UI_Strings::get('LABEL_STRIPE_API_KEY'), "stripe_api_key", $options_s_api),
                                            new Element_Textbox(RM_UI_Strings::get('LABEL_STRIPE_PUBLISH_KEY'), "stripe_publish_key", $options_s_pub)
                                            )
                                     );
            
            $data['pay_procs_options'] = apply_filters('rm_extend_payprocs_options',$pay_procs_options, $data);
            $data['pay_procs_configs'] = apply_filters('rm_extend_payprocs_config',$pay_procs_configs, $data);
            $view->render($data);
        }
    }

}

/*
$options = array();
            if (!isset($request->req['options_category']))
                return false;
            //$form='';

            switch ($request->req['options_category'])
            {
                case "general":
                    $options['theme'] = $request->req['theme'];
                    $options['allowed_file_types'] = $request->req['allowed_file_types'];
                    $options['default_registration_url'] = $request->req['default_registration_url'];
                    $options['post_submission_redirection_url'] = $request->req['post_submission_redirection_url'];
                    $options['user_ip'] = isset($request->req['user_ip']) ? "yes" : null;
                    $options['allow_multiple_file_uploads'] = isset($request->req['allow_multiple_file_uploads']) ? "yes" : null;
                    $form = 'options_general';
                    break;

                case "users":
                    $options['auto_generated_password'] = isset($request->req['auto_generated_password']) ? "yes" : null;
                    $options['send_password'] = isset($request->req['send_password']) ? "yes" : null;
                    $options['user_auto_approval'] = isset($request->req['user_auto_approval']) ? "yes" : null;
                    break;

                case "security":
                    $options['enable_captcha'] = isset($request->req['enable_captcha']) ? "yes" : null;
                    $options['captcha_language'] = $request->req['captcha_language'];
                    $options['public_key'] = $request->req['public_key'];
                    $options['private_key'] = $request->req['private_key'];
                    $options['enable_captcha_under_login'] = isset($request->req['enable_captcha_under_login']) ? "yes" : null;
                    $options['captcha_req_method'] = $request->req['captcha_req_method'];
                    $form = 'options_security';
                    break;

                case "autoresponder":
                    //var_dump($request);die;

                    $options['admin_notification'] = isset($request->req['admin_notification']) ? "yes" : null;
                    $options['user_notification_for_notes'] = isset($request->req['user_notification_for_notes']) ? "yes" : null;
                    if (isset($request->req['resp_emails']))
                        $options['admin_email'] = implode(",", $request->req['resp_emails']);
                    //var_dump($options['admin_email']);die;
                    $options['senders_email'] = $request->req['senders_email'];
                    break;

                case "thirdparty":
                    $options['enable_facebook'] = isset($request->req['enable_facebook']) ? "yes" : null;
                    $options['facebook_app_id'] = $request->req['facebook_app_id'];
                    $options['facebook_app_secret'] = $request->req['facebook_app_secret'];
                    $options['enable_mailchimp'] = isset($request->req['enable_mailchimp']) ? "yes" : null;
                    $options['mailchimp_key'] = $request->req['mailchimp_key'];
                    $form = "options_thirdparty";
                    break;

                case "payment":
                    $options['payment_gateway'] = $request->req['payment_gateway'];
                    $options['paypal_test_mode'] = isset($request->req['paypal_test_mode']) ? "yes" : null;
                    $options['paypal_email'] = $request->req['paypal_email'];
                    $options['currency'] = $request->req['currency'];
                    $options['currency_symbol_position'] = $request->req['currency_symbol_position'];
                    $options['paypal_page_style'] = $request->req['paypal_page_style'];
                    break;

                default: return false;
            }


            $service->set_model($model);


            $service->save_options($options);
            RM_Utilities::redirect(admin_url('/admin.php?page=' . $params['xml_loader']->request_tree->success));*/
