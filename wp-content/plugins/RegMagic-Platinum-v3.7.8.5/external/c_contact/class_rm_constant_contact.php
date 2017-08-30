<?php
// require the autoloaders

require_once 'cc/autoload.php';
use Ctct\ConstantContact;
use Ctct\Components\Contacts\Contact;
//use Ctct\Exceptions\CtctException;

class RM_CContact
{
    private $api_key;
    private $access_token; 
    private $cc; 
     
   
    public function __construct($options=null)
    {
       
        $this->api_key=$options['cc_app_key'];
        $this->access_token=$options['cc_access_token'];
        $this->cc = new ConstantContact($this->api_key);
    }
    
 public function fetch_list()
     {
          $lists = $this->cc->listService->getLists($this->access_token);
          return $lists;
     }
     public function add_contact($contacts,$list)
     {
       
            $contact = new Contact();
            $contact->addEmail($contacts['email']);
            $contact->addList($list);
            if(isset($contacts['first_name']))
            $contact->first_name = $contacts['first_name'];
            if(isset($contacts['middle_name']))
            $contact->middle_name = $contacts['middle_name'];
            if(isset($contacts['last_name']))
            $contact->last_name = $contacts['last_name'];
            if(isset($contacts['job_title']))
            $contact->job_title = $contacts['job_title'];
            if(isset($contacts['company_name']))
            $contact->company_name = $contacts['company_name']; 
            if(isset($contacts['work_phone']))
            $contact->work_phone = $contacts['work_phone'];
            if(isset($contacts['home_phone']))
            $contact->home_phone = $contacts['home_phone'];
            if(isset($contacts['cell_phone']))
            $contact->cell_phone = $contacts['cell_phone'];
            //if(isset($contacts['address']))
            //$contact->cell_phone = $contacts['address'];
            $returnContact = $this->cc->contactService->addContact($this->access_token, $contact);
        
         return $returnContact;
     }


     
}
