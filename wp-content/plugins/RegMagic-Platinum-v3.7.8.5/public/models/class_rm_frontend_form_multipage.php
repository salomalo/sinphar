<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RM_Frontend_Form_Multipage extends RM_Frontend_Form_Base
{

    protected $form_pages;
    protected $ordered_form_pages;
    
    public function __construct(RM_Forms $be_form, $ignore_expiration=false)
    {
        parent::__construct($be_form, $ignore_expiration);

        if ($this->form_options->form_pages == null)
        {
            $this->form_pages = array('Page 1');
            $this->ordered_form_pages = array(0);
        }
        else
        {
            $this->form_pages = $this->form_options->form_pages;
            if ($this->form_options->ordered_form_pages == null)
                $this->ordered_form_pages = array_keys($this->form_pages);
            else
                $this->ordered_form_pages = $this->form_options->ordered_form_pages;
        }
    }

    public function get_form_pages()
    {
        return $this->form_pages;
    }

    public function pre_sub_proc($request, $params)
    {
        return true;
    }

    public function post_sub_proc($request, $params)
    {
        return true;
    }
    
    //Following two methods can be overloaded by child classes in order to add custom fields to any page of the form.
    protected function hook_pre_field_addition_to_page($form, $page_no)
    {
        
    }
    
    protected function hook_post_field_addition_to_page($form, $page_no,$editing_sub=null)
    {
        
    }
    
    public function render($data = array())
    {
        $editing_sub=false;
        $settings = new RM_Options;
        $theme = $settings->get_value_of('theme');
        $layout = $settings->get_value_of('form_layout');
        $class= "rm_theme_{$theme} rm_layout_{$layout}"; 
        echo '<div class="rmagic '.$class.'">';
        
        //$this->form_number = $rm_form_diary[$this->form_id];
        $form = new RM_PFBC_Form('form_' . $this->form_id . "_" . $this->form_number);
        $btn_align_class = "rmagic-form-btn-".(isset($this->form_options->form_btn_align)?$this->form_options->form_btn_align:"center");
        $form->configure(array(
            "prevent" => array("bootstrap", "jQuery", "focus"),
            "action" => add_query_arg('rmcb', time()),
            "class" => "rmagic-form $btn_align_class",
            "name" => "rm_form",
            "number" => $this->form_number,
            "view" => ($layout == 'two_columns')? new View_UserFormTwoCols: new View_UserForm,
            "style" => isset($this->form_options->style_form)?$this->form_options->style_form:null
        ));
        
        //Render content above the form
        if (!empty($this->form_options->form_custom_text))
                $form->addElement(new Element_HTML('<div class="rmheader">' . $this->form_options->form_custom_text . '</div>'));

       
        //check if form has expired
        if (!$this->preview && $this->is_expired())
        {
            if ($this->form_options->form_message_after_expiry)
                echo $this->form_options->form_message_after_expiry;
            else
                echo '<div class="rm-no-default-from-notification">'.RM_UI_Strings::get('MSG_FORM_EXPIRY').'</div>';
            echo '</div>';
            return;
        }

        if (isset($data['stat_id']) && $data['stat_id'])
        {
            $form->addElement(new Element_HTML('<div id="rm_stat_container" style="display:none">'));
            $form->addElement(new Element_Textbox('RM_Stats', 'stat_id', array('value' => $data['stat_id'], 'style' => 'display:none')));
            $form->addElement(new Element_HTML('</div>'));
            $editing_sub=false;
        }
        
        if (isset($data['submission_id']) && $data['submission_id'])
        {
            $form->addElement(new Element_HTML('<div id="rm_stdat_container" style="display:none">'));
            $form->addElement(new Element_Textbox('RM_Slug', 'rm_slug', array('value' => 'rm_user_form_edit_sub', 'style' => 'display:none')));
            $form->addElement(new Element_Textbox('RM_form_id', 'form_id', array('value' => $this->form_id, 'style' => 'display:none')));
            $form->addElement(new Element_HTML('</div>'));
            $editing_sub=true;
        }
        
        parent::pre_render( );
        $this->base_render($form,$editing_sub);
        parent::post_render();

        echo '</div>';
    }
    
    public function get_form_object($data = array())
    {
        $settings = new RM_Options;
        $theme = $settings->get_value_of('theme');
        $layout = $settings->get_value_of('form_layout');
        $class= "rm_theme_{$theme} rm_layout_{$layout}"; 
        
        //$this->form_number = $rm_form_diary[$this->form_id];
        $form_model = new RM_PFBC_Form('form_' . $this->form_id . "_" . $this->form_number);

        $form_model->configure(array(
            "prevent" => array("bootstrap", "jQuery", "focus"),
            "action" => "",
            "class" => "rmagic-form",
            "name" => "rm_form",
            "number" => $this->form_number,
            "view" => ($layout == 'two_columns')? new View_UserFormTwoCols: new View_UserForm,
            "style" => isset($this->form_options->style_form)?$this->form_options->style_form:null
        ));
        
        //Render content above the form
        if (!empty($this->form_options->form_custom_text))
                $form_model->addElement(new Element_HTML('<div class="rmheader">' . $this->form_options->form_custom_text . '</div>'));

        $form_model->addElement(new Element_HTML('<div id="rm_stat_container" style="display:none">'));
        $form_model->addElement(new Element_Textbox('RM_Stats', 'stat_id', array('value' => "__form_model", 'style' => 'display:none')));
        $form_model->addElement(new Element_HTML('</div>'));
        
        //Since pre-render only adds style and expiry countdown no need to call it.
        //parent::pre_render();
        //$this->base_render($form_model);
        $this->prepare_fields_for_render($form_model);
        if (get_option('rm_option_enable_captcha') == "yes" && $this->form_options->enable_captcha[0]=='yes')
            $form_model->addElement(new Element_Captcha());
        //$this->prepare_button_for_render($form_model);
        //Nothing special in post render for now, do not call.
        //parent::post_render();
        return $form_model;
    }

    protected function prepare_fields_for_render($form,$editing_sub=null)
    { 
        $form->addElement(new Element_Hidden("rm_tp_timezone","",array("id"=>"id_rm_tp_timezone")));     
        $n = 1; //page no(ordinal no. not actual) maintained for js traversing through pages.
        
        foreach ($this->ordered_form_pages as $fp_no)
        {   $k = intval($fp_no);
            $page = $this->form_pages[$fp_no];
            $i = $k+1;//actual page no.
            if ($n == 1)
            {
               $form->addElement(new Element_HTML("<div class=\"rmformpage_form_".$this->form_id."_".$this->form_number."\" id=\"rm_form_page_form_".$this->form_id ."_".$this->form_number. "_".$n."\">"));
               $form->addElement(new Element_HTML("<fieldset class='rmfieldset'>"));
               
               if(count($this->form_pages) > 1)
                 $form->addElement(new Element_HTML("<legend style='".$this->form_options->style_section."'>".$page."</legend>"));
               $this->hook_pre_field_addition_to_page($form, $n);
           
                    foreach ($this->fields as $field)
                    {
                       
                        $pf = $field->get_pfbc_field();
                            
                        if ($pf === null || $field->get_page_no() != $i)
                            continue;

                        if (is_array($pf))
                        {
                            foreach ($pf as $f)
                            {
                                if (!$f)
                                    continue;
                                $form->addElement($f);
                            }
                        } else
                            $form->addElement($pf);
                        
                    }
                    
                    $this->hook_post_field_addition_to_page($form, $n, $editing_sub);
                    $form->addElement(new Element_HTML("</fieldset>"));
                    $form->addElement(new Element_HTML("</div>"));
                    
            } else
            {
                $form->addElement(new Element_HTML("<div class=\"rmformpage_form_".$this->form_id."_".$this->form_number."\"id=\"rm_form_page_form_".$this->form_id ."_".$this->form_number. "_".$n."\" style=\"display:none\">"));
               $form->addElement(new Element_HTML("<fieldset class='rmfieldset'>"));
                 $form->addElement(new Element_HTML("<legend style='".$this->form_options->style_section."'>".$page."</legend>"));
               
                ?>
                
                    <?php
                    $this->hook_pre_field_addition_to_page($form, $n);
                    foreach ($this->fields as $field)
                    {
                        $pf = $field->get_pfbc_field();

                        if ($pf === null || $field->get_page_no() != $i)
                            continue;

                        if (is_array($pf))
                        {
                            foreach ($pf as $f)
                            {
                                if (!$f)
                                    continue;
                                $form->addElement($f);
                            }
                        } else
                            $form->addElement($pf);
                    }
                    $this->hook_post_field_addition_to_page($form, $n, $editing_sub);
                    $form->addElement(new Element_HTML("</fieldset>"));
                    $form->addElement(new Element_HTML("</div>"));          
            }

            $n++;
        }

        
    }
    
    protected function prepare_button_for_render($form)
    {
        if ($this->service->get_setting('theme') != 'matchmytheme')
        {
            if(isset($this->form_options->style_btnfield))
                unset($this->form_options->style_btnfield);
        }
        $sub_btn_label = $this->form_options->form_submit_btn_label ? stripslashes($this->form_options->form_submit_btn_label) : "Submit";
        $prev_btn_label = $this->form_options->form_prev_btn_label ? stripslashes($this->form_options->form_prev_btn_label) : RM_UI_Strings::get('LABEL_PREV_FORM_PAGE');
        $next_btn_label = $this->form_options->form_next_btn_label ? stripslashes($this->form_options->form_next_btn_label) : "Next";
        $max_pages = count($this->get_form_pages());
        
        $btn_label = ($max_pages > 1) ? $next_btn_label : $sub_btn_label;

        
        if($max_pages > 1 && !$this->form_options->no_prev_button)
            $form->addElement(new Element_Button($prev_btn_label, "button", array("style" => isset($this->form_options->style_btnfield)?$this->form_options->style_btnfield:null, "id"=>"rm_prev_form_page_button_".$this->form_id.'_'.$this->form_number, "onclick"=>'gotoprev_form_'.$this->form_id.'_'.$this->form_number.'()', "disabled"=>"1")));
        $form->addElement(new Element_Button($btn_label, "button", array("data-label-next" => $next_btn_label,"data-label-sub" => $sub_btn_label,  "style" => isset($this->form_options->style_btnfield)?$this->form_options->style_btnfield:null, "id"=>"rm_next_form_page_button_".$this->form_id.'_'.$this->form_number,"onclick"=>'gotonext_form_'.$this->form_id.'_'.$this->form_number.'()')));
        
        $this->insert_JS($form);
    }
    
    protected function get_jqvalidator_config_JS()
    {
$str = <<<JSHD
        jQuery.validator.setDefaults({errorClass: 'rm-form-field-invalid-msg',
                                        ignore:':hidden,.ignore', wrapper:'div',
                                       errorPlacement: function(error, element) {
                                                            error.appendTo(element.closest('.rminput'));
                                                          }
                                    });
JSHD;
        return $str;
    }

    protected function insert_JS($form)
    {
        $max_page_count = count($this->get_form_pages());
        $form_identifier = "form_".$this->get_form_id();
        $form_id = $this->get_form_id();
        $validator_js = $this->get_jqvalidator_config_JS();
        
      
        $jqvalidate = RM_Utilities::enqueue_external_scripts('rm_jquery_validate', RM_BASE_URL."public/js/jquery.validate.min.js");
      
        $jqvalidate .= RM_Utilities::enqueue_external_scripts('rm_jquery_validate_add', RM_BASE_URL."public/js/additional-methods.min.js");
        $jq_front_form_script = RM_Utilities::enqueue_external_scripts('rm_front_form_script', RM_BASE_URL."public/js/rm_front_form.js");
        $mainstr = <<<JSHD
                
   <pre class='rm-pre-wrapper-for-script-tags'><script>
        
   /*form specific onload functionality*/
jQuery(document).ready(function () {
if(jQuery("#{$form_identifier}_{$this->form_number} [name='rm_payment_method']").length>0 && jQuery("#{$form_identifier}_{$this->form_number} [name='rm_payment_method']:checked").val()=='stripe'){jQuery('#rm_stripe_fields_container_{$form_id}_{$this->form_number}').show();}
    jQuery(".rm_payment_method_select").each(function(){jQuery(this).click(setup_payment_method_visibility(jQuery(this).val(),{$form_id},{$this->form_number}));});

    jQuery('[data-rm-unique="1"]').change(function(event) {
        rm_unique_field_check(jQuery(this));
    });
    
   });
                
if (typeof window['rm_multipage'] == 'undefined') {

    rm_multipage = {
        global_page_no_{$form_identifier}_{$this->form_number}: 1
    };

}
else
 rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} = 1;

function gotonext_{$form_identifier}_{$this->form_number}(){
	
        var maxpage = {$max_page_count} ;
        {$validator_js}        
        
        var jq_prev_button = jQuery("#rm_prev_form_page_button_{$form_id}_{$this->form_number}");
        var jq_next_button = jQuery("#rm_next_form_page_button_{$form_id}_{$this->form_number}");
        var sub_label = jq_next_button.data("label-sub");
        var next_label = jq_next_button.data("label-next");
        var payment_method = jQuery('[name=rm_payment_method]:checked').val();
        
        if(typeof payment_method == 'undefined' || payment_method != 'stripe')
        {            
            elements_to_validate = jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").not('#rm_stripe_fields_container_{$form_id}_{$this->form_number} :input');
        }
        else
            var elements_to_validate = jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input");
            
        if(elements_to_validate.length > 0)
        {
            var valid = elements_to_validate.valid();
                        
            if(!valid)
            {
                jQuery(document).find("input.rm-form-field-invalid-msg")[0].focus(); 
                return;
            }
        }
        
        /* Server validation for Username and Email field */
        for(var i=0;i<rm_validation_attr.length;i++){
            var validation_flag= true;
            jQuery("[" + rm_validation_attr[i] + "=0]").each(function(){
               validation_flag= false;
               return false;
            });
            
            if(!validation_flag)
              return;
        }
        
        
        rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}++;
        
        /*skip blank form pages*/
        while(jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").length == 0)
        {
        
            if(maxpage <= rm_multipage.global_page_no_{$form_identifier}_{$this->form_number})
            {
                    if(jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").length == 0){
                        jq_next_button.prop('type','submit');
                        jq_prev_button.prop('disabled',true);
                        return;
                    }        
                    else
                        break;
            }
        
            rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}++;
        }
            
	if(rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} >= maxpage)
            jq_next_button.attr("value", sub_label);
        
	if(maxpage < rm_multipage.global_page_no_{$form_identifier}_{$this->form_number})
	{
		rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} = maxpage;
		jq_next_button.prop('type','submit');
                jq_prev_button.prop('disabled',true);
		return;
	}
	jQuery(".rmformpage_{$form_identifier}_{$this->form_number}").each(function (){
		var visibledivid = "rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number};
		if(jQuery(this).attr('id') == visibledivid)
			jQuery(this).show();
		else
			jQuery(this).hide();                
	})  
                jQuery('.rmformpage_{$form_identifier}_{$this->form_number}').find(':input').filter(':visible').eq(0).focus();
    jq_prev_button.prop('disabled',false);
        rmInitGoogleApi();
}
    </script></pre>
JSHD;

$prev_button_str = <<<JSPBHD
<pre class='rm-pre-wrapper-for-script-tags'><script>
function gotoprev_{$form_identifier}_{$this->form_number}(){
	
	var maxpage = {$max_page_count} ;
        var jq_prev_button = jQuery("#rm_prev_form_page_button_{$form_id}_{$this->form_number}");
        var jq_next_button = jQuery("#rm_next_form_page_button_{$form_id}_{$this->form_number}");
        var sub_label = jq_next_button.data("label-sub");
        var next_label = jq_next_button.data("label-next");
        
	rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}--;
        jq_next_button.attr('type','button');        
        
        /*skip blank form pages*/
        while(jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").length == 0)
        {
            if(1 >= rm_multipage.global_page_no_{$form_identifier}_{$this->form_number})
            {
                    if(jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").length == 0){
                        rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} = 1;
                        jq_prev_button.prop('disabled',true);
                        return;
                    }        
                    else
                        break;
            }
        
            rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}--;
        }
        
        if(rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} <= maxpage-1)
            jq_next_button.attr("value", next_label);
            
	jQuery(".rmformpage_{$form_identifier}_{$this->form_number}").each(function (){
		var visibledivid = "rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number};
		if(jQuery(this).attr('id') == visibledivid)
			jQuery(this).show();
		else
			jQuery(this).hide();
	})
        jQuery('.rmformpage_{$form_identifier}_{$this->form_number}').find(':input').filter(':visible').eq(0).focus();
        if(rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} <= 1)
        {
            rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} = 1;
            jq_prev_button.prop('disabled',true);
        }
}
         
</script></pre>
JSPBHD;
            
        if($this->form_options->no_prev_button)    
        $str = $jqvalidate.$jq_front_form_script.$mainstr;
        else
        $str = $jqvalidate.$jq_front_form_script.$mainstr.$prev_button_str;
        
   
        $form->addElement(new Element_HTML($str));
    }

}
