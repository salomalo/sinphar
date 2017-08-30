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
class RM_Services {

    protected $model;
    public $mailchimpService;

    public function __construct($model = null) {
        $this->model = $model;

        if ($this->get_setting('enable_mailchimp') == 'yes')
            $this->mailchimpService = new RM_MailChimp_Service();
    }

    public function get_fields_highest_order($form_id, $form_page_no) {
        $highest_order = 0;
        $z = RM_DBManager::get('FIELDS', array('form_id' => $form_id, 'page_no' => $form_page_no), array('%d', '%d'), 'col', 0, 2, 'field_order', 'field_order', true);

        if ($z && is_array($z) && count($z) > 0) {
            $highest_order = $z[0];
        }

        return $highest_order;
    }

    public function add() {
        return $this->model->insert_into_db();
    }

    public function add_user_form() {

        $form_id = $this->model->insert_into_db();

        $this->add_default_form_fields($form_id, false);

        return $form_id;
    }

    public function update($form_id) {
        return $this->model->update_into_db();
    }

    public function get_all($model_identifier = null, $offset = 0, $limit = 0, $column = '*', $sort_by = '', $descending = false) {

        if (!$model_identifier)
            $model_identifier = $this->model->get_identifier();

        $results = RM_DBManager::get_all($model_identifier, $offset, $limit, $column, $sort_by, $descending);

        return $results;
    }

    public function count($model_identifier, $args, $data_specifier = '') {
        return RM_DBManager::count($model_identifier, $args, $data_specifier);
    }

    public function get_user($user_id, $field_name) {
        $user = new RM_User($user_id);
        return $user->get($field_name);
    }

    public function get($model_identifier, $where, $data_specifier, $result_type = 'results', $offset = 0, $limit = 15, $column = '*', $sort_by = null, $descending = false) {
        return RM_DBManager::get($model_identifier, $where, $data_specifier, $result_type, $offset, $limit, $column, $sort_by, $descending);
    }

    public function duplicate($unique_ids, $model_identifier = null) {
        if (!$model_identifier) {
            $model_identifier = $this->model->get_identifier();
        }

        $ids = array();

        $model_name = RM_Utilities::get_class_name_for($model_identifier);

        $model = new $model_name;
        if (is_array($unique_ids)) {
            foreach ($unique_ids as $unique_id) {
                $model->load_from_db($unique_id, false);
                if($model instanceof RM_Forms)
                    $model->set_form_name($model->get_form_name().'(copy)');
                $ids[$unique_id] = $model->insert_into_db();
            }
        } elseif ((int) $unique_ids) {
            $model->load_from_db($unique_ids, false);
            if($model instanceof RM_Forms)
                $model->set_form_name($model->get_form_name().'(copy)');
            $ids[$unique_ids] = $model->insert_into_db();
        } else
            return false;

        return $ids;
    }

    public function remove($unique_ids, $model_identifier = null, $where = null) {
        if (!$model_identifier) {
            $model_identifier = $this->model->get_identifier();
        }

        if (is_array($unique_ids)) {
            foreach ($unique_ids as $unique_id) {
                RM_DBManager::remove_row($model_identifier, $unique_id, $where);
            }
        } elseif ((int) $unique_ids) {
            RM_DBManager::remove_row($model_identifier, $unique_ids, $where);
        } else
            return false;
    }

    public function remove_submissions($unique_ids, $where = null) {
        $model_identifier = 'SUBMISSIONS';

        if (is_array($unique_ids)) {
            foreach ($unique_ids as $unique_id) {
                RM_DBManager::remove_row($model_identifier, $unique_id, $where);
                RM_DBManager::delete_rows('SUBMISSION_FIELDS', array('submission_id' => $unique_id), array('%d'));
            }
        } elseif ((int) $unique_ids) {
            RM_DBManager::remove_row($model_identifier, $unique_ids, $where);
            RM_DBManager::delete_rows('SUBMISSION_FIELDS', array('submission_id' => $unique_ids), array('%d'));
        } else
            return false;
    }

    public function save_options($options) {
        return $this->model->set_values($options);
    }

    public function get_mailchimp_list() {
        $result = $this->mailchimpService->get_list();
        $lists = array(null => RM_UI_Strings::get('OPTION_SELECT_LIST'));
        if (!empty($result)) {
            foreach ($result['lists'] as $key => $list) {
                $lists[$list['id']] = $list['name'];
            }
        }

        return $lists;
    }

    public function get_all_form_fields($form_id) {
        if ((int) $form_id)
            return RM_DBManager::get_fields_by_form_id($form_id);
        else
            return false;
    }

    public function add_default_form_fields($form_id, $is_reg_form) {

        $this->create_default_email_field($form_id);
    }

    public function create_default_password_field($form_id) {

        $field = new RM_Fields;
        $field->set(array('form_id' => $form_id,
            'field_type' => 'Password',
            'field_label' => 'Password',
            'field_placeholder' => 'Password',
            'field_css_class' => 'rm_form_default_fields',
            'field_is_required' => 1,
            'field_show_on_user_page' => 0,
            'field_is_read_only' => 0,
            'field_is_editable' => 0,
            'field_max_length' => 50,
            'is_field_primary' => 1));

        return $field->insert_into_db();
    }

    public function create_default_username_field($form_id) {

        $field = new RM_Fields;
        $field->set(array('form_id' => $form_id,
            'field_type' => 'Textbox',
            'field_label' => 'User Name',
            'field_placeholder' => 'User Name',
            'field_css_class' => 'rm_form_default_fields',
            'field_is_required' => 1,
            'field_show_on_user_page' => 1,
            'field_is_read_only' => 0,
            'field_is_editable' => 0,
            'field_max_length' => 70,
            'is_field_primary' => 1));

        return $field->insert_into_db();
    }

    public function create_default_email_field($form_id) {

        $field = new RM_Fields;
        $field->set(array('form_id' => $form_id,
            'field_type' => 'Email',
            'page_no' => 1,
            'field_label' => 'Email',
            'field_placeholder' => 'Email',
            'field_css_class' => 'rm_form_default_fields',
            'field_is_required' => 1,
            'field_show_on_user_page' => 0,
            'field_is_editable' => 0,
            'field_is_read_only' => 0,
            'is_field_primary' => 1));

        return $field->insert_into_db();
    }

    public function remove_form_fields($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_fields($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_fields($form_id);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function get_setting($name) {
        $global_settings = new RM_Options;
        $result = $global_settings->get_value_of($name);
        return $result;
    }

    public function set_setting($name, $value) {
        $global_settings = new RM_Options;
        $result = $global_settings->set_value_of($name, $value);
    }

    public function is_form_expired($form) {
        if (!$form->get_form_should_auto_expire()) {
            return false;
        }

        $form_id = $form->form_id;
        $criterian = $form->form_options->form_expired_by;
        $submission_limit = $form->form_options->form_submissions_limit;
        return $this->is_form_expired_core($form_id, $criterian, $submission_limit);
    }

    public $form_id_array = array();
    public $field_id_array = array();
    public $submission_id_array = array();
    public $user_id_array = array();

        public static function import_form_first_ajax() {
        $form_id = null;
        if (isset($_POST['form_id'])) {
            $form_id = $_POST['form_id'];
        }        
        echo self::import_form_first(null, $form_id);
        wp_die();
    }
    
    public static function import_form_first($custom_file = null, $form_id = null) {
        
        $form_id_next = null;
        $name = !$custom_file ? get_temp_dir() . 'RMagic.xml': $custom_file;
        $xml = simplexml_load_file($name) or die('INVALID_FILE');
        $rm_ser_tmp = new RM_Services;
        $xmldata = $rm_ser_tmp->xml2array($xml);
        //Importing Non form dependent data (paypal and frint user) starts
        if ($form_id == null) {
            foreach ($xmldata as $data_identifier => $data_value) {
                if ($data_identifier == 'FRONT_USERS') {
                    if (isset($data_value[0])) {
                        foreach ($data_value as $form_data) {
                            $form_data_tmp = $rm_ser_tmp->xml2array($form_data);
                            $result = $rm_ser_tmp->import_front_users($form_data_tmp);
                        }
                    } else {
                        $form_data_tmp = $rm_ser_tmp->xml2array($data_value);
                        $result = $rm_ser_tmp->import_front_users($form_data_tmp);
                    }
                } elseif ($data_identifier == 'PAYPAL_FIELDS') {
                    if (isset($data_value[0])) {
                        foreach ($data_value as $form_data) {
                            $form_data_tmp = $rm_ser_tmp->xml2array($form_data);
                            $result = $rm_ser_tmp->import_paypal_fields($form_data_tmp);
                        }
                    } else {
                        $form_data_tmp = $rm_ser_tmp->xml2array($data_value);
                        $result = $rm_ser_tmp->import_paypal_fields($form_data_tmp);
                    }
                }
            }
        }
        //Importing Non form dependent data (paypal and frint user) ENDS
        $counter = 0;
        $form_data_tmp = array();
        //Importing  form dependent data STARTS
        foreach ($xmldata as $data_identifier => $data_value) {
            if ($data_identifier == 'FORMS') {
                if (isset($data_value[0])) {
                    foreach ($data_value as $form_data) {
                        if (isset($form_id)) {
                            if ($form_data->OPTIONS->form_id == $form_id) {
                                $form_data_tmp = $rm_ser_tmp->xml2array($form_data);
                                $rm_ser_tmp->import_form($form_data_tmp);
                            } else {
                                if (isset($form_data->OPTIONS->form_id) && $form_data->OPTIONS->form_id >= $form_id) {
                                    $form_id_next = $form_data->OPTIONS->form_id;
                                    return $form_id_next;
                                } else {
                                    $form_data_tmp = null;
                                }
                            }
                        } else {
                            $counter++;
                            if ($counter == 1) {
                                $form_data_tmp = $rm_ser_tmp->xml2array($form_data);
                                $result = $rm_ser_tmp->import_form($form_data_tmp);
                            } else {
                                if (isset($form_data->OPTIONS->form_id)) {
                                    $form_id_next = $form_data->OPTIONS->form_id;
                                    return $form_id_next;
                                } else
                                    return 0;
                            }
                        }
                    }
                }
                else {
                    $form_data_tmp = $rm_ser_tmp->xml2array($data_value);
                    $rm_ser_tmp->import_form($form_data_tmp);
                    return 0;
                }
            }
        }
        //Importing  form dependent data STARTS
    }
    
    public function xml2array($xmlObject, $out = array()) {
        foreach ((array) $xmlObject as $index => $node)
            $out[$index] = ( is_object($node) && !empty($node) ) ? $this->xml2array($node) : $node;

        return $out;
    }

    public function import_form($data_value) {

        set_time_limit(300);
        // ini_set('max_execution_time', 300);
        $model_identifier = 'FORMS';
        $value = $data_value;

        $rm_sr = new RM_Services;

        $data = array();
        $data_format = array();
        $form_id_old = null;
        $data_format = $rm_sr->get_format_specifer($model_identifier);

        foreach ($data_value as $data_identifier => $data_value) {
            //echo "<pre>",var_dump($data_value);

            if ($data_identifier == 'OPTIONS') {
                foreach ($data_value as $form_attr_name => $attr_value) {
                    if ($form_attr_name != 'form_id') {
                        if ($attr_value == "") {
                            $data[$form_attr_name] = null;
                        } else {

                            $data[$form_attr_name] = (string) $attr_value;
                        }
                    } else {

                        $form_id_old = (int) $attr_value;
                    }
                }

                $form_id_new = RM_DBManager::insert_row($model_identifier, $data, $data_format);
                $rm_sr->form_id_array[$form_id_old] = $form_id_new;
            }
            if ($data_identifier == 'FIELDS') {
                if (isset($data_value[0])) {
                    foreach ($data_value as $field_data) {
                        $result = $rm_sr->import_fields($form_id_new, $field_data);
                        // echo "Field ID:-",$result,"</br>"; 
                    }
                } else {
                    $result = $rm_sr->import_fields($form_id_new, $data_value);
                }
                // $data_value= $this->xml2array($frield_data);
                //echo "Field ID:-",$result,"</br>"; 
            } elseif ($data_identifier == 'SUBMISSIONS') {
                if (isset($data_value[0])) {
                    foreach ($data_value as $field_data) {
                        $result = $rm_sr->import_submissions($form_id_new, $field_data);
                        //   echo "Submission ID:-",$result,"</br>";
                    }                    
                } else {
                    $result = $rm_sr->import_submissions($form_id_new, $data_value);
                }
                //fix up child ids
                    foreach($rm_sr->submission_id_array as $old_id => $new_id)
                    {
                        $temp_sub = new RM_Submissions;
                        $temp_sub->load_from_db($new_id);
                        $child_id = $temp_sub->get_child_id();
                        $last_child_id = $temp_sub->get_last_child();
                        if($child_id && isset($rm_sr->submission_id_array[$child_id]))
                            $temp_sub->set_child_id($rm_sr->submission_id_array[$child_id]);
                        else
                            $temp_sub->set_child_id (0);
                        if($last_child_id && isset($rm_sr->submission_id_array[$last_child_id]))
                            $temp_sub->set_last_child($rm_sr->submission_id_array[$last_child_id]);
                        else
                            $temp_sub->set_last_child($new_id);
                        
                        $temp_sub->update_into_db();
                    }
                    //Fix ends
            } elseif ($data_identifier == 'NOTES') {
                if (isset($data_value[0])) {
                    foreach ($data_value as $field_data) {
                        $result = $rm_sr->import_notes($form_id_new, $field_data);
                        //   echo "Notes ID:-",$result,"</br>";
                    }
                } else {
                    $result = $rm_sr->import_notes($form_id_new, $data_value);
                }
            } elseif ($data_identifier == 'STATS') {
                if (isset($data_value[0])) {
                    foreach ($data_value as $field_data) {
                        $result = $rm_sr->import_stats($form_id_new, $field_data);
                        // echo "Stat ID:-",$result,"</br>";
                    }
                } else {
                    $result = $rm_sr->import_stats($form_id_new, $data_value);
                }
            } elseif ($data_identifier == 'SUBMISSION_FIELDS') {
                if (isset($data_value[0])) {
                    foreach ($data_value as $field_data) {
                        $result = $rm_sr->import_submission_field($form_id_new, $field_data);
                        // echo "Submission field ID:-",$result,"</br>"; 
                    }
                } else {
                    $result = $rm_sr->import_submission_field($form_id_new, $data_value);
                }
            } elseif ($data_identifier == 'PAYPAL_LOGS') {
                if (isset($data_value[0])) {
                    foreach ($data_value as $field_data) {
                        $result = $rm_sr->import_paypal_log($form_id_new, $field_data);
                        //   echo "Paypal Log ID:-",$result,"</br>";
                    }
                } else {
                    $result = $rm_sr->import_paypal_log($form_id_new, $data_value);
                }
            } else {
                
            }
        }

        return $form_id_new;
    }

    public function import_fields($form_id_new, $fields) {

        $data = array();
        $data_format = array();
        $data_identifier = 'FIELDS';

        $data_format = $this->get_format_specifer($data_identifier);
        foreach ($fields as $field_attr_name => $attr_value) {
            if ($field_attr_name != 'field_id') {
                if ($attr_value == "") {
                    $data[$field_attr_name] = null;
                } else
                    $data[$field_attr_name] = (string) $attr_value;
            } else
                $field_id_old = (int) $attr_value;

            if ($field_attr_name == 'form_id') {
                $data[$field_attr_name] = $form_id_new;
            }
        }




        $field_id_new = RM_DBManager::insert_row($data_identifier, $data, $data_format);
        // Removing unnecessary data
        $rm_field= new RM_Fields();
        $rm_field->load_from_db($field_id_new);
        $rm_field->remove_conditions();
        $this->field_id_array[$field_id_old] = $field_id_new;
        return $field_id_new;
    }

    public function import_submissions($form_id_new, $submissions) {

        $all_data = array();
        $data_format = array();
        $data_identifier = 'SUBMISSIONS';

        $data_format = $this->get_format_specifer($data_identifier);


        foreach ($submissions as $submission_attr_name => $attr_value) {

            if ($submission_attr_name != 'submission_id') {
                if ($attr_value == "") {
                    $all_data[$submission_attr_name] = null;
                } else
                    $all_data[$submission_attr_name] = $attr_value;
            } else
                $submission_id_old = (int) $attr_value;
            if ($submission_attr_name == 'form_id') {
                $all_data[$submission_attr_name] = $form_id_new;
            } elseif ($submission_attr_name == 'data') {
                //Mapping new field id in submission object

                $val = $attr_value;

                $val = maybe_unserialize((string) $val);
                $new_val = array();
                foreach ($val as $key => $data) {
                    if (isset($this->field_id_array[$key]))
                        $key = $this->field_id_array[$key];
                    $new_val[$key] = $data;
                }
                $all_data[$submission_attr_name] = maybe_serialize($new_val);
            }
            else {
                
            }
        }

        $submission_id_new = RM_DBManager::insert_row($data_identifier, $all_data, $data_format);
        $this->submission_id_array[$submission_id_old] = $submission_id_new;
        return $submission_id_new;
    }

    public function import_front_users($submissions) {
        $data = array();
        $data_format = array();
        $data_identifier = 'FRONT_USERS';
        $data_format = $this->get_format_specifer($data_identifier);
        foreach ($submissions as $submission_attr_name => $attr_value) {
            if ($submission_attr_name != 'id') {
                if ($attr_value == "") {

                    $data[$submission_attr_name] = null;
                } else
                    $data[$submission_attr_name] = $attr_value;
            }
        }

        $front_user_id_new = RM_DBManager::insert_row($data_identifier, $data, $data_format);
        return $front_user_id_new;
    }

    public function import_notes($form_id_new, $submissions) {
        $data = array();
        $data_format = array();
        $data_identifier = 'NOTES';

        $data_format = $this->get_format_specifer($data_identifier);
        foreach ($submissions as $submission_attr_name => $attr_value) {
            if ($submission_attr_name != 'note_id') {
                if ($attr_value == "") {
                    $data[$submission_attr_name] = null;
                } else
                    $data[$submission_attr_name] = $attr_value;
            } else
                $submission_id_old = $attr_value;
            if ($submission_attr_name == 'form_id') {
                $data[$submission_attr_name] = $form_id_new;
            } elseif ($submission_attr_name == 'submission_id') {
                if (isset($this->submission_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->submission_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            elseif ($submission_attr_name == 'field_id') {
                if (isset($this->field_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->field_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            else {
                
            }
        }
        $note_id_new = RM_DBManager::insert_row($data_identifier, $data, $data_format);
        return $note_id_new;
    }

    public function import_paypal_fields($submissions) {
        $data = array();
        $data_format = array();
        $data_identifier = 'PAYPAL_FIELDS';

        $data_format = $this->get_format_specifer($data_identifier);
        foreach ($submissions as $submission_attr_name => $attr_value) {
            if ($submission_attr_name != 'field_id') {
                if ($attr_value == "") {
                    $data[$submission_attr_name] = null;
                } else
                    $data[$submission_attr_name] = $attr_value;
            } else
                $submission_id_old = $attr_value;
            if ($submission_attr_name == 'form_id') {
                $data[$submission_attr_name] = $form_id_new;
            } elseif ($submission_attr_name == 'submission_id') {
                if (isset($this->submission_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->submission_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            elseif ($submission_attr_name == 'field_id') {
                if (isset($this->field_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->field_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            else {
                
            }
        }

        $field_id_new = RM_DBManager::insert_row($data_identifier, $data, $data_format);
        return $field_id_new;
    }

    /* public function import_wp_users_meta($submissions)
      {

      $data=array();
      $data_format=array();
      $data_identifier='WP_USERS_META';

      $data_format=$this->get_format_specifer($data_identifier);
      $flag=false;

      if(isset($this->user_id_array[(int)$submissions['user_id']]))
      $flag=true;
      foreach($submissions as $submission_attr_name=>$attr_value)
      {

      if($submission_attr_name != 'umeta_id' && $submission_attr_name != 'data_identifier'  )
      $data[$submission_attr_name]= $attr_value;
      else

      $submission_id_old= $attr_value;

      if($submission_attr_name=='form_id')
      {
      $data[$submission_attr_name]= $form_id_new;
      }
      elseif($submission_attr_name=='user_id')
      {
      if(isset( $this->user_id_array[(int)$attr_value]))
      $data[$submission_attr_name]= $this->user_id_array[(int)$attr_value];
      }
      elseif($submission_attr_name=='field_id')
      {
      if(isset( $this->field_id_array[(int)$attr_value]))
      $data[$submission_attr_name]= $this->field_id_array[(int)$attr_value];
      }
      else
      {
      }
      }
      if($flag==true)
      $field_id_new = RM_DBManager::insert_row($data_identifier, $data, $data_format);

      return true;

      } */
    /*  public function import_wp_users($submissions)
      {
      $data=array();
      $data_format=array();
      $data_identifier='WP_USERS';

      $data_format=$this->get_format_specifer($data_identifier);
      foreach($submissions as $submission_attr_name=>$attr_value)
      {
      if($submission_attr_name != 'ID' && $submission_attr_name != 'data_identifier')
      $data[$submission_attr_name]= $attr_value;
      else
      $submission_id_old= $attr_value;

      }

      if(!email_exists( $data['user_email'] ))
      {
      $field_id_new = RM_DBManager::insert_row($data_identifier, $data, $data_format);


      $this->user_id_array[$submission_id_old]=$field_id_new;


      }
      return true;
      }
     */

    public function import_stats($form_id_new, $submissions) {
        $data = array();
        $data_format = array();
        $data_identifier = 'STATS';

        $data_format = $this->get_format_specifer($data_identifier);
        foreach ($submissions as $submission_attr_name => $attr_value) {
            if ($submission_attr_name != 'stat_id') {
                if ($attr_value == "") {
                    $attr_value = null;
                } else
                    $data[$submission_attr_name] = $attr_value;
            }
            if ($submission_attr_name == 'form_id') {
                $data[$submission_attr_name] = $form_id_new;
            } else
                $submission_id_old = $attr_value;
            if ($submission_attr_name == 'form_id') {
                $data[$submission_attr_name] = $form_id_new;
            } elseif ($submission_attr_name == 'submission_id') {
                if (isset($this->submission_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->submission_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            elseif ($submission_attr_name == 'field_id') {
                if (isset($this->field_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->field_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            else {
                
            }
        }
        //echo "<pre>",var_dump($form_id_new);

        $stat_id_new = RM_DBManager::insert_row($data_identifier, $data, $data_format);
        return $stat_id_new;
    }

    public function import_submission_field($form_id_new, $submissions) {
        $data = array();
        $data_format = array();
        $data_identifier = 'SUBMISSION_FIELDS';

        $data_format = $this->get_format_specifer($data_identifier);
        foreach ($submissions as $submission_attr_name => $attr_value) {
            if ($submission_attr_name != 'sub_field_id') {
                if ($attr_value == "") {
                    $data[$submission_attr_name] = null;
                } else
                    $data[$submission_attr_name] = $attr_value;
            } else
                $submission_id_old = $attr_value;
            if ($submission_attr_name == 'form_id') {
                $data[$submission_attr_name] = $form_id_new;
            } elseif ($submission_attr_name == 'submission_id') {
                if (isset($this->submission_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->submission_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            elseif ($submission_attr_name == 'field_id') {
                if (isset($this->field_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->field_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            else {
                
            }
        }

        $submission_id_new = RM_DBManager::insert_row($data_identifier, $data, $data_format);
        return $submission_id_new;
    }

    public function import_paypal_log($form_id_new, $submissions) {
        $data = array();
        $data_format = array();
        $data_identifier = 'PAYPAL_LOGS';

        $data_format = $this->get_format_specifer($data_identifier);
        foreach ($submissions as $submission_attr_name => $attr_value) {
            if ($submission_attr_name != 'id') {
                if ($attr_value == "") {
                    $data[$submission_attr_name] = null;
                } else
                    $data[$submission_attr_name] = $attr_value;
            } else
                $submission_id_old = $attr_value;
            if ($submission_attr_name == 'form_id') {
                $data[$submission_attr_name] = $form_id_new;
            } elseif ($submission_attr_name == 'submission_id') {
                if (isset($this->submission_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->submission_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            elseif ($submission_attr_name == 'field_id') {
                if (isset($this->field_id_array[(int) $attr_value]))
                    $data[$submission_attr_name] = $this->field_id_array[(int) $attr_value];
                else
                    $data[$submission_attr_name] = null;
            }
            else {
                
            }
        }

        $paypal_log_id_new = RM_DBManager::insert_row($data_identifier, $data, $data_format);
        return $paypal_log_id_new;
    }

    public function get_format_specifer($model_identifier) {
        switch ($model_identifier) {
            case 'FORMS': {
                //14 attributes + 1 Primary Key
                    return array(
                        '%s',//form_name
                        '%d',//form_type
                        '%s',//form_user_role
                        '%s',//default_user_role
                        '%d',//form_should_send_email
                        '%s',//form_redirect
                        '%s',//form_redirect_to_page
                        '%s',//form_redirect_to_url
                        '%d',//form_should_auto_expire
                        '%s',//form_options
                        '%s',//created_on
                        '%d',//created_by
                        '%s',//modified_on
                        '%d'//modified_by
                    );
                    break;
                }
            case 'FIELDS': {
                  //10 attributes + 1 Primary Key
                    return array(
                        '%d',//form_id
                        '%d',//page_no
                        '%s',//field_label
                        '%s',//field_type
                        '%s',//field_value
                        '%d',//field_value
                        '%d',//field_show_on_user_page
                        '%d',//is_field_primary
                        '%d',//field_is_editable
                        '%s'//field_options
                    );
                    break;
                }
            case 'SUBMISSIONS': {
                  //8 attributes + 1 Primary Key
                    return array(
                        '%d',//form_id
                        '%s',//data
                        '%s',//user_email
                        '%d',//child_id
                        '%d',//last_child
                        '%s',//submitted_on
                        '%s',//unique_token
                        '%d'//is_read
                    );
                    break;
                }
            case 'NOTES': {
                  //8 attributes + 1 Primary Key
                    return array(
                        '%d',//submission_id
                        '%s',//notes
                        '%s',//status
                        '%s',//publication_date
                        '%d',//published_by
                        '%s',//last_edit_date
                        '%d',//last_edited_by
                        '%s'//note_options
                    );
                    break;
                }
            case 'FRONT_USERS': {
                  //4 attributes + 1 Primary Key
                    return array(
                        '%s',//email
                        '%s',//otp_code
                        '%s',//last_activity_time
                        '%s'//created_date
                    );
                    break;
                }
            case 'PAYPAL_FIELDS': {
                  //11 attributes + 1 Primary Key
                    return array(
                        '%s',//type
                        '%s',//name
                        '%s',//value
                        '%s',//class
                        '%s',//option_label
                        '%s',//option_price
                        '%s',//option_value
                        '%s',//description
                        '%s',//require
                        '%d',//order
                        '%s'//extra_options
                    );
                    break;
                }
            case 'PAYPAL_LOGS': {
                  //9 attributes + 1 Primary Key
                    return array(
                        '%d',//submission_id
                        '%d',//form_id
                        '%s',//invoice
                        '%s',//txn_id
                        '%s',//status
                        '%d',//total_amount
                        '%s',//currency
                        '%s',//log
                        '%s',//posted_date
                        '%s',//pay proc
                        '%s',//bill
                        '%s'//ex_data
                    );
                    break;
                }
            case 'STATS': {
                  //8 attributes + 1 Primary Key
                    return array(
                        '%d',//form_id
                        '%s',//user_ip
                        '%s',//ua_string
                        '%s',//browser_name
                        '%s',//visited_on
                        '%s',//submitted_on
                        '%d',//time_taken
                        '%d'//submission_id
                    );
                    break;
                }
            case 'SUBMISSION_FIELDS': {
                  //4 attributes + 1 Primary Key
                    return array(
                        '%d',//submission_id
                        '%d',//field_id
                        '%d',//form_id
                        '%s'//value
                    );
                    break;
                }

            case 'WP_USERS': {
                    return array(
                        '%s',//type
                        '%s',//type
                        '%s',//type
                        '%s',//type
                        '%s',//type
                        '%s',//type
                        '%s',//type
                        '%d',//type
                        '%s'//type
                    );
                    break;
                }
            case 'WP_USERS_META': {
                    return array(
                        '%d',//type
                        '%s',//type
                        '%s',//type
                    );
                    break;
                }
            default:
                return null;
        }
    }

    public function is_form_expired_core($form_id, $criterion, $submission_limit) {
        if ($criterion == "date") {
            if (RM_DBManager::is_expired_by_date($form_id))
                return true;
        }elseif ($criterion == "submissions") {
            if (RM_DBManager::is_expired_by_submissions($form_id, $submission_limit))
                return true;
        }elseif ($criterion == "both") {
            return (RM_DBManager::is_expired_by_date($form_id) || RM_DBManager::is_expired_by_submissions($form_id, $submission_limit));
        }
    }

    //Can pass form as an object of form model or a db row loaded from forms tabel. Set the flag accordingly
    public function get_form_expiry_stats($form, $is_form_object = true) {
        if ($is_form_object) {
            $form_id = $form->get_form_id();
            $form_options = $form->get_form_options();
            $criterian = $form_options->form_expired_by;
            $form_should_auto_expire = $form->get_form_should_auto_expire();
        } else {
            $form_id = $form->form_id;
            $form_options = maybe_unserialize($form->form_options);
            $criterian = $form_options->form_expired_by;
            $form_should_auto_expire = $form->form_should_auto_expire;
        }
        $remaining = (object) array('state' => 'perpetual',
                    'criteria' => 'both',
                    'remaining_days' => 'undefined',
                    'remaining_subs' => 'undefined',
                    'sub_limit' => 0,
                    'date_limit' => 0);
        if (!$form_should_auto_expire) {
            return $remaining;
        }
        if ($criterian == "date") {
            if (RM_DBManager::is_expired_by_date($form_id, $remaining->remaining_days)) {
                $remaining->state = 'expired';
                $remaining->criteria = 'date';
                $remaining->date_limit = $form_options->form_expiry_date;
            } else {
                $remaining->state = 'not_expired';
                $remaining->criteria = 'date';
                $remaining->date_limit = $form_options->form_expiry_date;
            }
            return $remaining;
        } elseif ($criterian == "submissions") {
            if (RM_DBManager::is_expired_by_submissions($form_id, $form_options->form_submissions_limit, $remaining->remaining_subs)) {
                $remaining->state = 'expired';
                $remaining->criteria = 'subs';
                $remaining->sub_limit = $form_options->form_submissions_limit;
            } else {
                $remaining->state = 'not_expired';
                $remaining->criteria = 'subs';
                $remaining->sub_limit = $form_options->form_submissions_limit;
            }
            return $remaining;
        } elseif ($criterian == "both") {
            if (RM_DBManager::is_expired_by_date($form_id, $remaining->remaining_days) || RM_DBManager::is_expired_by_submissions($form_id, $form_options->form_submissions_limit, $remaining->remaining_subs)) {
                $remaining->state = 'expired';
                $remaining->criteria = 'both';
                $remaining->sub_limit = $form_options->form_submissions_limit;
                $remaining->date_limit = $form_options->form_expiry_date;
            } else {
                $remaining->state = 'not_expired';
                $remaining->criteria = 'both';
                $remaining->sub_limit = $form_options->form_submissions_limit;
                $remaining->date_limit = $form_options->form_expiry_date;
            }
            return $remaining;
        }
    }

    public function delete_rows($model_identifier, $where, $where_format = null) {
        return RM_DBManager::delete_rows($model_identifier, $where, $where_format);
    }

    public function duplicate_form_fields($form_id, $ids) {
        if (is_array($form_id))
            foreach ($form_id as $formId) {
                $fields = RM_DBManager::get_fields_by_form_id($formId);
                foreach ($fields as $field)
                    $this->duplicate_field($field->field_id, $ids[$formId]);
            } elseif ((int) $form_id) {
            $fields = RM_DBManager::get_fields_by_form_id($form_id);
            foreach ($fields as $field)
                $this->duplicate_field($field->field_id, $ids[$form_id]);
        } else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function duplicate_field($field_id, $form_id) {
        $model = new RM_Fields;
        $model->load_from_db($field_id, false);
        $model->set_form_id($form_id);
        $model->remove_conditions();    
        $model->insert_into_db();
    }

    public function set_field_order($list) {
        RM_DBManager::set_field_order($list);
    }

    public function set_page_order($form_id, $list) {
        RM_DBManager::set_form_page_order($form_id, $list);
    }

    public function get_submissions_by_email($user_email, $limit = 9999999, $offset = 0, $sort_by = '', $descending = true) {
        return RM_DBManager::get_submissions_for_user($user_email, $limit, $offset, $sort_by, $descending);
    }

    public function get_payments_by_email($user_email, $limit = 9999999, $offset = 0, $sort_by = '', $descending = true) {


        $submission_ids = $this->get_submissions_by_email($user_email, $limit, $offset, $sort_by, $descending);

        return get_payments_by_submission_id($submission_ids, $limit, $offset, $sort_by, $descending);
    }

    public function get_payments_by_submission_id($submission_ids, $limit = 9999999, $offset = 0, $sort_by = '', $descending = false) {
            
        if (is_array($submission_ids))
            $fields = RM_DBManager::get_results_for_array('PAYPAL_LOGS', 'submission_id', $submission_ids);
        elseif ((int) $submission_ids)
            $fields = $this->get('PAYPAL_LOGS', array('submission_id' => $submission_ids), array('%d'), 'row', $offset, $limit, '*', $sort_by, $descending);
        else
            return false;
        
        if (!$fields)
            return false;

        return $fields;
    }

    public function remove_form_submissions($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_submissions($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_submissions($form_id);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function remove_form_stats($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_stats($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_stats($form_id);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function remove_form_notes($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_notes($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_notes($form_id);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function remove_form_payment_logs($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_payment_logs($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_payment_logs($form_id);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function remove_submission_payment_logs($sub_id) {
        if (is_array($sub_id))
            foreach ($sub_id as $sub_id_)
                RM_DBManager::delete_rows('PAYPAL_LOGS', array('submission_id' => $sub_id_));
        elseif ((int) $sub_id)
            RM_DBManager::delete_rows('PAYPAL_LOGS', array('submission_id' => $sub_id));
        else
            throw new InvalidArgumentException("Invalid Submission ID '$sub_id'.");
    }

    public function remove_submission_notes($sub_id) {
        if (is_array($sub_id))
            foreach ($sub_id as $sub_id_)
                RM_DBManager::delete_rows('NOTES', array('submission_id' => $sub_id_));
        elseif ((int) $sub_id)
            RM_DBManager::delete_rows('NOTES', array('submission_id' => $sub_id));
        else
            throw new InvalidArgumentException("Invalid Submission ID '$sub_id'.");
    }

    public function get_submissions_to_export(RM_Submission_Filter $filter=null) {
        
        $export_data = array();
        $is_payment = false;
        $option = new RM_Options;
        
        $form_id = $filter->get_form();
        
        if (!(int) $form_id)
            return false;

        $fields = $this->get_all_form_fields($form_id);

        if (!$fields)
            return false;
            
        $field_ids = array();
        $export_data[0]['s_id']= 'Submission ID';
        //$export_data[0]['u_token']= 'Unique Token';
        
        foreach ($fields as $field) {
            if (!in_array($field->field_type,RM_Utilities::csv_excluded_widgets())) {
                $field_ids[] = $field->field_id;
                $export_data[0][$field->field_id] = $field->field_label;
            }
            $i = 0;
            if ($field->field_type == 'Price' && $i == 0) {
                $is_payment = true;                
                $i++;
            }
        }
        
        if($is_payment)
        {
            $export_data[0]['invoice'] = 'Payment Invoice';
            $export_data[0]['txn_id'] = 'Payment TXN Id';
            $export_data[0]['status'] = 'Payment Status';
            $export_data[0]['total_amount'] = 'Paid Amount';
            $export_data[0]['date'] = 'Date of Payment';
        }

    if (!$filter || !$filter->is_active()) {
            $submission_ids = $this->get('SUBMISSIONS', array('form_id' => $form_id, 'child_id' => 0 ), array('%d', '%d'), 'col', 0, 0, 'submission_id', null, true);
            if (!$submission_ids)
                return false;
            $submissions = RM_DBManager::get_results_for_array('SUBMISSION_FIELDS', 'field_id', $field_ids);
        }
        else {
            $submission_ids = RM_DBManager::get_submissions($form_id,$filter,'*','submission_id', true, 'col',false);//RM_DBManager::get_results_for_last_col($search->interval, $form_id, $search->id, $search->value);
            if (!$submission_ids)
                return false;
            $submissions = RM_DBManager::get_sub_fields_for_array('SUBMISSION_FIELDS', 'field_id', $field_ids, 'submission_id', $submission_ids);
        }

        foreach ($submission_ids as $s_id) {
            $export_data[$s_id] = array();
            $export_data[$s_id]['s_id']= $s_id;
            /*$submission= new RM_Submissions();
            $submission->load_from_db($s_id);
            $export_data[$s_id]['u_token']= $submission->get_unique_token();*/
            $parent_s_id = RM_DBManager::get_oldest_submission_from_group($s_id);
            if(!$parent_s_id)
                $parent_s_id = $s_id;
            $payment = $this->get('PAYPAL_LOGS', array('submission_id' => $parent_s_id), array('%d'), 'row', 0, 10, '*', null, true);

            foreach ($field_ids as $f_id) {
                $export_data[$s_id][$f_id] = null;
            }

            if ($is_payment) {
                $export_data[$s_id]['invoice'] = isset($payment->invoice) ? $payment->invoice : null;
                $export_data[$s_id]['txn_id'] = isset($payment->txn_id) ? $payment->txn_id : null;
                $export_data[$s_id]['status'] = isset($payment->status) ? $payment->status : null;
                $export_data[$s_id]['total_amount'] = isset($payment->total_amount) ? $option->get_formatted_amount($payment->total_amount, $payment->currency) : null;
                $export_data[$s_id]['date'] = isset($payment->posted_date) ? RM_Utilities::localize_time($payment->posted_date, get_option('date_format')) : null;
            }
        }

        foreach ($submissions as $submission) {
            $value = maybe_unserialize($submission->value);
            if (is_array($value)) {
                if (isset($value['rm_field_type']) && $value['rm_field_type'] == 'File') {
                    unset($value['rm_field_type']);
                    if (count($value) == 0)
                        $value = null;
                    else {
                        $file = array();
                        foreach ($value as $a)
                            $file[] = wp_get_attachment_url($a);

                        $value = implode(',', $file);
                    }
                }elseif (isset($value['rm_field_type']) && $value['rm_field_type'] == 'Address'){
                       unset($value['rm_field_type']);
                       foreach($value as $in =>  $val){
                           if(empty($val))
                               unset($value[$in]);
                       }
                    $value = implode(',', $value);   
                } else
                    $value = implode(', ',RM_Utilities::get_lable_for_option($submission->field_id, $value));
            }
            else
                $value = RM_Utilities::get_lable_for_option($submission->field_id, $value);
            
            $value = html_entity_decode($value);
            
            if (array_key_exists($submission->submission_id, $export_data))
                $export_data[$submission->submission_id][$submission->field_id] = stripslashes($value);
        }
           
        return $export_data;
    }

    public function create_csv($data) {

        $csv_name = 'rm_submissions' . time() . mt_rand(10, 1000000);
        $csv_path = get_temp_dir() . $csv_name . '.csv';
        $csv = fopen($csv_path, "w");
        
        if (!$csv) {
            return false;
        }
        
        //Add UTF-8 header for proper encoding of the file
        //Thanks to Kristjan Johanson.
        fputs($csv, chr(0xEF).chr(0xBB).chr(0xBF) );
        
        foreach ($data as $a) {
            if (!fputcsv($csv, $a))
                return false;
        }

        fclose($csv);

        return $csv_path;
    }

    public function download_file($file, $unlink = true) {
        if (ob_get_contents()) {
            ob_end_clean();
        }
        //var_dump(RM_Utilities::mime_content_type($file));die();
        if (file_exists($file)) {
            $mime_type = RM_Utilities::mime_content_type($file);
            header('Content-Description: File Transfer');
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            readfile($file);
            if ($unlink)
                unlink($file);
            exit;
        } else
            return false;

        return true;
    }

    public function manage_form_page($action, $form_id, $page_no = null, $new_page_name = null) {
        $form = new RM_Forms;
        $form->load_from_db($form_id);
        $fopts = $form->get_form_options();
        $form_pages = $fopts->form_pages;
        $ordered_form_pages = $fopts->ordered_form_pages;

        switch ($action) {
            case 'add_page':
                if ($form_pages == null) {
                    $form_pages = array('Page 1', 'Page 2');
                    $ordered_form_pages = array(0, 1);
                } else {
                    $total_page = count($form_pages);

                    $new_page_no = 0;
                    foreach ($form_pages as $index => $fpage) {
                        if ($index >= $new_page_name)
                            $new_page_no = $index;
                    }
                    $new_page_no += 2;
                    $last_added_page_no = count($form_pages);
                    $form_pages[] = 'Page ' . $new_page_no;
                    if (!$ordered_form_pages) {
                        $ordered_form_pages = array_keys($form_pages);
                    } else
                        $ordered_form_pages[] = $last_added_page_no;
                }
                break;

            case 'delete_page':
                if ($form_pages == null || !$page_no) {
                    return;
                } else {
                    if ($page_no == 1)
                        return; //can't delete first page.
                    if (isset($form_pages[$page_no - 1])) {
                        RM_DBManager::remove_fields_for_page($page_no, $form_id);
                        unset($form_pages[$page_no - 1]);
                        $page_to_be_removed = array_search($page_no - 1, $ordered_form_pages);
                        if (isset($ordered_form_pages[$page_to_be_removed]))
                            unset($ordered_form_pages[$page_to_be_removed]);
                        //remove holes
                        $ordered_form_pages = array_values($ordered_form_pages);
                    }
                }
                break;

            case 'rename_page':
                if ($form_pages == null) {
                    $form_pages = array('Page 1');
                }
                if (!$page_no || !$new_page_name) {
                    return;
                } else {
                    if (isset($form_pages[$page_no - 1]))
                        $form_pages[$page_no - 1] = $new_page_name;
                }

                break;
        }

        $x = (object) array('form_pages' => $form_pages, 'ordered_form_pages' => $ordered_form_pages);
        $form->set_form_options($x);
        $form->update_into_db();
        return count($form_pages);
    }

    public function get_custom_fields($user_email) {

        $field_ids = array();
        $forms = array();
        $custom_fields = array();

        $submissions = $this->get('SUBMISSIONS', array('user_email' => $user_email), array('%s'), 'results', 0, 999999, '*', null, false);

        if (!$submissions)
            return false;

        if (is_array($submissions) || is_object($submissions))
            foreach ($submissions as $submission) {
                if (!in_array($submission, $forms)) {
                    $forms[] = $submission->form_id;
                    $result = $this->get('FIELDS', array('form_id' => $submission->form_id, 'field_show_on_user_page' => 1), array('%s', '%d'), 'results', 0, 999999, '*', null, false);
                    if ($result){
                        $data = maybe_unserialize($submission->data);
                        $field_ids[$submission->submission_id] = (object)array('field' => $result, 'sub_data' => $data);                                            
                    }
                }
            }

        foreach ($field_ids as $submission_id => $res) {
            foreach ($res->field as $f_row) {

                $result = $this->get('SUBMISSION_FIELDS', array('submission_id' => $submission_id, 'field_id' => $f_row->field_id), array('%d', '%d'), 'var', 0, 999999, 'value', null, false);

                if ($result) {
                    $custom_fields[$f_row->field_id] = new stdClass();
                    $custom_fields[$f_row->field_id]->label = $f_row->field_label;
                    $custom_fields[$f_row->field_id]->value = $result;
                    $custom_fields[$f_row->field_id]->type = $f_row->field_type;
                    $custom_fields[$f_row->field_id]->is_editable = $f_row->field_is_editable;
                    $custom_fields[$f_row->field_id]->form_id = $f_row->form_id;
                    $custom_fields[$f_row->field_id]->meta = isset($res->sub_data[$f_row->field_id], $res->sub_data[$f_row->field_id]->meta) ? $res->sub_data[$f_row->field_id]->meta: null;//$f_row->form_id;
                }
            }
        }

        if (count($custom_fields) == 0)
            return null;

        return $custom_fields;
    }

    public function get_editable_fields($form_id) {
        global $wpdb;
        $table_name = $wpdb->prefix.'rm_fields';
        if ((int) $form_id) {
            $db_fields = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `form_id` = $form_id AND `field_is_editable` = 1 AND `field_type` != 'Price' ORDER BY `page_no` ASC, `field_order` ASC");

            if (!$db_fields || !is_array($db_fields))
                return null;

            $fields = array();
            foreach ($db_fields as $db_field) {
                $fields[$db_field->field_id] = $db_field;
            }
            return $fields;
        }
        return false;
    }
    
    public function get_editable_fields_for_admin($form_id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix.'rm_fields';
        if ((int) $form_id) {
            $db_fields = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `form_id` = $form_id AND `field_type` != 'Price' ORDER BY `page_no` ASC, `field_order` ASC");
 
            if (!$db_fields || !is_array($db_fields))
                return null;
 
            $fields = array();
            foreach ($db_fields as $db_field) {
                $fields[$db_field->field_id] = $db_field;
            }
            return $fields;
        }
        return false;
    }

    public function output_pdf_for_submission(RM_Submissions $submission, $outputconf = array('name' => 'rm_submission.pdf', 'type' => 'D')) {

        $data = new stdClass();

        $settings = new RM_Options;

        $data->submission = $submission;

        $data->payment = $this->get('PAYPAL_LOGS', array('submission_id' => $submission->get_submission_id()), array('%d'), 'row', 0, 99999);

        if ($data->payment != null)
            $data->payment->total_amount = $settings->get_formatted_amount($data->payment->total_amount, $data->payment->currency);

        /*
         * Check submission type
         */
        $form = new RM_Forms();
        $form->load_from_db($submission->get_form_id());
        $form_type = $form->get_form_type() == "1" ? "Registration" : "Non WP Account";
        $data->form_type = $form_type;
        $data->form_type_status = $form->get_form_type();
        $data->form_name = $form->get_form_name();
        $data->form_is_unique_token = $form->get_form_is_unique_token();

        /*
         * User details if form is registration type
         */
        if ($form->get_form_type() == "1") {
            $email = $submission->get_user_email();
            if ($email != "") {
                $user = get_user_by('email', $email);
                $data->user = $user;
            }
        }

        $mv_handler = new RM_Model_View_Handler;
        $view = $mv_handler->setView('print_submission');
        $html = $view->read($data);
        $header_data = $this->get_headerdata();
        RM_Utilities::create_pdf($html, $header_data, $outputconf);
    }

    private function get_headerdata() {
        $headerdata = array();
        $g_opt = new RM_Options();
        $logo = $g_opt->get_value_of('sub_pdf_header_img');
        if (is_numeric($logo)) {
            $logo_url = get_attached_file($logo);
            if ($logo_url)
                $headerdata['logo'] = $logo_url;
            else
                $headerdata['logo'] = null;
        }
        $title = $g_opt->get_value_of('sub_pdf_header_text');
        $headerdata['header_text'] = $title;
        $headerdata['title'] = 'Submission';

        return $headerdata;
    }

    public function get_latest_submission_for_user($user_email, $form_ids = array()) {
        return RM_DBManager::get_latest_submission_for_user($user_email, $form_ids);
    }
    
    //get the newest submission's id from a group of edited submissions
    public function get_latest_submission_from_group($submission_id){
        return RM_DBManager::get_latest_submission_from_group($submission_id);
    }
    
    //get the oldest submission's id from a group of edited submissions
    public function get_oldest_submission_from_group($submission_id){
        return RM_DBManager::get_oldest_submission_from_group($submission_id);
    }
    
    //Update submit field config for specified form
    public function update_submit_field_config($form_id, $config){ 
        $form = new RM_Forms;
        if($form->load_from_db($form_id)) {
            $form->form_options->no_prev_button = ($config['hide_prev_btn'] === "true") ? 1: 0;
            $form->form_options->form_btn_align = $config['btn_align'];
            
            $sub_btn = trim($config['submit_btn_label']);
            $next_btn = trim($config['next_btn_label']);
            $prev_btn = trim($config['prev_btn_label']);
            
            if($next_btn)
                $form->form_options->form_next_btn_label = $next_btn;
            
            if($prev_btn)
                $form->form_options->form_prev_btn_label = $prev_btn;            
            
            if($sub_btn)
                $form->form_options->form_submit_btn_label = $sub_btn;
            
            $form->update_into_db();
        }
    }
    
    //Update form details for specified form, invoked from formcard menu
    public function fcm_update_form($form_id, $config){ 
        $form = new RM_Forms;
        if($form->load_from_db($form_id)) {
            
            $form_name = "";
            if(isset($config['form_name']))
                $form_name = trim($config['form_name']);
            
            if($form_name)
                $form->form_name = $form_name;
            
            $form->update_into_db();
        }
    }
}
