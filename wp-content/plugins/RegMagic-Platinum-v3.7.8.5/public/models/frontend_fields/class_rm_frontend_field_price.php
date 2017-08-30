<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RM_Frontend_Field_Price extends RM_Frontend_Field_Base
{

    protected $currency_pos;
    protected $curr_symbol;
    protected $pp_field_id;

    public function __construct($id, $label,$field_name, $options, $field_value, $currency_pos, $currency_symbol, $page_no = 1, $is_primary = false, $extra_opts = null)
    {
        parent::__construct($id, 'Price',$field_name, $label, $options, $page_no, $is_primary, $extra_opts);
        $this->pp_field_id = $field_value;
      
        $field_name = $this->field_type . "_" . $this->field_id . "_" . $this->pp_field_id;
        $this->set_field_name($field_name);
        $this->currency_pos = $currency_pos;
        $this->curr_symbol = $currency_symbol;
    }

    public function get_pfbc_field()
    {
        if ($this->pfbc_field)
            return $this->pfbc_field;
        else
        {
            $pfbc_field_array = array();
            $paypal_field = new RM_PayPal_Fields();
            $res = $paypal_field->load_from_db($this->pp_field_id);

            if (!$res)
                return null;

            $label = $this->get_formatted_label();
            $name = $this->field_name;
            //$pfbc_field_array[] = new Element_Hidden('rm_payment_form', 'pp');

            $properties = array();

            if (isset($this->field_options['required']))
                $properties['required'] = '1';
            
            if (isset($this->field_options['longDesc']))
                $properties['longDesc'] = $this->field_options['longDesc'];
            
            if (isset($this->field_options['style']))
                $properties['style'] = $this->field_options['style']; 
            
            if (isset($this->field_options['labelStyle']))
                $properties['labelStyle'] = $this->field_options['labelStyle'];
            
            $properties['data-rmfieldtype'] = 'price';
            
            $quantity_field = ($paypal_field->get_extra_options('allow_quantity') == 'yes') ? new Element_Number('&times;',$name."_qty", array('title' => 'Quantity', 'value' => 1, 'min' => 1, 'step' => 1, 'class' => 'rm_price_field_quantity')) : null;
            
            switch ($paypal_field->get_type())
            {
                case "fixed":
                    if ($this->currency_pos == 'before')
                        $properties['value'] = $paypal_field->get_name() . " (" . $this->curr_symbol . " " . $paypal_field->get_value() . ")";
                    else
                        $properties['value'] = $paypal_field->get_name() . " (" . $paypal_field->get_value() . " " . $this->curr_symbol . ")";
                    $properties['readonly'] = 1;
                    $properties['class'] = $paypal_field->get_class();
                    $properties['data-rmfieldprice'] = $paypal_field->get_value();
                    
                    if ($paypal_field->get_extra_options('show_on_form') != 'yes')
                        $element = new Element_Hidden($name, $properties['value'], $properties);
                    else
                        $element = new Element_Textbox($label, $name, $properties, array('exclass_row'=>'rm_pricefield_row','sub_element'=>$quantity_field));
                    break;

                case "userdef":
                    if (isset($properties['readonly']))
                        unset($properties['readonly']);
                    if (isset($properties['value']))
                        unset($properties['value']);
                    $properties['class'] = $paypal_field->get_class();
                    $properties['placeholder'] = $paypal_field->get_name();
                    $properties['class'] = $paypal_field->get_class();
                    $properties['min'] = 0.01;
                    //$properties['step'] = 0.01;
                    $element = new Element_Number($label, $name, $properties);
                    break;


                case "multisel":
                case "dropdown":
                    //echo '<pre>'; var_dump($paypal_field); die;
                    $labels = maybe_unserialize($paypal_field->get_option_label());
                    $prices = maybe_unserialize($paypal_field->get_option_price());
                    $vals = array();
                    $temp = array();
                    $i = 0;
                    foreach ($prices as $price)
                    {
                        {
                            if ($this->currency_pos == 'before')
                                $vals["_" . $i] = $labels[$i] . " (" . $this->curr_symbol . " " . $price . ")";
                            else
                                $vals["_" . $i] = $labels[$i] . " (" . $price . " " . $this->curr_symbol . ")";
                        }
                        
                        $temp["_".$i] = $price;
                        
                        $i++;
                    }

                    $properties['data-rmfieldprice'] = json_encode($temp);
                    $properties['id'] = 'id_rm_multisel_paypal_field';
                    
                    if ($paypal_field->get_type() == 'multisel')
                        $element = new Element_Checkbox($label, $name, $vals, $properties, array('exclass_row'=>'rm_pricefield_checkbox','sub_element'=>$quantity_field));
                    else
                    {
                        if (!isset($field_data->properties['required']))
                            $vals = array(null => RM_UI_Strings::get('SELECT_FIELD_FIRST_OPTION')) + $vals;
                        $element = new Element_Select($label, $name, $vals, $properties, array('exclass_row'=>'rm_pricefield_row','sub_element'=>$quantity_field));
                    }
                    break;
            }

            $pfbc_field_array[] = $element;

            $this->pfbc_field = $pfbc_field_array;

            return $this->pfbc_field;
        }
    }

    public function get_prepared_data($request)
    {
        $paypal_field = new RM_PayPal_Fields();
        $res = $paypal_field->load_from_db($this->pp_field_id);

        if (!$res)
            return null;

        switch ($paypal_field->get_type())
        {
            case "fixed":
                if(isset($request[$this->field_name."_qty"]))
                    $quantity = intval($request[$this->field_name."_qty"]);
                else
                    $quantity = 1;
                $value = isset($request[$this->field_name]) ? $request[$this->field_name] : null;
                $value = $value ? "$value &times; $quantity" : null;
                break;
                
            case "userdef":
                $data = new stdClass;
                $data->field_id = $this->get_field_id();
                $data->type = 'Price';
                $data->label = $this->get_field_label();
                $price_entered = isset($request[$this->field_name])?trim($request[$this->field_name]):null;
                $data->value = !$price_entered? null : $price_entered;
                
                if($data->value)
                {
                    if ($this->currency_pos == 'before')
                        $data->value = $this->curr_symbol . " " . $data->value;
                    else
                        $data->value = $data->value . " " . $this->curr_symbol;
                }                
                return $data;              
            
            case "multisel":
                $tmp_v = maybe_unserialize($paypal_field->get_option_price());
                $tmp_l = maybe_unserialize($paypal_field->get_option_label());
                $gopt = new RM_Options;
                $val_arr = array();
                $value = isset($request[$this->field_name]) ? $request[$this->field_name] : null;

                if ($value)
                {
                    foreach ($value as $pf_single_val)
                    {
                        $index = (int) substr($pf_single_val, 1);
                        if (!isset($tmp_v[$index]))
                            continue;    
                        if(isset($request[$this->field_name."_qty"], $request[$this->field_name."_qty"][$pf_single_val]))
                            $quantity = intval($request[$this->field_name."_qty"][$pf_single_val]);
                        else
                            $quantity = 1;
                        $val_arr[] = $tmp_l[$index] . " (" . $gopt->get_formatted_amount($tmp_v[$index]) . ") &times; $quantity";
                    }
                    $value = $val_arr;
                }
                break;

            case "dropdown":
                $tmp_v = maybe_unserialize($paypal_field->get_option_price());
                $tmp_l = maybe_unserialize($paypal_field->get_option_label());
                $gopt = new RM_Options;
                $value = isset($request[$this->field_name]) ? $request[$this->field_name] : null;
                if ($value)
                {
                    $index = (int) substr($value, 1);
                    if (!isset($tmp_v[$index]))
                        break;
                    
                    if(isset($request[$this->field_name."_qty"]))
                        $quantity = intval($request[$this->field_name."_qty"]);
                    else
                        $quantity = 1;
                    
                    $value = $tmp_l[$index] . " (" . $gopt->get_formatted_amount($tmp_v[$index]) . ") &times; $quantity";
                }
                break;
        }
        
        $data = new stdClass;
        $data->field_id = $this->get_field_id();
        $data->type = 'Price';
        $data->label = $this->get_field_label();
        $data->value = $value;
        return $data;
    }
    
    //Returns details of the price fields submitted by user in an stdClass object containing following fields..
    // billing ==> it contains an array of individual objects holding product name, price and quantity in 'label', 'price' and 'qty' fields respectively.
    // total ==> total amount for that particular field as submitted by user after multiplying with quantity (and adding all user selected prices in case of multi-select field). (It is NOT the total amount for all the price fields in a form).
    
     public function get_pricing_detail($request)
    {
        $paypal_field = new RM_PayPal_Fields();
        $res = $paypal_field->load_from_db($this->pp_field_id);

        if (!$res)
            return null;
        
        $total_price = 0.0;
        $billing = array();
        
        switch ($paypal_field->get_type())
        {
            case "fixed":         
                if(isset($request[$this->field_name."_qty"]))
                    $quantity = intval($request[$this->field_name."_qty"]);
                else
                    $quantity = 1;
                $price = floatval($paypal_field->get_value());
                $total_price = $price * $quantity;
                $billing[] = (object)array('label'=>$paypal_field->get_name(), 'price'=>$price, 'qty' => $quantity);
                break;
                
            case "userdef":
                if ($request[$this->field_name] == "")
                        break;                    
                $total_price = floatval($request[$this->field_name]);   
                $total_price = round($total_price, 2);
                $billing[] = (object)array('label'=>$paypal_field->get_name(), 'price'=>$total_price, 'qty' => 1);           
                break;
                
            case "multisel":
                $tmp_v = maybe_unserialize($paypal_field->get_option_price());
                $tmp_l = maybe_unserialize($paypal_field->get_option_label());
                $gopt = new RM_Options;
                
                $value = isset($request[$this->field_name]) ? $request[$this->field_name] : null;
                
                if ($value)
                {
                    foreach ($value as $pf_single_val)
                    {
                        $index = (int) substr($pf_single_val, 1);
                        if (!isset($tmp_v[$index]))
                            continue;
                        
                        if(isset($request[$this->field_name."_qty"], $request[$this->field_name."_qty"][$pf_single_val]))
                            $quantity = intval($request[$this->field_name."_qty"][$pf_single_val]);
                        else
                            $quantity = 1;
                        
                        $total_price += floatval($tmp_v[$index]) * $quantity;
                        $billing[] = (object)array('label'=>$tmp_l[$index], 'price'=>floatval($tmp_v[$index]),'qty' => $quantity);
                    }
                    
                }
                break;

            case "dropdown":
                $tmp_v = maybe_unserialize($paypal_field->get_option_price());
                $tmp_l = maybe_unserialize($paypal_field->get_option_label());
                $gopt = new RM_Options;
                $value = isset($request[$this->field_name]) ? $request[$this->field_name] : null;
                if ($value)
                {
                    $index = (int) substr($value, 1);
                    if (!isset($tmp_v[$index]))
                        break;
                    
                    if(isset($request[$this->field_name."_qty"]))
                        $quantity = intval($request[$this->field_name."_qty"]);
                    else
                        $quantity = 1;
                    
                    $total_price = floatval($tmp_v[$index]) * $quantity;                   
                    $billing[] = (object)array('label'=>$tmp_l[$index], 'price'=>floatval($tmp_v[$index]), 'qty' => $quantity);
                }
                break;
        }
        
         $value = (object)array('billing'=>$billing, 'total_price'=>$total_price);
         return $value;
    }

}
