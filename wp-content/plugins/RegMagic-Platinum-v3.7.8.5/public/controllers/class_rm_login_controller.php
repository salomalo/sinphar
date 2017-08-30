<?php

class RM_Login_Controller{

    public $mv_handler;

    function __construct(){
        $this->mv_handler= new RM_Model_View_Handler();
    }

    public function form($model,$service,$request,$params){
        if(isset($request->req['rm_target']))
        {
            if($request->req['rm_target'] == 'fbcb')
            {
                $service->facebook_login_callback();
                
            }
        }
        //handle twitter callback
        $session_token=isset($_SESSION['token'])?$_SESSION['token']:null;
        $req_token=isset($request->req['oauth_token'])?$request->req['oauth_token']:null;
        if($session_token == $req_token && $req_token !=null) 
            {
            $data= new stdClass();
            $data->twitter= $service->get_twitter_keys();
            if($data->twitter['enable_twitter'] == 'yes')
                {
                    $view= $this->mv_handler->setView('login',true);
                    return $view->read($data);
                }
            }
        if ($this->mv_handler->validateForm("rm_login_form"))
        {
            $user= $service->login($request);
            
            if (is_wp_error($user)) {
                RM_PFBC_Form::setError('rm_login_form',$user->get_error_message());
            }else{
                $redirect_to= RM_Utilities::after_login_redirect($user);
                
                if(!$redirect_to)
                    $redirect_to = apply_filters( 'login_redirect', admin_url(), "", $user );
                RM_Utilities::redirect($redirect_to);
                die;
            }
        }

        $data= new stdClass();
        //$service->facebook_login_callback();
   
        $data->facebook_html= $service->facebook_login_html();
        $data->google_html=$service->google_login_html();
        $data->linkedin_html= $service->linkedin_login_html();
        $data->windows_html= $service->windows_login_html();
        $data->twitter_html=$service->twitter_login_html();
        $data->instagarm_html=$service->instagarm_login_html();
        //$data->yahoo_html=$service->yahoo_login_html();
        $view= $this->mv_handler->setView('login',true);
        return $view->read($data);
    }
}
