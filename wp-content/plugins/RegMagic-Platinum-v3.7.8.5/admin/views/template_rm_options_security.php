<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$pw_rests = $data['custom_pw_rests'];
$pw_minlen = isset($pw_rests->min_len)?$pw_rests->min_len:'';
$pw_maxlen = isset($pw_rests->max_len)?$pw_rests->max_len:'';
 $pw_rule_array = array('PWR_UC' => RM_UI_Strings::get('LABEL_PW_RESTS_PWR_UC'),
                        'PWR_NUM' => RM_UI_Strings::get('LABEL_PW_RESTS_PWR_NUM'),
                        'PWR_SC' => RM_UI_Strings::get('LABEL_PW_RESTS_PWR_SC'),
                        'PWR_MINLEN' => RM_UI_Strings::get('LABEL_PW_RESTS_PWR_MINLEN').' '."<input type='number' class='rm-pw-custom-inline-number' class='rm_tiny_fields' name='PWR_MINLEN' min='5' value='{$pw_minlen}'>",
                        'PWR_MAXLEN' => RM_UI_Strings::get('LABEL_PW_RESTS_PWR_MAXLEN').' '."<input type='number' class='rm-pw-custom-inline-number' class='rm_tiny_fields' name='PWR_MAXLEN' min='5' value='{$pw_maxlen}'>");
 
?>

<div class="rmagic">

    <!--Dialogue Box Starts-->
    <div class="rmcontent">


        <?php
        $form = new RM_PFBC_Form("options_security");
        $form->configure(array(
            "prevent" => array("bootstrap", "jQuery"),
            "action" => ""
        ));

        $options_pb_key = array("id" => "rm_captcha_public_key", "value" => $data['public_key'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ASPM_SITE_KEY'));
        $options_pr_key = array("id" => "rm_captcha_private_key", "value" => $data['private_key'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ASPM_SECRET_KEY'));

         

        $form->addElement(new Element_HTML('<div class="rmheader">' . RM_UI_Strings::get('LABEL_ANTI_SPAM') . '</div>'));
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_ENABLE_CAPTCHA'), "enable_captcha", array("yes" => ''),array("id" => "id_rm_enable_captcha_cb", "class" => "id_rm_enable_captcha_cb" , "onclick" => "hide_show(this)","value"=>$data['enable_captcha'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ASPM_ENABLE_CAPTCHA')) ));
        if ($data['enable_captcha'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_captcha_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_captcha_cb_childfieldsrow" style="display:none">'));

        //$form->addElement(new Element_Select(RM_UI_Strings::get('LABEL_CAPTCHA_LANG'), "captcha_language", $lang_arr, array("value" => $data['captcha_language'])));
        //$form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_CAPTCHA_AT_LOGIN'), "enable_captcha_under_login", array("yes" => ''), $data['enable_captcha_under_login'] == 'yes' ? array("value" => "yes") : array()));
        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_SITE_KEY'), "public_key", $options_pb_key));
        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_CAPTCHA_KEY'), "private_key", $options_pr_key));
       
        //$form->addElement(new Element_Select(RM_UI_Strings::get('LABEL_CAPTCHA_METHOD'), "captcha_req_method", array("curlpost" => "CurlPost", "socketpost" =>"SocketPost"), array("value" => $data['captcha_req_method'], "longDesc"=>RM_UI_Strings::get('LABEL_CAPTCHA_METHOD_HELP'))));

        $form->addElement(new Element_HTML("</div>"));
       
        $form->addElement(new Element_Number(RM_UI_Strings::get('LABEL_SUB_LIMIT_ANTISPAM'), "sub_limit_antispam", array("value" => $data['sub_limit_antispam'], "step" => 1, "min" => 0, "longDesc" => RM_UI_Strings::get('LABEL_SUB_LIMIT_ANTISPAM_HELP'))));
        
        //Custom paswwrod validations
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_ENABLE_PW_RESTRICTIONS'), "enable_custom_pw_rests", array("yes" => ''), $data['enable_custom_pw_rests'] == 'yes' ? array("id" => "id_custom_pw_rests", "value" => "yes", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_CUSTOM_PW_RESTS')) : array("id" => "id_custom_pw_rests", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_CUSTOM_PW_RESTS'))));
        $form->addElement(new Element_HTML("<div class='childfieldsrow'>"));
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_PW_RESTRICTIONS'), "custom_pw_rests", $pw_rule_array, array("value" => $pw_rests->selected_rules)));
        $form->addElement(new Element_HTML("</div>"));
        //End: Custom paswwrod validations
      
        $form->addElement(new Element_Textarea(RM_UI_Strings::get('LABEL_BAN_IP'), "banned_ip", array("value" => is_array($data['banned_ip'])?implode("\n",$data['banned_ip']):null, "pattern" =>"[0-9\.\?\s].*",  "title"=>  RM_UI_Strings::get('VALIDATION_ERROR_IP_ADDRESS'), "longDesc" => RM_UI_Strings::get('LABEL_BAN_IP_HELP'))));
        
        $form->addElement(new Element_Textarea(RM_UI_Strings::get('LABEL_BAN_EMAIL'), "banned_email", array("value" => is_array($data['banned_email'])?implode("\n",$data['banned_email']):null, "longDesc" => RM_UI_Strings::get('LABEL_BAN_EMAIL_HELP'))));
        
        $form->addElement(new Element_Textarea(RM_UI_Strings::get('LABEL_BAN_USERNAME'), "blacklisted_usernames", array("value" => is_array($data['blacklisted_usernames'])?implode("\n",$data['blacklisted_usernames']):null, "longDesc" => RM_UI_Strings::get('LABEL_BAN_USERNAME_HELP'))));
        
        $form->addElement(new Element_HTMLL('&#8592; &nbsp; Cancel', '?page=rm_options_manage', array('class' => 'cancel')));
        $form->addElement(new Element_Button(RM_UI_Strings::get('LABEL_SAVE')));

        $form->render();
        ?>
    </div>
</div>

<?php   
