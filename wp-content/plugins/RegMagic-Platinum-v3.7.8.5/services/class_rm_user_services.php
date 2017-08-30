<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class responsible for User and Roles related operations
 *
 * @author CMSHelplive
 */
class RM_User_Services extends RM_Services
{

    private $default_user_roles = array('administrator', 'editor', 'author', 'contributor', 'subscriber');

    public function get_user_roles()
    {
        $roles = get_editable_roles();
        //echo '<pre>';var_dump($roles);die;
        $role_names = array();
        foreach ($roles as $key => $role)
        {
            $role_names[$key] = $role['name'];
        }

        return $role_names;
    }
public function add_default_form($form=null,$role=null)
    {
        $role =isset($_POST['role'])? $_POST['role'] : null;
        $form =isset($_POST['form'])? $_POST['form'] : null;
       if(isset($role) && isset($form))
       {
           $gopts= new RM_Options;
           $default_forms=array();
           $opt_default_forms=$gopts->get_value_of('rm_option_default_forms');
           $default_forms= maybe_unserialize($opt_default_forms);
           $def=$default_forms;
           foreach($def as $key => $val)
           {
               if($val == $form)
               {
                   $default_forms[$key] = null;
               }
           }
           if($form == '')
           {
                $default_forms[$role]=null;
                $opt_default_forms=  maybe_serialize($default_forms);
                $gopts->set_value_of('rm_option_default_forms',$opt_default_forms);
                echo "";die;  
           }  
           $default_forms[$role]=$form;
           $opt_default_forms=  maybe_serialize($default_forms);
           $gopts->set_value_of('rm_option_default_forms',$opt_default_forms);
           $forms_options=new RM_Forms;
           $forms_options->load_from_db($form);
           $form_name=$forms_options->get_form_name();
           echo $form_name;die;
          
       }
       echo "";die;
    }
    // This function creates a copy of the role with a different name
    public function create_role($role_name, $display_name, $capability, $additional_data = null)
    {
        $role = get_role($capability);
        
        $is_paid = false;
        $amount = null;
        
        if($additional_data)
        {
           if(isset($additional_data['is_paid']))
               $is_paid = $additional_data['is_paid'];
           
           if(isset($additional_data['amount']))
               $amount = $additional_data['amount'];           
        }
        
        if (add_role($role_name, $display_name, $role->capabilities) !== null)
        {
            $user_role_custom_data = $this->get_setting('user_role_custom_data');
            
            if(!$user_role_custom_data || count($user_role_custom_data) == 0)
                $user_role_custom_data = array($role_name => (object)array('is_paid' => $is_paid, 'amount' => $amount));
            else
                $user_role_custom_data[$role_name] = (object)array('is_paid' => $is_paid, 'amount' => $amount);
            
            $this->set_setting('user_role_custom_data', $user_role_custom_data);
            
            return true;
        }
        else
            return false;
    }

    public function get_roles_by_status()
    {
        $roles_data = new stdClass();
        $roles = $this->get_user_roles();
        $custom = array();
        $default = array();
        $linked_form = array();
        foreach ($roles as $key => $role)
        {
            if (in_array($key, $this->default_user_roles))
            {
                $default[$key] = $role;
                $linked_form[$key]=$this->get_linked_forms($key);
            } else
            {
                $custom[$key] = $role;
                $linked_form[$key]=$this->get_linked_forms($key);
            }
        }
        $roles_data->default = $default;
        $roles_data->custom = $custom;
        $roles_data->linked_forms=$linked_form;
        return $roles_data;
    }
public function get_linked_forms($role)
    {
      $forms= RM_DBManager::get('FORMS', array("default_user_role" => $role), array("%s"));
      $linked_form=array();
      if($forms != null)
      {
          foreach($forms as $form)
          {
              $linked_form[$form->form_id] = $form->form_name;
          }
      }
      return $linked_form;
    }
    public function delete($users)
    {
        if (is_array($users) && !empty($users))
        {
            $curr_user = wp_get_current_user();
            if (isset($curr_user->ID))
                $curr_user_id = $curr_user->ID;
            else
                $curr_user_id = null;
            foreach ($users as $id)
            {
                if ($curr_user_id != $id)
                    wp_delete_user($id);
            }
        }
    }

    public function activate($users)
    {
        if (is_array($users) && !empty($users))
        {
            foreach ($users as $id)
            {
                update_user_meta($id, 'rm_user_status', '0');
            }
        }
    }

    public function notify_users($users, $type)
    {
        if (is_array($users) && !empty($users))
        {
            $front_form_service = new RM_Front_Form_Service;
            foreach ($users as $id)
            {
                $user = get_user_by('id', $id);
                $params = new stdClass;
                $params->email = $user->user_email;
                $params->sub_id = get_user_meta($id, 'RM_UMETA_SUB_ID', true);
                $params->form_id = get_user_meta($id, 'RM_UMETA_FORM_ID', true);
                RM_Email_Service::notify_user_on_activation($params);
            }
        }
    }

    public static function send_email_ajax()
    {
        $to = $_POST['to'];
        $sub = $_POST['sub'];
        $body = $_POST['body'];
        
        RM_Utilities::quick_email($to, $sub, $body);
        
        wp_die();
    }
    
    public function deactivate_user_by_id($user_id)
    {
        $curr_user = wp_get_current_user();
        if (isset($curr_user->ID))
            $curr_user_id = $curr_user->ID;
        else
            $curr_user_id = null;
        if ($curr_user_id != $user_id)
            update_user_meta($user_id, 'rm_user_status', '1');
    }

    public function activate_user_by_id($user_id)
    {
        return update_user_meta($user_id, 'rm_user_status', '0');
    }

    public function deactivate($users)
    {
        if (is_array($users) && !empty($users))
        {
            $curr_user = wp_get_current_user();
            if (isset($curr_user->ID))
                $curr_user_id = $curr_user->ID;
            else
                $curr_user_id = null;
            foreach ($users as $id)
            {
                if ($curr_user_id != $id)
                    update_user_meta($id, 'rm_user_status', '1');
            }
        }
    }

    public function delete_roles($roles)
    {
        if (is_array($roles) && !empty($roles))
        {
            $custom_role_data = $this->get_setting('user_role_custom_data');
            foreach ($roles as $name)
            {
                $users = $this->get_users_by_role($name);
                foreach ($users as $user)
                {
                    $user->add_role('subscriber');
                }

                remove_role($name);
                
                
                if(isset($custom_role_data[$name]))
                    unset($custom_role_data[$name]);                
            }
            $this->set_setting('user_role_custom_data', $custom_role_data);
        }
    }

    public function get_users_by_role($role_name)
    {
        $args = array('role' => $role_name);
        $users = get_users($args);
        return $users;
    }

    public function get_user_count()
    {
        $result = count_users();
        $total_users = $result['total_users'];
        return $total_users;
    }

    public function get_users($offset = '', $number = '', $search_str = '', $user_status = 'all', $interval = 'all', $user_ids = array(), $fields_to_return = 'all')
    {
        $args = array('number' => $number, 'offset' => $offset, 'include' => $user_ids, 'search' => '*' . $search_str . '*', 'fields' => $fields_to_return);
        //$args = array();

        switch ($user_status)
        {
            case 'active':
                $args['meta_query'] = array('relation' => 'OR',
                    array(
                        'key' => 'rm_user_status',
                        'value' => '1',
                        'compare' => '!='
                    ),
                    array(
                        'key' => 'rm_user_status',
                        'value' => '1',
                        'compare' => 'NOT EXISTS'
                ));
                break;

            case 'pending':
                $args['meta_query'] = array(array(
                        'key' => 'rm_user_status',
                        'value' => '1',
                        'compare' => '='
                ));
                break;
        }

        switch ($interval)
        {
            case 'today':
                $args['date_query'] = array(array('after' => date('Y-m-d', strtotime('today')), 'inclusive' => true));
                break;

            case 'week':
                $args['date_query'] = array(array('after' => date('Y-m-d', strtotime('this week')), 'inclusive' => true));
                break;

            case 'month':
                $args['date_query'] = array(array('after' => 'first day of this month', 'inclusive' => true));
                break;

            case 'year':
                $args['date_query'] = array(array('year' => date('Y'), 'inclusive' => true));
                break;
        }
        //echo "Args:<pre>", var_dump($args), "</pre>";
        $users = get_users($args);

        return $users;
    }

    public function get_total_user_per_pagination()
    {
        $total = $this->get_user_count();
        return (int) ($total / 2) + (($total % 2) == 0 ? 0 : 1);
    }

    public function get_all_user_data($page = '1', $number = '20', $search_str = '', $user_status = 'all', $interval = 'all', $user_ids = array())
    {
        $offset = ($page * $number) - $number;
        $all_user_info = $this->get_users($offset, $number, $search_str, $user_status, $interval, $user_ids);
        $all_user_data = array();

        foreach ($all_user_info as $user)
        {

            $tmpuser = new stdClass();
            $user_info = get_userdata($user->ID);
            $is_disabled = (int) get_user_meta($user->ID, 'rm_user_status', true);
            $tmpuser->ID = $user->ID;

            // echo'<pre>';var_dump($user_info);die;

            if (empty($user_info->display_name))
                $tmpuser->first_name = $user_info->first_name;
            else
                $tmpuser->first_name = $user_info->display_name;

            if (isset($user_info->user_email))
                $tmpuser->user_email = $user_info->user_email;
            else
                $tmpuser->user_email = '';

            if ($is_disabled == 1)
                $tmpuser->user_status = RM_UI_Strings::get('LABEL_DEACTIVATED');
            else
                $tmpuser->user_status = RM_UI_Strings::get('LABEL_ACTIVATED');

            $tmpuser->date = $user_info->user_registered;

            $all_user_data[] = $tmpuser;
        }

        return $all_user_data;
    }

    public function get_user_by($field, $value)
    {
        $user = get_user_by($field, $value);
        return $user;
    }

    public function login($request)
    {

        global $user;
        $credentials = array();
        $credentials['user_login'] = $request->req['username'];
        $credentials['user_password'] = $request->req['password'];
        if (isset($request->req['remember']))
            $credentials['remember'] = true;
        else
            $credentials['remember'] = false;

        require_once(ABSPATH . 'wp-load.php');
        require_once(ABSPATH . 'wp-includes/pluggable.php');
        $user = wp_signon($credentials, false);
        return $user;
    }
public function google_login_html()
{
    
    $gopts = new RM_Options;
    if ($gopts->get_value_of('enable_gplus') == 'yes')
        {
    $client_id=$gopts->get_value_of('gplus_client_id');
    return '<pre class="rm-pre-wrapper-for-script-tags"><script src="https://apis.google.com/js/platform.js" async defer></script></pre>
        <pre class="rm-pre-wrapper-for-script-tags"><script>
        function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  handle_data(profile.getEmail(),profile.getName());
}
</script></pre>
	<meta name="google-signin-client_id" content="'.$client_id.'"><div class="rm-google-plus-login rm-third-party-login"><div class="rm-third-party-login-btn g-signin2"  data-onsuccess="onSignIn"></div></div>
';
    
        }
else
    return null;
}
public function linkedin_login_html()
{
    $gopts = new RM_Options;
    if ($gopts->get_value_of('enable_linked') == 'yes')
        {
    $api_key=$gopts->get_value_of('linkedin_api_key');
    return '<pre class="rm-pre-wrapper-for-script-tags"><script type="text/javascript" src="//platform.linkedin.com/in.js">
    api_key: '.$api_key.'
    authorize: false
    scope: r_emailaddress
  </script></pre>

<pre class="rm-pre-wrapper-for-script-tags"><script type="text/javascript">
  // Setup an event listener to make an API call once auth is complete
    function onLinkedInLoad() {
     IN.UI.Authorize().place();      
        IN.Event.on(IN, "auth", function () { getProfileData(); });
    }

    // Handle the successful return from the API call
    function onSuccess(data) {
     handle_data(data.values[0].emailAddress,data.values[0].firstName);
    }

    // Handle an error response from the API call
    function onError(error) {
        console.log(error);
    }

    // Use the API call wrapper to request the members basic profile data
    function getProfileData() {
   var fields = ["email-address"];

        IN.API.Profile("me").fields("first-name", "last-name", "email-address").result(onSuccess).error(onError);
    }
</script></pre>
 <div class="rm-linkedin-login rm-third-party-login"><input class="rm-third-party-login-btn" type="button" onclick="onLinkedInLoad()" value="Sign in with LinkedIn" />
<span><i class="fa fa-linkedin" aria-hidden="true"></i></span> 
</div>

';
        }
        else
            return null;
}
public function instagarm_login_html()
    {  
     $gopts = new RM_Options;
     $link=get_site_url();
     $ext_link=RM_BASE_URL.'external/instagram/instagram_auth.php';
    if ($gopts->get_value_of('enable_instagram_login') == 'yes')
        {
    $client_id=$gopts->get_value_of('instagram_client_id');
    return "<pre class=\"rm-pre-wrapper-for-script-tags\"><script type='text/javascript'>
		var accessToken = null; //the access token is required to make any endpoint calls, http://instagram.com/developer/endpoints/
		var authenticateInstagram = function(instagramClientId, instagramRedirectUri, callback) {
			//the pop-up window size, change if you want
			var popupWidth = 700,
				popupHeight = 500,
				popupLeft = (window.screen.width - popupWidth) / 2,
				popupTop = (window.screen.height - popupHeight) / 2;
			//the url needs to point to instagram_auth.php
			var popup = window.open('".$ext_link."', '', 'width='+popupWidth+',height='+popupHeight+',left='+popupLeft+',top='+popupTop+'');
			popup.onload = function() {
				//open authorize url in pop-up
				if(window.location.hash.length == 0) {
					popup.open('https://instagram.com/oauth/authorize/?client_id='+instagramClientId+'&redirect_uri='+instagramRedirectUri+'&response_type=token', '_self');
				}
				//an interval runs to get the access token from the pop-up
				var interval = setInterval(function() {
					try {
						//check if hash exists
						if(popup.location.hash.length) {
							//hash found, that includes the access token
							clearInterval(interval);
							accessToken = popup.location.hash.slice(14); //slice #access_token= from string
							popup.close();
							if(callback != undefined && typeof callback == 'function') callback();
						}
					}
					catch(evt) {
						//permission denied
					}
				}, 100);
			}
		};
		function login_callback() {
                      var data = {
			'action': 'rm_get_instagram_user',
			'accessToken': accessToken
		};
		jQuery.post(rm_ajax_url, data, function(response) {
              handle_data(response,'');
		});
		}
		function login_instagram() {
			authenticateInstagram(
			    '".$client_id."', //instagram client ID
			    '".$link."', //instagram redirect URI
			    login_callback //optional - a callback function
			);
			return false;
		}
	</script></pre>
        <div class='rm-instagram-login rm-third-party-login'><input class='rm-third-party-login-btn' type='button' onclick='login_instagram()' value='Sign in with Instagram' /><span><i class='fa fa-instagram' aria-hidden='true'></i></span></div>
";
        }
        else
            return null;

    }
public function twitter_login_html( )
    {  $twitter= $this->get_twitter_keys();
        if($twitter['enable_twitter'] == 'yes')
        {
            include_once(RM_EXTERNAL_DIR."twitter/inc/twitteroauth.php");
    
        $connection = new TwitterOAuth($twitter['tw_consumer_key'], $twitter['tw_consumer_secret']);
	$request_token = $connection->getRequestToken(get_permalink());
	//Received token info from twitter
	$_SESSION['token'] 			= $request_token['oauth_token'];
	$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
	
	//Any value other than 200 is failure, so continue only if http code is 200
	if($connection->http_code == '200')
	{
		//redirect user to twitter
		$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
               
	}
    return "<pre class='rm-pre-wrapper-for-script-tags'><script>
       function rm_twitter_login()
       {
       window.location = '".$twitter_url."' 
            }
            </script></pre>
            <div class='rm-twitter-login rm-third-party-login'><input class='rm-third-party-login-btn' type='button' onclick='rm_twitter_login();' value='Sign in with Twitter' /><span><i class='fa fa-twitter' aria-hidden='true'></i></span></div>";
        }
        else
            return null;
}
public function windows_login_html()
    {
    $link=get_permalink();
    $gopts = new RM_Options;
    if ($gopts->get_value_of('enable_window_login') == 'yes')
        {
    $client_id=$gopts->get_value_of('windows_client_id');
    return '<pre class="rm-pre-wrapper-for-script-tags"><script src="//js.live.net/v5.0/wl.js" type="text/javascript" language="javascript"></script></pre>
        <pre class="rm-pre-wrapper-for-script-tags"><script>
            WL.init({
                client_id: "'.$client_id.'",
                redirect_uri: "'.$link.'",
                scope: "wl.signin",
                response_type: "token"
            });
            /*WL.ui({
                name: "signin",
                element: "signin"
            });*/
            function moreScopes_onClick() {
    WL.login({
        scope: ["wl.signin", "wl.emails"]
    }).then(
        function (session) {
             WL.api({
                        path: "me",
                        method: "GET"
                    }).then(
                        function (response) {
                         handle_data(response.emails.account,response);
                        },
                        function (responseFailed) {
                        }
                    );
        },
        function (sessionError) {
            document.getElementById("info").innerText = 
                "Error signing in: " + sessionError.error_description;
        }
    );
}

        </script></pre>      
<div class="rm-microsoft-login rm-third-party-login"><input class="rm-third-party-login-btn" type="button" value="Sign in with Microsoft Live" onclick="moreScopes_onClick()"/><span><i class="fa fa-windows" aria-hidden="true"></i></span></div>';
    }
    else
        return null;
    }
    
    public function facebook_login_html()
    {
      
        
        $gopts = new RM_Options;
        if ($gopts->get_value_of('enable_facebook') == 'yes')
        {
            $fb_app_id = $gopts->get_value_of('facebook_app_id');
            if (!$fb_app_id)
                return;

                return "<pre class='rm-pre-wrapper-for-script-tags'><script>
  function checkLoginState() {
   FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
   greet();
  }
  else {
  FB.login(function(response) {
FB.api('/me',{fields: 'first_name,email'}, function (response) {
	handle_data(response.email,response.first_name);


});
}, {scope: 'email'});
  }
});
  }
function greet() {
FB.api('/me',{fields: 'first_name,email'}, function (response) {
	handle_data(response.email,response.first_name);


});
}
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '".$fb_app_id."',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = '//connect.facebook.net/en_US/sdk.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
 
</script></pre>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->
<div class='rm-facebook-login rm-third-party-login'><input class='rm-third-party-login-btn' type='button' onclick='checkLoginState()' value='Sign in with Facebook' /><span><i class='fa fa-facebook' aria-hidden='true'></i></span> </div>";
              //  return '<div class="facebook_login"><a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a></div>';
          
        }
    }

    public function set_user_role($user_id, $role)
    {
        $user = new WP_User($user_id);
        $user->set_role($role);
    }

    /*
      public function user_search($criterions, $type)
      {
      $user_ids = array();


      if ($type == "time")
      {
      $search_periods = array();
      foreach ($criterions as $period)
      {
      switch ($period)
      {
      case "today": $search_periods['today'] = array("start" => date('Y-m-d'), "end" => date('Y-m-d', strtotime("+1 day")));
      break;
      case "yesterday": $search_periods['yesterday'] = array("start" => date('Y-m-d', strtotime("-1 days")), "end" => date('Y-m-d'));
      break;
      case "this_week": $search_periods['this_week'] = array("start" => date('Y-m-d', strtotime("this week")), "end" => date('Y-m-d', strtotime("+1 day")));
      break;
      case "last_week": $search_periods['last_week'] = array("start" => date('Y-m-d', strtotime("last week")), "end" => date('Y-m-d', strtotime("+1 day")));
      break;
      case "this_month": $search_periods['this_month'] = array("start" => date("Y-m") . '-01', "end" => date('Y-m-d', strtotime("+1 day")));
      break;
      case "this_year": $search_periods['this_year'] = array("start" => date("Y") . '-01-01', "end" => date('Y-m-d', strtotime("+1 day")));
      break;
      }
      }
      $user_ids = RM_DBManager::sidebar_user_search($search_periods, $type);
      }

      echo 'TIme: ';
      print_r($user_ids);
      if ($type == "user_status")
      {
      $user_ids = RM_DBManager::sidebar_user_search($criterions, $type);
      echo 'Status: ';
      print_r($user_ids);
      }


      if ($type == "type")
      {
      foreach ($criterions as $el)
      {
      if ($type == "name")
      {
      $user_ids = RM_DBManager::sidebar_user_search($criterions, $type);
      echo 'name: ';
      print_r($user_ids);
      break;
      }


      if ($type == "email")
      {
      $user_ids = RM_DBManager::sidebar_user_search($criterions, $type);
      echo 'Email: ';
      print_r($user_ids);
      break;
      }
      }
      }


      die;

      return $user_ids;
      }
     */

    public function reset_user_password($pass, $conf, $user_id)
    {
        if ($pass && $conf && $user_id)
        {
            if ($pass === $conf)
            {
                wp_set_password($pass, $user_id);
            }
        } else
        {
            throw new InvalidArgumentException("Invalid Argument Supplied in " . __CLASS__ . '::' . __FUNCTION__);
        }
    }

    public function create_user_activation_link($user_id)
    {
        if ((int) $user_id)
        {
            $pass = wp_generate_password(10, false);
            $activation_code = md5($pass);

            if (!update_user_meta($user_id, 'rm_activation_code', $activation_code))
                return false;

            $user_data_obj = new stdClass();
            $user_data_obj->user_id = $user_id;
            $user_data_obj->activation_code = $activation_code;

            $user_data_json = json_encode($user_data_obj);

            $user_data_enc = urlencode(RM_Utilities::enc_str($user_data_json));

            $user_activation_link = admin_url('admin-ajax.php') . '?action=rm_activate_user&user=' . $user_data_enc;

            return $user_activation_link;
        }

        return false;
    }
    
    public function social_login_using_email($user_email=null,$user_fname=null)
    {
            if(isset($_POST['email']))
                $user_email=$_POST['email'];
            if(isset($_POST['first_name']))
                $user_fname=$_POST['first_name'];
            else
                $user_fname=null;
            
            $gopts = new RM_Options; 
            $resp = array('code'=>'allowed', 'msg' => '');
            if($user_email != null)
            {
                if (email_exists($user_email))
                    { // user is a member
                        $user = get_user_by('email', $user_email);
                        $user_id = (int)$user->data->ID;
                        $is_disabled = (int) get_user_meta($user_id, 'rm_user_status', true);
                        
                        if(!$is_disabled)
                            wp_set_auth_cookie($user_id, true);
                        else
                        {
                            $resp['code'] = 'denied';
                            $resp['msg'] = RM_UI_Strings::get("RM_SOCIAL_ERR_ACC_UNAPPROVED");//"Please wait for admin's approval before you can log in";
                        }
                    }
                    else if(username_exists($user_email))
                    {
                        $user = get_user_by('login', $user_email);
                        $user_id = (int)$user->data->ID;
                        $is_disabled = (int) get_user_meta($user_id, 'rm_user_status', true);
                        
                        if(!$is_disabled)
                            wp_set_auth_cookie($user_id, true);
                        else
                        {
                            $resp['code'] = 'denied';
                            $resp['msg'] = RM_UI_Strings::get("RM_SOCIAL_ERR_ACC_UNAPPROVED");//"Please wait for admin's approval before you can log in";
                        }
                    }
                    else
                    { // this user is a guest
                        $random_password = wp_generate_password(10, false);

                        $user_id = wp_create_user($user_email, $random_password, $user_email);
                        if (!is_wp_error($user_id))
                        {

                            if (function_exists('is_multisite') && is_multisite())
                                add_user_to_blog(get_current_blog_id(), $user_id, 'subscriber');

                            wp_update_user(array(
                                'ID' => $user_id,
                                'display_name' =>$user_fname,
                                'first_name' =>$user_fname
                            ));
                            
                            //varify auto approval setting
                            $auto_approval = $gopts->get_value_of('user_auto_approval');
                            
                            if($auto_approval == 'yes')
                            {
                                wp_set_auth_cookie($user_id, true);
                            }
                            else  //Deactivate the user
                            {
                               update_user_meta($user_id, 'rm_user_status', '1');
                               $resp['code'] = 'denied';
                               $resp['msg'] = RM_UI_Strings::get("RM_SOCIAL_ERR_NEW_ACC_UNAPPROVED");//"Account has been created. Please wait for admin's approval before you can log in";

                            }
                        }
                    }
         
        $rdrto = RM_Utilities::after_login_redirect($user);
            
        if(!$rdrto)
            $rdrto = apply_filters( 'login_redirect', $redirect_to, "", $user );

        if(!$rdrto || $rdrto == "__current_url") {
            $rdrto = "";
        }
        
        $after_login_url = $rdrto;
        
        
        if($resp['code']=='allowed')
            $resp['msg'] = $after_login_url;
        
        echo json_encode($resp);
        
        die;
      
     }   
    }
     public function get_twitter_keys()
     {
         $gopts=new RM_Options; 
         $twitter=array();
         $twitter['enable_twitter'] = $gopts->get_value_of('enable_twitter_login');
         $twitter['tw_consumer_key'] = $gopts->get_value_of('tw_consumer_key');
         $twitter['tw_consumer_secret'] = $gopts->get_value_of('tw_consumer_secret');
         return $twitter;
     }
    public function get_instagram_user()
     {
         $access_token= $_POST['accessToken'];
         $response = wp_remote_get('https://api.instagram.com/v1/users/self/?access_token='.$access_token);
         $response= json_decode($response['body']);
        echo $response->data->username;
        die;
     }
     
}
