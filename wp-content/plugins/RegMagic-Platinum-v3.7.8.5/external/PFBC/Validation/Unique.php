<?php
class Validation_Unique extends Validation{
	protected $message;
        protected $handler;
        
	public function __construct($message = "",$handler=null) {
                $this->handler= $handler;
		//if(!empty($message))
		$this->message = empty($message) ? "Error: %element%  should be unique." : $message;
	}
        
        public function getMessage() {
		return $this->message;
	}

	public function isNotApplicable($value) {
		if(is_null($value) || is_array($value) || $value === "")
			return true;
		return false;
	}

	public function isValid($value)
        {
            if($this->handler==null)
                return true;
            return $this->handler->is_valid($value);
        }

}