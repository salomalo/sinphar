<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="rmagic">

    <!--Dialogue Box Starts-->
    <div class="rmcontent">


        <?php
        $form = new RM_PFBC_Form("options_thirdparty");
        $form->configure(array(
            "prevent" => array("bootstrap", "jQuery"),
            "action" => ""
        ));

        $form->addElement(new Element_HTML('<div class="rmheader">' . RM_UI_Strings::get('GLOBAL_SETTINGS_EXTERNAL_INTEGRATIONS') . '</div>'));
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_LOGIN_FACEBOOK_OPTION'), "enable_facebook", array("yes" => ''),array("id" => "id_rm_enable_fb_cb", "class" => "id_rm_enable_fb_cb" , "value" =>  $data['enable_facebook'],  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_FB_ENABLE'))));

       
       if ($data['enable_facebook'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_fb_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_fb_cb_childfieldsrow" style="display:none">'));


        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_FACEBOOK_APP_ID'), "facebook_app_id", array("value" => $data['facebook_app_id'], "id" => "id_rm_fb_appid_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_FB_APPID'))));
        //$form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_FACEBOOK_SECRET'), "facebook_app_secret", array("value" => $data['facebook_app_secret'], "id" => "id_rm_fb_appsecret_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_FB_SECRET'))));
        
        $form->addElement(new Element_HTML("</div>"));
        
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_LOGIN_GPLUS_OPTION'), "enable_gplus", array("yes" => ''),array("id" => "id_rm_enable_gp_cb", "class" => "id_rm_enable_gp_cb" , "value" =>  $data['enable_gplus'],  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_GP_ENABLE'))));
        if ($data['enable_gplus'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_gp_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_gp_cb_childfieldsrow" style="display:none">'));
        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_GPLUS_CLIENT_ID'), "gplus_client_id", array("value" => $data['gplus_client_id'], "id" => "id_rm_gplus_client_id_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_GP_CLIENT_ID'))));        
        $form->addElement(new Element_HTML("</div>"));
         
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_LOGIN_LINKEDIN_OPTION'), "enable_linked", array("yes" => ''),array("id" => "id_rm_enable_lin_cb", "class" => "id_rm_enable_lin_cb" , "value" =>  $data['enable_linked'],  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_LINKEDIN_ENABLE'))));
        if ($data['enable_linked'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_lin_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_lin_cb_childfieldsrow" style="display:none">'));
        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_LIN_API_KEY'), "linkedin_api_key", array("value" => $data['linkedin_api_key'], "id" => "id_rm_linkedin_api_key_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_LIN_API_KEY'))));        
        $form->addElement(new Element_HTML("</div>"));
        
         $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_LOGIN_WINDOWS_OPTION'), "enable_window_login", array("yes" => ''),array("id" => "id_rm_enable_win_cb", "class" => "id_rm_enable_win_cb" , "value" =>  $data['enable_window_login'],  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_WINDOWS_ENABLE'))));
        if ($data['enable_window_login'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_win_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_win_cb_childfieldsrow" style="display:none">'));
        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_WIN_CLIENT_ID'), "windows_client_id", array("value" => $data['windows_client_id'], "id" => "id_rm_linkedin_api_key_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_WIN_CLIENT_ID'))));        
        
        $form->addElement(new Element_HTML("</div>"));
        
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_LOGIN_TWITTER_OPTION'), "enable_twitter_login", array("yes" => ''),array("id" => "id_rm_enable_tw_cb", "class" => "id_rm_enable_tw_cb" , "value" =>  $data['enable_twitter_login'],  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_TWITTER_ENABLE'))));
        if ($data['enable_window_login'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_tw_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_tw_cb_childfieldsrow" style="display:none">'));
        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_TW_CONSUMER_KEY'), "tw_consumer_key", array("value" => $data['tw_consumer_key'], "id" => "id_rm_linkedin_api_key_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_TW_CONSUMER_KEY'))));        
       $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_TW_CONSUMER_SEC'), "tw_consumer_secret", array("value" => $data['tw_consumer_secret'], "id" => "id_rm_linkedin_api_key_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_TW_CONSUMER_SEC'))));        
       $form->addElement(new Element_HTML("</div>"));
       
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_LOGIN_INSTAGRAM_OPTION'), "enable_instagram_login", array("yes" => ''),array("id" => "id_rm_enable_ins_cb", "class" => "id_rm_enable_ins_cb" , "value" =>  $data['enable_instagram_login'],  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_INSTAGRAM_ENABLE'))));
        if ($data['enable_window_login'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_ins_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_ins_cb_childfieldsrow" style="display:none">'));
        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_INS_CLIENT_ID'), "instagram_client_id", array("value" => $data['instagram_client_id'], "id" => "id_rm_linkedin_api_key_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_INS_CLIENT_ID'))));        
        
        $form->addElement(new Element_HTML("</div>"));
        
        
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_MAILCHIMP_INTEGRATION'), "enable_mailchimp", array("yes" => ''),array("id" => "id_rm_enable_mc_cb", "class" => "id_rm_enable_mc_cb" , "value" =>  $data['enable_mailchimp'],  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_MC_ENABLE'))));

       if ($data['enable_mailchimp'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_mc_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_mc_cb_childfieldsrow" style="display:none">'));
       
        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_MAILCHIMP_API'), "mailchimp_key", array("value" => $data['mailchimp_key'], "id" => "id_rm_mc_key_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_MC_API'))));
        $form->addElement(new Element_HTML("</div>"));
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_CONSTANT_CONTACT_OPTION_INTEGRATION'), "enable_ccontact", array("yes" => ''),array("id" => "id_rm_enable_cc_cb", "class" => "id_rm_enable_cc_cb" , "value" =>  $data['enable_ccontact'],  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_CC_ENABLE'))));
    
     if($data['enable_ccontact'] == 'yes')
           $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_cc_cb_childfieldsrow">'));
    else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_cc_cb_childfieldsrow" style="display:none">'));

     $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_CONSTANT_CONTACT_APP_ID'), "cc_app_key", array("value" => $data['cc_app_key'], "id"=>"id_rm_fb_appid_tb", "longDesc"=>RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_CC_APP_ID'))));
    $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_CONSTANT_CONTACT_ACCESS_TOKEN'), "cc_access_token", array("value" => $data['cc_access_token'],"id"=>"id_rm_fb_appsecret_tb", "longDesc"=>RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_CC_ACCESS_TOKEN'))));
    $form->addElement(new Element_HTML("</div>"));
   
   
     $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_AWEBER_OPTION_INTEGRATION'), "enable_aweber", array("yes" => ''),array("id" => "id_rm_enable_aw_cb", "class" => "id_rm_enable_aw_cb" , "value" =>  $data['enable_aweber'],  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_AW_ENABLE'))));
    
     if($data['enable_aweber'] == 'yes')
           $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_aw_cb_childfieldsrow">'));
    else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_aw_cb_childfieldsrow" style="display:none">'));

    $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_AWEBER_CONSUMER_KEY'), "aw_consumer_key", array("value" => $data['aw_consumer_key'], "id"=>"id_rm_aw_appid_tb", "longDesc"=>RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_A_CONSUMER_KEY'))));
    $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_AWEBER_CONSUMER_SECRET'), "aw_consumer_secret", array("value" => $data['aw_consumer_secret'],"id"=>"id_rm_aw_appsecret_tb", "longDesc"=>RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_A_CONSUMER_SECRET'))));
    $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_AWEBER_ACCESS_KEY'), "aw_access_key", array("value" => $data['aw_access_key'], "id"=>"id_rm_aw_ac_tk", "longDesc"=>RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_A_ACCESS_KEY'))));
    $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_AWEBER_ACCESS_SECRET'), "aw_access_secret", array("value" => $data['aw_access_secret'],"id"=>"id_rm_aw_ac_sct", "longDesc"=>RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_A_ACCESS_SECRET'))));
    $link=RM_BASE_URL."external/AWeber/get_access_token.php";
    $window_name="Aweber";
    $size="width=200,height=150";
    $anchor='<a href="javascript:window.open()"> Here</a>';
    $aweber_message = sprintf(RM_UI_Strings::get('AWEBER_MESSAGE'),"href=javascript:void(0) onclick='myFunction()'");
    $form->addElement(new Element_HTML("<div>".$aweber_message."</div>"));
    
    $form->addElement(new Element_HTML("</div>"));
    
    

        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_GOOGLE_API_KEY'), "google_map_key", array("value" => $data['google_map_key'], "id" => "id_rm_ggl_key_tb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_GGL_API'))));
        foreach($data['thirdparty_configs'] as $elements):
            foreach($elements as $element):
                  $form->addElement($element);
            endforeach;
        endforeach;
        
        $form->addElement(new Element_HTMLL('&#8592; &nbsp; Cancel', '?page=rm_options_manage', array('class' => 'cancel')));
        $form->addElement(new Element_Button(RM_UI_Strings::get('LABEL_SAVE')));

        $form->render();
        ?>
    </div>
    <pre class='rm-pre-wrapper-for-script-tags'><script>
    function myFunction()
    {
       window.open('<?php echo $link; ?>', 'my window','width=400,height=400,top=400,left=400');
    }
    </script></pre>
</div>
<?php   
