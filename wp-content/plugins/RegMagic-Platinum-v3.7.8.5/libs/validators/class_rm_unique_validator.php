<?php

class RM_Unique_Validator implements RM_Validator
{
    protected $field_id;
    
    public function __construct($field_id) {
        $this->field_id= $field_id;
    }
    public function is_valid($value)
    {
        if(empty($value)) return true;
        $count= RM_DBManager::count("SUBMISSION_FIELDS",array('field_id' => $this->field_id,'value'=>$value),array('%d','%s'));
        return $count>0?false: true;
    }
}
