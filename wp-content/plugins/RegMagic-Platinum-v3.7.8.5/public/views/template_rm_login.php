<script src="https://use.fontawesome.com/220be48d0d.js"></script>

<?php

/**
 * View template file of the plugin
 *
 * @internal Add form page view.
 */

$form = new RM_PFBC_Form("rm_login_form");
$form->configure(array(
    "prevent" => array("bootstrap", "jQuery"),
    "action" => ""
));
if(isset($data->twitter))
{
include_once(RM_EXTERNAL_DIR."twitter/inc/twitteroauth.php");
        $connection = new TwitterOAuth($data->twitter['tw_consumer_key'], $data->twitter['tw_consumer_secret'], $_SESSION['token'] , $_SESSION['token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($connection->http_code == '200')
	{
		//Redirect user to twitter
		$_SESSION['status'] = 'verified';
		$_SESSION['request_vars'] = $access_token;
		
		//Insert user into the database
		$user_info = $connection->get('account/verify_credentials', array('include_email' => 'true')); 
		unset($_SESSION['token']);
		unset($_SESSION['token_secret']);
                 ?>
	<pre class="rm-pre-wrapper-for-script-tags"><script type="text/javascript" >
            var email='<?php echo $user_info->email;?>';
             var name='<?php echo $user_info->name;?>';
             handle_data(email,name);
	</script></pre> <?php
             
	}
}
else{
$form->addElement(new Element_Hidden("rm_slug", "rm_login_form"));
$form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_USERNAME'), "username", array("required" => "1")));
$form->addElement(new Element_Password(RM_UI_Strings::get('LABEL_PASSWORD'), "password",array("required"=>1)));
$form->addElement(new Element_HTML('<div class="rmrow"><div class="rmfield" for="rm_login_form-element-3"></div><div class="rminput"><ul class="rmradio" style="list-style:none;"><li class="rm-login-remember"> <input id="rm_login_form-element-3-0" type="checkbox" name="remember[]" value="1" checked="checked"><label for="rm_login_form-element-3-0"><span>Remember me</span></label> </li> </ul></div></div>'));
?>
  
    
    <?php
/*
 * Checking if recpatcha is enabled
 */
if(get_option('rm_option_enable_captcha')=="yes")
    $form->addElement(new Element_Captcha());
$form->addElement(new Element_Button(RM_UI_Strings::get('LABEL_LOGIN'), "submit", array("id" => "rm_submit_btn", "class" => "rm_btn rm_login_btn", "name" => "submit")));
$form->addElement(new Element_HTML('<div class="rm_forgot_pass"><a href="'.  wp_lostpassword_url() .'" target="blank">'.RM_UI_Strings::get('MSG_LOST_PASS').'</a></div>'));

/*
 * Render the form if user is not logged in
 */
?>
<div class='rmagic'>    
<div class='rmcontent rm-login-wrapper'>
<?php
if(!is_user_logged_in()){ ?>
    <div class="rm-thirdp-login-button-wrap"><?php
    echo $data->google_html;
    echo $data->facebook_html;
    echo $data->linkedin_html;
    echo $data->windows_html;
    echo $data->twitter_html;
    echo $data->instagarm_html;
     ?></div>
    <?php
    $form->render();
  
   ?>

    <?php
}
else{
    echo '<div class="rm_notice">'.RM_UI_Strings::get('LOGGED_STATUS').' <a href="'.wp_logout_url( get_permalink() ).'">'.RM_UI_Strings::get("LABEL_LOGOUT").'</a></div>';
}
}
?>
	</div>
</div>


