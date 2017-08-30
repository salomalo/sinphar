<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $rm_env_requirements;

?>

<?php if (!($rm_env_requirements & RM_REQ_EXT_CURL)){ ?>
 <div class="shortcode_notification ext_na_error_notice"><p class="rm-notice-para"><?php echo RM_UI_Strings::get('RM_ERROR_EXTENSION_CURL_CC');?></p></div>
 <?php }
 $installed_php_version = phpversion();
//var_dump(version_compare('5.4', $installed_php_version, '<') && RM_REQ_EXT_CURL);
 if (!version_compare('5.4', $installed_php_version, '<'))
      {
 ?>
 <div class="shortcode_notification ext_na_error_notice"><p class="rm-notice-para"><?php echo RM_UI_Strings::get('RM_ERROR_PHP_4.5');?></p></div>
 <?php 
      }

 ?>
<div class="rmagic">

    <!--Dialogue Box Starts-->
    <div class="rmcontent">


        <?php
        $form = new RM_PFBC_Form("form_sett_cc");
        $form->configure(array(
            "prevent" => array("bootstrap", "jQuery"),
            "action" => ""
        ));
         if (isset($data->model->form_id)) {
            $form->addElement(new Element_HTML('<div class="rmheader">' . $data->model->form_name . '</div>'));
            $form->addElement(new Element_HTML('<div class="rmsettingtitle">' . RM_UI_Strings::get('LABEL_CONSTANT_CONTACT_OPTION') . '</div>'));
            $form->addElement(new Element_Hidden("form_id", $data->model->form_id));
        } else {
            $form->addElement(new Element_HTML('<div class="rmheader">' . RM_UI_Strings::get("TITLE_NEW_FORM_PAGE") . '</div>'));
        }
        if($data->error!=null)
        {
             $form->addElement(new Element_HTML($data->error));
             $form->addElement (new Element_HTMLL ('&#8592; &nbsp; Cancel', '?'.$data->next_page.'&rm_form_id='.$data->model->form_id, array('class' => 'cancel')));
      
          
        }
        elseif(!version_compare('5.4', $installed_php_version, '<') && RM_REQ_EXT_CURL)
        {
            
        }
        else
        {
        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_CONSTANT_CONTACT_OPTION'), "enable_ccontact", array(1 => ""),array("id" => "id_rm_enable_cc_cb", "class" => "id_rm_enable_cc_cb" , "value" =>  $data->model->form_options->enable_ccontact,  "onclick" => "hide_show(this)", "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_THIRDPARTY_CC_ENABLE'))));
        if($data->model->form_options->enable_ccontact[0] == 1 )
           $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_cc_cb_childfieldsrow">'));
         else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_enable_cc_cb_childfieldsrow" style="display:none">'));

        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_CC_LIST') . ":</b>", "cc_list", $data->cc_list, array("id" => "cc_list", "value" => $data->cc_form_list, "longDesc" => RM_UI_Strings::get('HELP_ADD_FORM_CC_LIST'))));
        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_EMAIL') . ":</b>", "email",$data->field_array['email'], array("id" => "email", "value" =>isset($data->model->form_options->cc_relations->email) ?$data->model->form_options->cc_relations->email : ""  , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('FIRST_NAME') . ":</b>", "first_name",$data->field_array['string'], array("id" => "first_name", "value" =>isset($data->model->form_options->cc_relations->first_name) ?$data->model->form_options->cc_relations->first_name : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LAST_NAME') . ":</b>", "last_name",$data->field_array['string'], array("id" => "last_name", "value" => isset($data->model->form_options->cc_relations->last_name) ?$data->model->form_options->cc_relations->last_name : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_MNAME') . ":</b>", "middle_name",$data->field_array['string'], array("id" => "middle_name", "value" =>isset($data->model->form_options->cc_relations->middle_name) ?$data->model->form_options->cc_relations->middle_name : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_COMPANY') . ":</b>", "company_name",$data->field_array['string'], array("id" => "company_name", "value" =>isset($data->model->form_options->cc_relations->company_name) ?$data->model->form_options->cc_relations->company_name : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_JOB_TILE') . ":</b>", "job_title", $data->field_array['string'],array("id" => "job_title", "value" => isset($data->model->form_options->cc_relations->job_title) ?$data->model->form_options->cc_relations->job_title : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_WORK_PHONE') . ":</b>", "work_phone",$data->field_array['phone'], array("id" => "work_phone", "value" =>isset($data->model->form_options->cc_relations->work_phone) ?$data->model->form_options->cc_relations->work_phone : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_CELL_PHONE') . ":</b>", "cell_phone",$data->field_array['phone'], array("id" => "cell_phone", "value" =>isset($data->model->form_options->cc_relations->cell_phone) ?$data->model->form_options->cc_relations->cell_phone : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        $form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_HOME_PHONE') . ":</b>", "home_phone",$data->field_array['phone'], array("id" => "home_phone", "value" =>isset($data->model->form_options->cc_relations->home_phone) ?$data->model->form_options->cc_relations->home_phone : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        //$form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_FAX') . ":</b>", "fax",$data->field_array['phone'], array("id" => "fax", "value" =>isset($data->model->form_options->cc_relations->fax) ?$data->model->form_options->cc_relations->fax : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        //$form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_ADDRESS') . ":</b>", "address",$data->field_array['address'], array("id" => "address", "value" =>isset($data->model->form_options->cc_relations->address) ?$data->model->form_options->cc_relations->address : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        //$form->addElement(new Element_Select("<b>" . RM_UI_Strings::get('LABEL_CREATED_DATE') . ":</b>", "created_date",$data->field_array['date'], array("id" => "created_date", "value" =>isset($data->model->form_options->cc_relations->created_date) ?$data->model->form_options->cc_relations->created_date : "" , "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CC'))));
        $form->addElement(new Element_Checkbox("<b>" . RM_UI_Strings::get('LABEL_OPT_IN_CB') . ":</b>", "form_is_opt_in_checkbox_cc", array(1 => ""), array("id" => "rm_", "class" => "rm_op", "onclick" => "hide_show(this);", "value" => $data->model->form_options->form_is_opt_in_checkbox_cc, "longDesc" => RM_UI_Strings::get('HELP_OPT_IN_CB_CC'))));

        if ($data->model->form_options->form_is_opt_in_checkbox_cc[0] == '1')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="rm_op_childfieldsrow" >'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="rm_op_childfieldsrow" style="display:none">'));



        $form->addElement(new Element_Textbox("<b>" . RM_UI_Strings::get('LABEL_OPT_IN_CB_TEXT') . ":</b>", "form_opt_in_text_cc", array("id" => "rm_form_name", "value" => isset($data->model->form_options->form_opt_in_text_cc)?$data->model->form_options->form_opt_in_text_cc:'Subscribe for emails', "longDesc" => RM_UI_Strings::get('HELP_OPT_IN_CB_TEXT'))));
        $form->addElement(new Element_Radio("<b>" . RM_UI_Strings::get('LABEL_DEFAULT_STATE') . "</b>", "form_opt_in_default_state_cc", array('Checked'=>RM_UI_Strings::get('LABEL_CHECKED'),'Unchecked'=>RM_UI_Strings::get('LABEL_UNCHECKED')), array("id"=>"id_rm_default_state", "value" => isset($data->model->form_options->form_opt_in_default_state_cc)?$data->model->form_options->form_opt_in_default_state_cc:'Unchecked', "longDesc" => RM_UI_Strings::get('MSG_OPT_IN_DEFAULT_STATE'))));
       
        $form->addElement(new Element_HTML('</div>'));
        $form->addElement(new Element_HTML('</div>'));
         $form->addElement (new Element_HTMLL ('&#8592; &nbsp; Cancel', '?page='.$data->next_page.'&rm_form_id='.$data->model->form_id, array('class' => 'cancel')));
        $form->addElement(new Element_Button(RM_UI_Strings::get('LABEL_SAVE'), "submit", array("id" => "rm_submit_btn", "class" => "rm_btn", "name" => "submit", "onClick" => "jQuery.prevent_field_add(event,'This is a required field.')")));
       
}
        $form->render();
        ?>
    </div>
</div>

<?php
