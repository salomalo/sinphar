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
        $form = new RM_PFBC_Form("options_users");
        $form->configure(array(
            "prevent" => array("bootstrap", "jQuery"),
            "action" => ""
        ));
        
        $options_sp = array("id" => "id_rm_send_pass_cb", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_USER_SEND_PASS'));
        
        if($data['auto_generated_password'] === 'yes')
            $options_sp['disabled'] = true;
        
        if( $data['send_password'] === 'yes')
            $options_sp['value'] = 'yes';

        $form->addElement(new Element_HTML('<div class="rmheader">' . RM_UI_Strings::get('GLOBAL_SETTINGS_USER') . '</div>'));
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_AUTO_PASSWORD'), "auto_generated_password", array("yes" => ''), $data['auto_generated_password'] == 'yes' ? array("id" => "id_rm_autogen_pass_cb", "value" => "yes", "onchange" => "checkbox_disable_elements(this, 'id_rm_send_pass_cb-0', 1)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_USER_AUTOGEN')) : array("id" => "id_rm_autogen_pass_cb", "onchange" => "checkbox_disable_elements(this, 'id_rm_send_pass_cb-0', 1)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_USER_AUTOGEN'))));

        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_SEND_PASS_EMAIL'), "send_password", array("yes" => ''), $options_sp));

        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_REGISTER_APPROVAL'), "user_auto_approval", array("yes" => ''), $data['user_auto_approval'] == 'yes' ? array("value" => "yes", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_USER_AUTOAPPROVAL')) : array("longDesc" => RM_UI_Strings::get('HELP_OPTIONS_USER_AUTOAPPROVAL'))));

        $form->addElement(new Element_HTMLL('&#8592; &nbsp; Cancel', '?page=rm_options_manage', array('class' => 'cancel')));
        $form->addElement(new Element_Button(RM_UI_Strings::get('LABEL_SAVE')));

        $form->render();
        ?>
    </div>
</div>

<?php   
