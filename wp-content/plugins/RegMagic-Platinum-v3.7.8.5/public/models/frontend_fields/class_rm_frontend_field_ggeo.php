<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_rm_frontend_field_ggeo
 *
 * @author RegistrationMagic
 */
class RM_Frontend_Field_GGeo extends RM_Frontend_Field_Base
{

    private $api_key;

    public function __construct($id, $type,$field_name, $label, $options, $gmaps_api_key , $page_no, $is_primary = false, $extra_opts = null)
    {
        parent::__construct($id, $type,$field_name, $label, $options, $page_no,$is_primary, $extra_opts);
        $this->api_key = $gmaps_api_key;
       
    }

    public function get_pfbc_field()
    {
        if ($this->pfbc_field)
            return $this->pfbc_field;
        else
        {
           
            if ($this->api_key)
            {
                $field_cls = 'Element_' . $this->get_field_type();
                $label = $this->get_formatted_label();
                $this->pfbc_field = new $field_cls($label, $this->field_name, $this->api_key, $this->field_options);
                
            } else
            {
                $this->pfbc_field = new Element_HTMLP('<div class="rmrow"><div class="rmfield"><label>'.$this->field_label.'</label></div><div class="rminput"><div class="field_rendor_error">'.RM_UI_Strings::get('MSG_FRONT_NO_GOOGLE_API_KEY').'</div></div></div>');
            }
            $this->add_custom_validations();
            return $this->pfbc_field;
        }
    }
}
