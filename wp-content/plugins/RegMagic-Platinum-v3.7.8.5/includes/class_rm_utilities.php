<?php

/**
 * Utilities of plugin
 *
 * @author cmshelplive
 */
class RM_Utilities {

    private $instance;
    private static $script_handle;
    
    private function __construct() {
        $script_handle = array();
    }

    private function __wakeup() {
        
    }

    private function __clone() {
        
    }

    public static function get_instance() {
        if (!isset(self::$instance) && !( self::$instance instanceof RM_Utilities )) {
            self::$instance = new RM_Utilities();
        }

        return self::$instance;
    }

    /**
     * Redirect user to a url or post permalink with some delay
     * 
     * @param string $url 
     * @param boolean $is_post      if set true url will not be used. will redirect the user to $post_id
     * @param int $post_id          ID of the post on which user will be redirected
     * @param boolean/int $delay    Delay in redirection(in ms) or default 5s is used if set true
     */
    public static function redirect($url='', $is_post = false, $post_id = 0, $delay = false) {

        if ($is_post && $post_id > 0) {
            $url = get_permalink($post_id);
        }

        if (headers_sent() || $delay) {
            if(defined('RM_AJAX_REQ'))
                $prefix = 'parent.';
            else
                $prefix = '';
            
            $string = '<pre class="rm-pre-wrapper-for-script-tags"><script type="text/javascript">';
            if ($delay === true) {
                $string .= "window.setTimeout(function(){".$prefix."window.location.href = '" . $url . "';}, 5000);";
            }elseif((int)$delay){
                $string .= "window.setTimeout(function(){".$prefix."window.location.href = '" . $url . "';}, ".(int)$delay.");";
            }else {
                $string .= $prefix.'window.location = "' . $url . '"';
            }

            $string .= '</script></pre>';

            echo $string;
        } else {
            if (isset($_SERVER['HTTP_REFERER']) AND ( $url == $_SERVER['HTTP_REFERER']))
                wp_redirect($_SERVER['HTTP_REFERER']);
            else
                wp_redirect($url);

            exit;
        }
    }

    public static function user_role_dropdown($placeholder = false, $formatted = false) {
        $roles = array();
        $gopts = new RM_Options;
        $custom_role_data = $gopts->get_value_of('user_role_custom_data');
        if ($placeholder)
            $roles[null] = RM_UI_Strings::get('PH_USER_ROLE_DD');

        if (!function_exists('get_editable_roles'))
            require_once ABSPATH . 'wp-admin/includes/user.php';

        $user_roles = get_editable_roles();
        foreach ($user_roles as $key => $value) {
            $roles[$key] = $value['name'];
            if($formatted  && isset($custom_role_data[$key]) && $custom_role_data[$key]->is_paid)
                $paid_role_str = ' ('.$gopts->get_formatted_amount($custom_role_data[$key]->amount).')';
            else
                $paid_role_str = '';
            $roles[$key] .= $paid_role_str;
        }
        
        return $roles;
    }

    public static function wp_pages_dropdown($args = null) {
        $wp_pages = array('Select page');
        if ($args === null)
            $args = array(
                'depth' => 0,
                'child_of' => 0,
                'selected' => 0,
                'echo' => 1,
                'name' => 'page_id',
                'id' => null, // string
                'class' => null, // string
                'show_option_none' => null, // string
                'show_option_no_change' => null, // string
                'option_none_value' => null, // string
            );

        $pages = get_pages($args);
        foreach ($pages as $page) {
            if (!$page->post_title) {
                $page->post_title = "#$page->ID (no title)";
            }
            $wp_pages[$page->ID] = $page->post_title;
        }

        return $wp_pages;
    }

    public static function merge_object($args, $defaults = null) {
        if ($args instanceof stdClass)
            if (is_object($defaults))
                foreach ($defaults as $key => $default)
                    if (!isset($args->$key))
                        $args->$key = $default;

        return $args;
    }

   public static function get_field_types($include_widgets= true) {
        $field_types = array(
             null => 'Select A Field',
            'Textbox' => 'Single Line',
            'Select' => 'Drop Down',
            'Radio' => 'Radio Button',
            'Textarea' => 'Multiple Line',
            'Checkbox' => 'Checkbox',
            'jQueryUIDate' => 'Date',
            'Email' => 'Email',
            'Number' => 'Number',
            'Country' => 'Country',
            'Timezone' => 'Timezone',
            'Terms' => 'T&C Checkbox',
            'File' => 'File Upload',
            'Price' => 'Product',
            'Repeatable' => 'Repeatable Single Line',
            'Repeatable_M' => 'Repeatable Multi Line',
            'Map' => 'Map',
            'Address' => 'Address',
            'Fname' => 'First Name',
            'Lname' => 'Last Name',
            'BInfo' => 'Biographical Info',
            'Phone' => 'Phone Number',
            'Mobile' => 'Mobile Number',
            'Password' => 'Password',
            'Nickname' => 'Nick Name',
            'Bdate' => 'Birth Date',
            'SecEmail' => 'Secondary Email',
            'Gender' => 'Gender',
            'Language' => 'Language',
            'Facebook' => 'Facebook',
            'Twitter' => 'Twitter',
            'Google' => 'Google+',
            'Linked' => 'LinkedIn',
            'Youtube' => 'YouTube',
            'VKontacte' => 'VKontacte',
            'Instagram' => 'Instagram',
            'Skype' => 'Skype ID',
            'SoundCloud' => 'SoundCloud',
            'Time' => 'Time',
            'Image' => 'Image Upload',
            'Shortcode' => 'Shortcode',
            'Multi-Dropdown' => 'Multi-Dropdown',
            'Rating' => 'Rating',
            'Website' => 'Website',
            'Custom' => 'Custom Field',
            'Hidden' =>'Hidden Field'
        );
        
        if($include_widgets){
            $field_types= array_merge($field_types,array('Timer'=>'Timer','RichText'=>'Rich Text',
                                     'Divider'=>'Divider','Spacing'=>'Spacing','HTMLP'=>'Paragraph',
                                      'HTMLH'=>'Heading','Link'=>'Link','YouTubeV'=>'YouTube Video',"Iframe"=>"Embed Iframe"));
        }
        return $field_types;
    }

    public static function after_login_redirect($user) {
       
        $gopts = new RM_Options;
        $redirect_to = $gopts->get_value_of("post_submission_redirection_url");
        $enforce_admin_redirect_to_dashboard = ($gopts->get_value_of("redirect_admin_to_dashboard_post_login") == "yes");
        
        if(!$redirect_to)
            return "";
        
        if ($enforce_admin_redirect_to_dashboard && isset($user->roles) && is_array($user->roles)) {
            if (in_array('administrator', $user->roles)) {
                return admin_url();
            }
        }
        
        switch($redirect_to) {
            case "__current_url":
                if ( $GLOBALS['pagenow'] === 'wp-login.php' ) 
                    return admin_url();
                else {
                    $test = get_permalink(); //* Won't work from a widget!!*
                    
                    if(!$test)
                        return "__current_url";
                    else
                        return $test;
                }
            case "__home_page":
                return get_home_url();
                
            case "__dashboard":
                return admin_url();
        }
        
        $url = home_url("?p=" . $redirect_to);
        return $url;
                
    }

    public static function get_current_url() {
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        $currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $parts = parse_url($currentUrl);
        $query = '';
        if (!empty($parts['query'])) {
            // drop known fb params
            $params = explode('&', $parts['query']);
            $retained_params = array();
            foreach ($params as $param) {
                $retained_params[] = $param;
            } if (!empty($retained_params)) {
                $query = '?' . implode($retained_params, '&');
            }
        }        // use port if non default
        $port = isset($parts['port']) &&
                (($protocol === 'http://' && $parts['port'] !== 80) ||
                ($protocol === 'https://' && $parts['port'] !== 443)) ? ':' . $parts['port'] : '';        // rebuild
        return $protocol . $parts['host'] . $port . $parts['path'] . $query;
    }

    public static function get_forms_dropdown($service) {
        $forms = $service->get_all('FORMS', $offset = 0, $limit = 0, $column = '*', $sort_by = 'created_on', $descending = true);
        $form_dropdown_array = array();
        if ($forms)
            foreach ($forms as $form)
                $form_dropdown_array[$form->form_id] = $form->form_name;
        return $form_dropdown_array;
    }

    public static function get_paypal_field_types($service) {
        $pricing_fields = $service->get_all('PAYPAL_FIELDS', $offset = 0, $limit = 999999, $column = '*');
        //var_dump($pricing_fields);
        $field_dropdown_array = array();
        if ($pricing_fields)
            foreach ($pricing_fields as $field)
                $field_dropdown_array[$field->field_id] = $field->name;
        else
            $field_dropdown_array[null] = RM_UI_Strings::get('MSG_CREATE_PRICE_FIELD');

        return $field_dropdown_array;
    }
    
    public static function trim_array($var) {
        if (is_array($var) || is_object($var))
            foreach ($var as $key => $var_)
                if (is_array($var))
                    $var[$key] = self::trim_array($var_);
                else
                    $var->$key = self::trim_array($var_);
        else
            $var = trim($var);

        return $var;
    }

    public static function escape_array($var) {
        if (is_array($var) || is_object($var))
            foreach ($var as $key => $var_)
                if (is_array($var))
                    $var[$key] = self::escape_array($var_);
                else
                    $var->$key = self::escape_array($var_);
        else
            $var = addslashes($var);

        return $var;
    }

    public static function strip_slash_array($var) {
        if (is_array($var) || is_object($var))
            foreach ($var as $key => $var_)
                if (is_array($var))
                    $var[$key] = self::strip_slash_array($var_);
                else
                    $var->$key = self::strip_slash_array($var_);
        else
            $var = stripslashes($var);

        return $var;
    }

    public static function get_current_time($time = null) {
        if (!is_numeric($time))
            return gmdate('Y-m-d H:i:s');
        else
            return gmdate('Y-m-d H:i:s', $time);
    }

    public static function create_submission_page() {
        global $wpdb;

        $submission_page = array(
            'post_type' => 'page',
            'post_title' => 'Submissions',
            'post_status' => 'publish',
            'post_name' => 'rm_submissions',
            'post_content' => '[RM_Front_Submissions]'
        );

        $page_id = get_option('rm_option_front_sub_page_id');

        if ($page_id) {
            $post = $wpdb->get_var("SELECT `ID` FROM  `" . $wpdb->prefix . "posts` WHERE  `post_content` LIKE  \"%[RM_Front_Submissions]%\" AND `post_status`='publish' AND `ID` = " . $page_id);
            if (!$post)
                $post = $wpdb->get_var("SELECT `ID` FROM  `" . $wpdb->prefix . "posts` WHERE  `post_content` LIKE  \"%[CRF_Submissions]%\" AND `post_status`='publish' AND `ID` = " . $page_id);
        } else {
            $post = $wpdb->get_var("SELECT `ID` FROM  `" . $wpdb->prefix . "posts` WHERE  `post_content` LIKE  \"%[RM_Front_Submissions]%\" AND `post_status`='publish'");
            if (!$post)
                $post = $wpdb->get_var("SELECT `ID` FROM  `" . $wpdb->prefix . "posts` WHERE  `post_content` LIKE  \"%[CRF_Submissions]%\" AND `post_status`='publish'");
        }

        if (!$post) {
            $page_id = wp_insert_post($submission_page);
            update_option('rm_option_front_sub_page_id', $page_id);
        } else {
            if ($page_id != $post)
                update_option('rm_option_front_sub_page_id', $post);
        }
    }

    public static function get_class_name_for($model_identifier) {
        $prefix = 'RM_';
        $class_name = $prefix . self::ucwords(strtolower($model_identifier));
        return $class_name;
    }

    public static function ucwords($string, $delimiter = " ") {
        if ($delimiter != " ") {
            $str = str_replace($delimiter, " ", $string);
            $str = ucwords($str);
            $str = str_replace(" ", $delimiter, $str);
        } elseif ($delimiter == " ")
            $str = ucwords($string);

        return $str;
    }

    public static function convert_to_unix_timestamp($mysql_timestamp) {
        return strtotime($mysql_timestamp);
    }

    public static function convert_to_mysql_timestamp($unix_timestamp) {
        return date("Y-m-d H:i:s", $unix_timestamp);
    }

    public static function create_pdf($html = null, $header_data = array('logo' => null, 'header_text' => null,'title' => ''),$outputconf = array('name' => 'rm_submission.pdf', 'type'=> 'D')) {
        
        define('K_PATH_IMAGES','');
        
        $header_data = wp_parse_args( $header_data, array('logo' => null, 'header_text' => null,'title' => '') );
        
        require_once plugin_dir_path(dirname(__FILE__)) . 'external/tcpdf_min/tcpdf.php';

// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('RegistrationMagic');
        $pdf->SetTitle('Submission');
        $pdf->SetSubject('PDF for Submission');
        $pdf->SetKeywords('submission,pdf,print');
// set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 006', PDF_HEADER_STRING);
        $pdf->SetHeaderData($header_data['logo'], $header_data['logo'] ? 30 : 0 ,$header_data['title'], $header_data['header_text']);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
        $pdf->SetFont('freesans', '', 10);
        //$pdf->SetFont('courier', '', 10);

// add a page
        $pdf->AddPage();

        //var_dump(htmlentities(ob_get_contents()));die;
// output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
        $pdf->lastPage();
        
        if (defined('RM_BUFFER_STARTED'))
         while(ob_get_contents()) {
            ob_end_clean();
        }

//Close and output PDF document
        $pdf->Output($outputconf['name'], $outputconf['type']);
        
    }
    
    public static function create_json_for_chart($string_label, $numeric_label, array $dataset) {
        $data_table = new stdClass;
        $data_table->cols = array();
        $data_table->rows = array();
        $data_table->cols = array(
            // Labels for your chart, these represent the column titles
            // Note that one column is in "string" format and another one is in "number" format as pie chart only require "numbers" for calculating percentage and string will be used for column title
            (object) array('label' => $string_label, 'type' => 'string'),
            (object) array('label' => $numeric_label, 'type' => 'number')
        );

        $rows = array();

        foreach ($dataset as $name => $value) {
            $temp = array();
            // the following line will be used to slice the Pie chart
            $temp[] = (object) array('v' => (string) $name);

            // Values of each slice
            $temp[] = (object) array('v' => (int) $value);
            $rows[] = (object) array('c' => $temp);
        }
        $data_table->rows = $rows;
        $json_table = json_encode($data_table);
        return $json_table;
    }

    public static function HTMLToRGB($htmlCode) {
        if ($htmlCode[0] == '#')
            $htmlCode = substr($htmlCode, 1);

        if (strlen($htmlCode) == 3) {
            $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
        }

        $r = hexdec($htmlCode[0] . $htmlCode[1]);
        $g = hexdec($htmlCode[2] . $htmlCode[3]);
        $b = hexdec($htmlCode[4] . $htmlCode[5]);

        return $b + ($g << 0x8) + ($r << 0x10);
    }

    public static function RGBToHSL($RGB) {
        $r = 0xFF & ($RGB >> 0x10);
        $g = 0xFF & ($RGB >> 0x8);
        $b = 0xFF & $RGB;

        $r = ((float) $r) / 255.0;
        $g = ((float) $g) / 255.0;
        $b = ((float) $b) / 255.0;

        $maxC = max($r, $g, $b);
        $minC = min($r, $g, $b);

        $l = ($maxC + $minC) / 2.0;

        if ($maxC == $minC) {
            $s = 0;
            $h = 0;
        } else {
            if ($l < .5) {
                $s = ($maxC - $minC) / ($maxC + $minC);
            } else {
                $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
            }
            if ($r == $maxC)
                $h = ($g - $b) / ($maxC - $minC);
            if ($g == $maxC)
                $h = 2.0 + ($b - $r) / ($maxC - $minC);
            if ($b == $maxC)
                $h = 4.0 + ($r - $g) / ($maxC - $minC);

            $h = $h / 6.0;
        }

        $h = (int) round(255.0 * $h);
        $s = (int) round(255.0 * $s);
        $l = (int) round(255.0 * $l);

        return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
    }

    public static function send_mail($email) {
        add_action('phpmailer_init', 'RM_Utilities::config_phpmailer');
        
        $success = true;
        
        if (!$email->to)
            return false;
        
        //Just in case if data has not been supplied, set proper default values so email function does not fail.
        $exdata = property_exists($email, 'exdata') ? $email->exdata : null;
        //Checking using isset instead of property_exists as we do not want to get null value getting passed as attachments.
        $attachments = isset($email->attachments) ? $email->attachments : array(); 
        
        if (is_array($email->to))
        {
            foreach ($email->to as $to)
            {
                
                if(!self::rm_wp_mail($email->type, $to, $email->subject, $email->message, $email->header, $exdata, $attachments))
                    $success = false;
            }
        } else
            $success = self::rm_wp_mail($email->type, $email->to, $email->subject, $email->message, $email->header, $exdata, $attachments);
        
        return $success;
       
    }
    
    //Sends a generic mail to a given address.
    public static function quick_email($to, $sub, $body, $mail_type = RM_EMAIL_GENERIC, array $extra_params = null)
    {                
        $params = new stdClass;        
        $params->type = $mail_type;
        $params->to = $to;
        $params->subject = $sub;
        $params->message = $body;  
        
        //Add exra params if available
        if($extra_params) {
            foreach($extra_params as $param_name => $param_value)
                $params->$param_name = $param_value;
        }
        
        RM_Email_Service::quick_email($params);
    }
    
    private static function rm_wp_mail($mail_type, $to, $subject, $message, $header, $additional_data = null, $attachments = array()) {
        
        $mails_not_to_be_saved = array(RM_EMAIL_USER_ACTIVATION_ADMIN,
                                       RM_EMAIL_PASSWORD_USER, 
                                       RM_EMAIL_POSTSUB_ADMIN,
                                      /* RM_EMAIL_NOTE_ADDED,*/
                                       RM_EMAIL_TEST);
        $sent_res = wp_mail($to, $subject, $message, $header, $attachments);
        $was_sent_successfully = $sent_res ? 1 : 0 ;
        
        $sent_on = gmdate('Y-m-d H:i:s');
        if(!in_array($mail_type, $mails_not_to_be_saved))
        {   
            $form_id = null;
            $exdata = null;

            if(is_array($additional_data) && count($additional_data) > 0)
            {
                if(isset($additional_data['form_id'])) $form_id = $additional_data['form_id'];
                if(isset($additional_data['exdata'])) $exdata = $additional_data['exdata'];
            }
            $row_data = array('type' => $mail_type, 'to' => $to, 'sub' => htmlspecialchars($subject), 'body' => htmlspecialchars($message), 'sent_on' => $sent_on, 'headers' => $header, 'form_id' => $form_id,'exdata' => $exdata,'was_sent_success' => $was_sent_successfully);
            $fmts = array('%d','%s','%s','%s','%s', '%s', '%d', '%s', '%d');

            RM_DBManager::insert_row('SENT_EMAILS', $row_data, $fmts);
        }
           
        return $sent_res;
    }

// format date string
    public static function localize_time($date_string, $dateformatstring = null, $advanced = false, $is_timestamp = false) {

        if ($is_timestamp) {
            $date_string = gmdate('Y-m-d H:i:s', $date_string);
        }

        if (!$dateformatstring) {
            $df = get_option('date_format', null)? : 'd M Y';
            $tf = get_option('time_format', null)? : 'h:ia';
            $dateformatstring = $df . ' @ ' . $tf;
        }

        return get_date_from_gmt($date_string, $dateformatstring);
    }

    public static function mime_content_type($filename) {

        $mime_types = array(
            'txt' => 'text/plain',
            'csv' => 'text/csv; charset=utf-8',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );
        $arr = explode('.', $filename);
        $ext = array_pop($arr);
        $ext = strtolower($ext);
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } else {
            return 'application/octet-stream';
        }
    }

    public static function config_phpmailer($phpmailer) {
        $options = new RM_Options;

        if ($options->get_value_of('enable_smtp') == 'yes') {
            $phpmailer->isSMTP();
            $phpmailer->SMTPDebug = 0;
            $phpmailer->Host = $options->get_value_of('smtp_host');
            $phpmailer->SMTPAuth = $options->get_value_of('smtp_auth') == 'yes' ? true : false;
            $phpmailer->Port = $options->get_value_of('smtp_port');
            $phpmailer->Username = $options->get_value_of('smtp_user_name');
            $phpmailer->Password = $options->get_value_of('smtp_password');
            $phpmailer->SMTPSecure = ($options->get_value_of('smtp_encryption_type') == 'enc_tls') ? 'tls' : (($options->get_value_of('smtp_encryption_type') == 'enc_ssl') ? 'ssl' : '' );
        }
        $phpmailer->From = $options->get_value_of('senders_email');
        $phpmailer->FromName = $options->get_value_of('senders_display_name');
        if(empty($phpmailer->AltBody))
            $phpmailer->AltBody = self::html_to_text_email($phpmailer->Body);

        return;
    }

    public static function check_smtp() {

        $options = new RM_Options;

        $bckup = $options->get_all_options();

        $email = isset($_POST['test_email']) ? $_POST['test_email'] : null;

        $options->set_values(array(
            'enable_smtp' => 'yes',
            'smtp_host' => isset($_POST['smtp_host']) ? $_POST['smtp_host'] : null,
            'smtp_auth' => isset($_POST['SMTPAuth']) ? $_POST['SMTPAuth'] : null,
            'smtp_port' => isset($_POST['Port']) ? $_POST['Port'] : null,
            'smtp_user_name' => isset($_POST['Username']) ? $_POST['Username'] : null,
            'smtp_password' => isset($_POST['Password']) ? $_POST['Password'] : null,
            'smtp_encryption_type' => isset($_POST['SMTPSecure']) ? $_POST['SMTPSecure'] : null,
            'senders_email' => isset($_POST['From']) ? $_POST['From'] : null,
            'senders_display_name' => isset($_POST['FromName']) ? $_POST['FromName'] : null
        ));
        if (!$email) {
            echo RM_UI_Strings::get('LABEL_FAILED');
            $options->set_values($bckup);
            die;
        }

        $test_email = new stdClass();
        $test_email->type = RM_EMAIL_TEST;
        $test_email->to = $email;
        $test_email->subject = 'Test SMTP Connection';
        $test_email->message = 'Test';
        $test_email->header = '';
        $test_email->attachments = array();
        if (self::send_mail($test_email))
            echo RM_UI_Strings::get('LABEL_SUCCESS');
        else
            echo RM_UI_Strings::get('LABEL_FAILED');

        $options->set_values($bckup);
        die;
    }

    public static function disable_review_banner() {
        $options = new RM_Options;

        $options->set_value_of('done_with_review_banner', 'yes');
    }

    public static function disable_newsletter_banner() {
        global $rm_env_requirements;

        if ($rm_env_requirements & RM_REQ_EXT_CURL) {
            require_once RM_EXTERNAL_DIR . "Xurl/rm_xurl.php";

            $xurl = new RM_Xurl("https://registrationmagic.com/subscribe_to_newsletter/");

            if (function_exists('is_multisite') && is_multisite()) {
                $nl_sub_mail = get_site_option('admin_email');
            } else {
                $nl_sub_mail = get_option('admin_email');
            }

            $user = get_user_by('email', $nl_sub_mail);
            $req_arr = array('sub_email' => $nl_sub_mail, 'fname' => $user->first_name, 'lname' => $user->last_name);

            $xurl->post($req_arr);
        }
        if (function_exists('is_multisite') && is_multisite()) {
            update_site_option('rm_option_newsletter_subbed', 1);
        } else {
            update_option('rm_option_newsletter_subbed', 1);
        }

        wp_die();
    }

    public static function is_ssl() {
        
        return is_ssl();
    }

    //More reliable check for write permission to a directory than the php native is_writable.
    public static function is_writable_extensive_check($path) {
        //NOTE: use a trailing slash for folders!!!
        if ($path{strlen($path) - 1} == '/') // recursively return a temporary file path
            return self::is_writable_extensive_check($path . uniqid(mt_rand()) . '.tmp');
        else if (is_dir($path))
            return self::is_writable_extensive_check($path . '/' . uniqid(mt_rand()) . '.tmp');
        // check tmp file for read/write capabilities
        $rm = file_exists($path);
        $f = @fopen($path, 'a');
        if ($f === false)
            return false;
        fclose($f);
        if (!$rm)
            unlink($path);
        return true;
    }

    //Check for fatal errors with which can not continue.
    public static function fatal_errors() {
        global $rm_env_requirements;
        global $regmagic_errors;
        $fatality = false;
        $error_msgs = array();
        
        //Now check for any other remaining errors that might be originally in the global variable
        foreach ($regmagic_errors as $err) {
            if (!$err->should_cont) { 
                $fatality = true;
                break;
            }
        }

        if (!($rm_env_requirements & RM_REQ_EXT_MCRYPT)) {
            $regmagic_errors[RM_ERR_ID_EXT_MCRYPT] = (object) array('msg' => RM_UI_Strings::get('CRIT_ERR_MCRYPT'), 'should_cont' => false); //"PHP extension mcrypt is not enabled on server. This plugin cannot function without it.";
            $fatality = true;
        }
        if (!($rm_env_requirements & RM_REQ_EXT_SIMPLEXML)) {
            $regmagic_errors[RM_ERR_ID_EXT_SIMPLEXML] = (object) array('msg' => RM_UI_Strings::get('CRIT_ERR_XML'), 'should_cont' => false); //"PHP extension SimpleXML is not enabled on server. This plugin cannot function without it.";
            $fatality = true;
        }

        if (!($rm_env_requirements & RM_REQ_PHP_VERSION)) {
            $regmagic_errors[RM_ERR_ID_PHP_VERSION] = (object) array('msg' => RM_UI_Strings::get('CRIT_ERR_PHP_VERSION'), 'should_cont' => false); //"This plugin requires atleast PHP version 5.3. Cannot continue.";
            $fatality = true;
        }

        if (!($rm_env_requirements & RM_REQ_EXT_CURL)) {
            $regmagic_errors[RM_ERR_ID_EXT_CURL] = (object) array('msg' => RM_UI_Strings::get('RM_ERROR_EXTENSION_CURL'), 'should_cont' => true);
        }

        if (!($rm_env_requirements & RM_REQ_EXT_ZIP)) {
            $regmagic_errors[RM_ERR_ID_EXT_ZIP] = (object) array('msg' => RM_UI_Strings::get('RM_ERROR_EXTENSION_ZIP'), 'should_cont' => true);
        }

        
        return $fatality;
    }

    public static function rm_error_handler($errno, $errstr, $errfile, $errline) {
        global $regmagic_errors;

        var_dump($errno);
        var_dump($errstr);

        return true;
    }
    
    public static function is_banned_ip($ip_to_check, $format)
    {
        if($format === null)
            return false;
        
        //compare directly in case of ipv6 ban pattern
        if((bool)filter_var($format, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
        {
            if($ip_to_check == $format)
                return true;
            else
                return false;
        }       
        
        $matchrx = '/';
        $gen_regex = array('[0-2]','[0-9]','[0-9]','\.',
                           '[0-2]','[0-9]','[0-9]','\.',
                           '[0-2]','[0-9]','[0-9]','\.',
                           '[0-2]','[0-9]','[0-9]');
        
        for($i=0;$i<15;$i++)
        {
            if($format[$i] == '?' || $format[$i] == '.')
                $matchrx .= $gen_regex[$i];
            else
                $matchrx .= $format[$i];
        }
        
        $matchrx .= '/';
        
        if(preg_match ( $matchrx , $ip_to_check) === 1)
           return true;
        else
           return false;
    }
    
    public static function is_banned_email($email_to_check, $format)
    {
        if(!$format)
            return false;
        
        $matchrx = '/';
        
        $gen_regex = array('?' => '.',
                           '*' => '.*',
                           '.' => '\.'
                            );
        
        $formatlen = strlen($format);
        
        for($i=0; $i<$formatlen; $i++)
        {
            if($format[$i] == '?' || $format[$i] == '.' || $format[$i] == '*')
                $matchrx .= $gen_regex[$format[$i]];
            else
                $matchrx .= $format[$i];
        }
        
        $matchrx .= '/';
        
        //Following check is employed instead preg_match so that partial matches
        //will not get selected unless user specifies using wildcard '*'.      
        $test = preg_replace ( $matchrx, '', $email_to_check);        
        
        if($test == '')
            return true;
        else
            return false;
    }
    
    public static function is_username_reserved($username_to_check)
    {
        if(!$username_to_check)
            return false;
        
        $gopts = new RM_Options;
        
        $reserved_usernames = $gopts->get_value_of('blacklisted_usernames');
        
        if(!$reserved_usernames || !is_array($reserved_usernames) || count($reserved_usernames) == 0)
            return false;
        
        if(in_array($username_to_check, $reserved_usernames))
            return true;
        else        
            return false;
    }

    public static function enc_str($string) {
        $key = 'A Terrific tryst with tyranny';

        $iv = @mcrypt_create_iv(
                mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM
        );

        $encrypted = @base64_encode($iv . mcrypt_encrypt(
                        MCRYPT_RIJNDAEL_128, hash('sha256', $key, true), $string, MCRYPT_MODE_CBC, $iv
                )
        );
        return $encrypted;
    }

    public static function dec_str($string) {
        $key = 'A Terrific tryst with tyranny';

        $data = base64_decode($string);
        $iv = @substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

        $decrypted = @rtrim(
                mcrypt_decrypt(
                        MCRYPT_RIJNDAEL_128, hash('sha256', $key, true), substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)), MCRYPT_MODE_CBC, $iv
                ), "\0"
        );

        return $decrypted;
    }

    public static function link_activate_user() {
        $req = $_GET['user'];

        $user_service = new RM_User_Services();

        $req_deco = self::dec_str($req);

        $user_data = json_decode($req_deco);

        echo '<!DOCTYPE html>
                    <html>
                    <head>
                      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                      <meta http-equiv="Content-Style-Type" content="text/css">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <title></title>
                      <meta name="Generator" content="Cocoa HTML Writer">
                      <meta name="CocoaVersion" content="1404.34">
                        <link rel="stylesheet" type="text/css" href="' . RM_BASE_URL . 'admin/css/style_rm_admin.css">
                    </head>
                    <body class="rmajxbody">
        <div class="rmagic">';

        echo '<div class="rm_user_activation_msg">';

        if ($user_data->activation_code == get_user_meta($user_data->user_id, 'rm_activation_code', true)) {
            if (!delete_user_meta($user_data->user_id, 'rm_activation_code')) {
                echo '<div class="rm_fail_del">' . RM_UI_Strings::get('ACT_AJX_FAILED_DEL') . '</div>';
                die;
            }

            if ($user_service->activate_user_by_id($user_data->user_id)) {
                 $users=array($user_data->user_id);
                $user_service-> notify_users($users,'user_activated');
                echo '<h1 class="rm_user_msg_ajx">' . RM_UI_Strings::get('ACT_AJX_ACTIVATED') . '</h1>';
                $user = get_user_by('id', $user_data->user_id);
                echo '<div class = rm_user_info><div class="rm_field_cntnr"><div class="rm_user_label">' . RM_UI_Strings::get('LABEL_USER_NAME') . ' : </div><div class="rm_label_value">' . $user->user_login . '</div></div><div class="rm_field_cntnr"><div class="rm_user_label">' . RM_UI_Strings::get('LABEL_USEREMAIL') . ' : </div><div class="rm_label_value">' . $user->user_email . '</div></div></div>';
                echo '<div class="rm_user_msg_ajx">' . RM_UI_Strings::get('ACT_AJX_ACTIVATED2') . '</div>';
            } else
                echo '<div class="rm_not_authorized_ajax rm_act_fl">' . RM_UI_Strings::get('ACT_AJX_ACTIVATE_FAIL') . '</div>';
        } else
            echo '<div class="rm_not_authorized_ajax">' . RM_UI_Strings::get('ACT_AJX_NO_ACCESS') . '</div>';

        echo '</div></div></html></body>';
        /* ?>
          <button type="button" onclick="window.location.reload()">Retry</button>
          <button type="button" onclick="window.history.back()">GO BACK</button>
          <?php */
        die;
    }
    
    public static function html_to_text_email($html){
        $html = str_replace('<br>', "\r\n", $html);
        $html = str_replace('<br/>', "\r\n", $html);
        $html = str_replace('</br>', "\r\n", $html);
        
        $html = strip_tags($html);
        $html = html_entity_decode($html);
        return trim($html);
    } 
public static function get_language_array()
{
return array(
                                        'Afar' => 'Afar',
                                        'Abkhaz' => 'Abkhaz',
                                        'Avestan' => 'Avestan',
                                        'Afrikaans' => 'Afrikaans',
                                        'Akan' => 'Akan',
                                        'Amharic' => 'Amharic',
                                        'Aragonese' => 'Aragonese',
                                        'Arabic' => 'Arabic',
                                        'Assamese' => 'Assamese',
                                        'Avaric' => 'Avaric',
                                        'Aymara' => 'Aymara',
                                        'Azerbaijani' => 'Azerbaijani',
                                        'Bashkir' => 'Bashkir',
                                        'Belarusian' => 'Belarusian',
                                        'Bulgarian' => 'Bulgarian',
                                        'Bihari' => 'Bihari',
                                        'Bislama' => 'Bislama',
                                        'Bambara' => 'Bambara',
                                        'Bengali' => 'Bengali',
                                        'Tibetan Standard, Tibetan, Central' => 'Tibetan Standard, Tibetan, Central',
                                        'Breton' => 'Breton',
                                        'Bosnian' => 'Bosnian',
                                        'Catalan' => 'Catalan',
                                        'Chechen' => 'Chechen',
                                        'Chamorro' => 'Chamorro',
                                        'Corsican' => 'Corsican',
                                        'Cree' => 'Cree',
                                        'Czech' => 'Czech',
                                        'Church Slavic' => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic',
                                        'Chuvash' => 'Chuvash',
                                        'Welsh' => 'Welsh',
                                        'Danish' => 'Danish',
                                        'German' => 'German',
                                        'Divehi' => 'Divehi; Dhivehi; Maldivian;',
                                        'Dzongkha' => 'Dzongkha',
                                        'Ewe' => 'Ewe',
                                        'Greek' => 'Greek, Modern',
                                        'English' => 'English',
                                        'Esperanto' => 'Esperanto',
                                        'Spanish' => 'Spanish; Castilian',
                                        'Estonian' => 'Estonian',
                                        'Basque' => 'Basque',
                                        'Persian' => 'Persian',
                                        'Fula' => 'Fula; Fulah; Pulaar; Pular',
                                        'Finnish' => 'Finnish',
                                        'Fijian' => 'Fijian',
                                        'Faroese' => 'Faroese',
                                        'French' => 'French',
                                        'Western Frisian' => 'Western Frisian',
                                        'Irish' => 'Irish',
                                        'Gaelic' => 'Scottish Gaelic; Gaelic',
                                        'Galician' => 'Galician',
                                        'Guarana' => 'Guarana',
                                        'Gujarati' => 'Gujarati',
                                        'Manx' => 'Manx',
                                        'Hausa' => 'Hausa',
                                        'Hebrew' => 'Hebrew (modern)',
                                        'Hindi' => 'Hindi',
                                        'Hiri Motu' => 'Hiri Motu',
                                        'Croatian' => 'Croatian',
                                        'Haitian' => 'Haitian; Haitian Creole',
                                        'Hungarian' => 'Hungarian',
                                        'Armenian' => 'Armenian',
                                        'Herero' => 'Herero',
                                        'Interlingua' => 'Interlingua',
                                        'Indonesian' => 'Indonesian',
                                        'Interlingue' => 'Interlingue',
                                        'Igbo' => 'Igbo',
                                        'Nuosu' => 'Nuosu',
                                        'Inupiaq' => 'Inupiaq',
                                        'Ido' => 'Ido',
                                        'Icelandic' => 'Icelandic',
                                        'Italian' => 'Italian',
                                        'Inuktitut' => 'Inuktitut',
                                        'Japanese' => 'Japanese (ja)',
                                        'Javanese' => 'Javanese (jv)',
                                        'Georgian' => 'Georgian',
                                        'Kongo' => 'Kongo',
                                        'Kikuyu' => 'Kikuyu, Gikuyu',
                                        'Kwanyama' => 'Kwanyama, Kuanyama',
                                        'Kazakh' => 'Kazakh',
                                        'Kalaallisut' => 'Kalaallisut, Greenlandic',
                                        'Khmer' => 'Khmer',
                                        'Kannada' => 'Kannada',
                                        'Korean' => 'Korean',
                                        'Kanuri' => 'Kanuri',
                                        'Kashmiri' => 'Kashmiri',
                                        'Kurdish' => 'Kurdish',
                                        'Komi' => 'Komi',
                                        'Cornish' => 'Cornish',
                                        'Kirghiz' => 'Kirghiz, Kyrgyz',
                                        'Latin' => 'Latin',
                                        'Luxembourgish' => 'Luxembourgish, Letzeburgesch',
                                        'Luganda' => 'Luganda',
                                        'Limburgish' => 'Limburgish, Limburgan, Limburger',
                                        'Lingala' => 'Lingala',
                                        'Lao' => 'Lao',
                                        'Lithuanian' => 'Lithuanian',
                                        'Luba-Katanga' => 'Luba-Katanga',
                                        'Latvian' => 'Latvian',
                                        'Malagasy' => 'Malagasy',
                                        'Marshallese' => 'Marshallese',
                                        'Maori' => 'Maori',
                                        'Macedonian' => 'Macedonian',
                                        'Malayalam' => 'Malayalam',
                                        'Mongolian' => 'Mongolian',
                                        'Marathi' => 'Marathi (Mara?hi)',
                                        'Malay' => 'Malay',
                                        'Maltese' => 'Maltese',
                                        'Burmese' => 'Burmese',
                                        'Nauru' => 'Nauru',
                                        'Norwegian' => 'Norwegian',
                                        'North Ndebele' => 'North Ndebele',
                                        'Nepali' => 'Nepali',
                                        'Ndonga' => 'Ndonga',
                                        'Dutch' => 'Dutch',
                                        'Norwegian Nynorsk' => 'Norwegian Nynorsk',
                                        'Norwegian' => 'Norwegian',
                                        'South Ndebele' => 'South Ndebele',
                                        'Navajo' => 'Navajo, Navaho',
                                        'Chichewa' => 'Chichewa; Chewa; Nyanja',
                                        'Occitan' => 'Occitan',
                                        'Ojibwe' => 'Ojibwe, Ojibwa',
                                        'Oromo' => 'Oromo',
                                        'Oriya' => 'Oriya',
                                        'Ossetian' => 'Ossetian, Ossetic',
                                        'Panjabi' => 'Panjabi, Punjabi',
                                        'Pali' => 'Pali',
                                        'Polish' => 'Polish',
                                        'Pashto' => 'Pashto, Pushto',
                                        'Portuguese' => 'Portuguese',
                                        'Quechua' => 'Quechua',
                                        'Romansh' => 'Romansh',
                                        'Kirundi' => 'Kirundi',
                                        'Romanian' => 'Romanian, Moldavian, Moldovan',
                                        'Russian' => 'Russian',
                                        'Kinyarwanda' => 'Kinyarwanda',
                                        'Sanskrit' => 'Sanskrit',
                                        'Sardinian' => 'Sardinian',);
}
    
    public static function get_password_regex($pw_rests)
    {
        if(in_array('PWR_MINLEN',$pw_rests->selected_rules) && isset($pw_rests->min_len) && $pw_rests->min_len)
            $min_len = $pw_rests->min_len;
        else
            $min_len = 0;
        
        if(in_array('PWR_MAXLEN',$pw_rests->selected_rules) && isset($pw_rests->max_len) && $pw_rests->max_len)
            $max_len = $pw_rests->max_len;
        else
            $max_len = '';
        
        $regex = '[A-Za-z\d$@$!%*#?&~`^(){}\[\]\-_+=;:"\'|\\\\\\/<>.,]{'.$min_len.','.$max_len.'}';
        
        if(in_array('PWR_UC',$pw_rests->selected_rules))
            $regex = '(?=.*[A-Z])'.$regex;
        if(in_array('PWR_NUM',$pw_rests->selected_rules))
            $regex = '(?=.*\d)'.$regex;
        if(in_array('PWR_SC',$pw_rests->selected_rules))
            $regex = '(?=.*[$@$!%*#?&])'.$regex;
        
        return $regex;
    }
    
    public static function check_access_control($factrl, $request)
    {
        $is_allowed = true;
        
        if(isset($factrl->date))
        {
            $entered_date_str = $request['rm_fac_dyear'].'-'.$request['rm_fac_dmonth'].'-'.$request['rm_fac_dday'];
            $entered_date = new DateTime($entered_date_str);
            
            if($factrl->date->type == 'diff')
            {                
                $curr_date = new DateTime;                                              
                $diff = $curr_date->diff($entered_date);
                $diff_years = $diff->y;
                if($factrl->date->lowerlimit)
                {
                    if($diff_years < $factrl->date->lowerlimit)
                        $is_allowed = false;
                }
                if($factrl->date->upperlimit)
                {
                    if($diff_years > $factrl->date->upperlimit)
                        $is_allowed = false;
                }                
            }
            elseif($factrl->date->type == 'date')
            {
                $dt = new DateTime;
                if($factrl->date->lowerlimit)
                {
                    $lldt = $dt->createFromFormat('m/d/Y H:i:s',$factrl->date->lowerlimit.' 00:00:00');
                    if($entered_date < $lldt)
                        $is_allowed = false;
                }
                if($factrl->date->upperlimit)
                {
                    $uldt = $dt->createFromFormat('m/d/Y H:i:s', $factrl->date->upperlimit.' 00:00:00');
                    if($entered_date > $uldt)
                        $is_allowed = false;
                }  
            }
        }
        
        if(isset($factrl->passphrase))
        {            
            $passphrases = explode("|", $factrl->passphrase->passphrase);
            $passphrases = array_map('trim', $passphrases);
            if(!in_array($request['rm_fac_pass'], $passphrases))
                $is_allowed = false;
        }
        
        return $is_allowed;
    }
    
    public static function set_default_form()
    {
        if(isset($_POST['rm_def_form_id']))
        {
            $gopts = new RM_Options;
            $gopts->set_value_of('default_form_id', $_POST['rm_def_form_id']);
        }
        die;
    }
    public static function get_validations_array()
    {
        $validations=array(
            
           null=>RM_UI_Strings::get('SELECT_VALIDATION'),
            "(?:https?:\/\/)?(?:www\.)?facebook\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*?(\/)?([\w\-\.]*)"=>"Facebook URL",
            "(ftp|http|https):\/\/?((www|\w\w)\.)?linkedin.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?"=>"LinkedIn Profile",
            "(ftp|http|https):\/\/?((www|\w\w)\.)?youtube.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?"=>"YouTube URL",
            "((http:\/\/(plus\.google\.com\/.*|www\.google\.com\/profiles\/.*|google\.com\/profiles\/.*))|(https:\/\/(plus\.google\.com\/.*)))"=>"Google+ Profile",
            "(?:^|[^\w])(?:@)([A-Za-z0-9_](?:(?:[A-Za-z0-9_]|(?:\.(?!\.))){0,28}(?:[A-Za-z0-9_]))?)"=>"Instagram Profile",
            "(ftp|http|https):\/\/?((www|\w\w)\.)?twitter.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?"=>"Twitter URL",
            "[a-zA-Z][a-zA-Z0-9_\-\,\.]{5,31}"=>"Skype ID",
            "(ftp|http|https):\/\/?((www|\w\w)\.)?soundcloud.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?"=>"SoundCloud URL",
            "(ftp|http|https):\/\/?((www|\w\w)\.)?(vkontakte.com|vk.com)(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?"=>"VKontacte URL",
            "((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)"=>"Website",
            "^[0-9]+$"=>"Numeric",
            "^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$"=>"Phone Number",
            "^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$"=>"Mobile Number",
            "^[a-zA-Z]+$"=>"English Alphabets",
            "^[a-zA-Z0-9]+$"=>"Alphanumeric",
            "^[a-z]+$"=>"Lowercase Alphabets Only",
            "^[A-Za-z][A-Za-z0-9]{5,31}$"=>"Username",
            "^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$"=>"Email",
          
           // "^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$"=>"Email",
            "custom"=>"Custom Validation"
        );
        return $validations;
    }
    //One time login
    public static function safe_login()
    {   
        if(isset($_SESSION['RM_SLI_UID']))
        {           
            $user_status_flag = get_user_meta($_SESSION['RM_SLI_UID'], 'rm_user_status',true);
            if($user_status_flag === '0' || $user_status_flag === '')
                wp_set_auth_cookie($_SESSION['RM_SLI_UID']);            
            unset($_SESSION['RM_SLI_UID']);            
        }
    }
    
    //Loads scripts without wp_enque_script for ajax calls.
    public static function enqueue_external_scripts($handle, $src = false, $deps = array(), $ver = false, $in_footer = false){
       
        if(!defined('RM_AJAX_REQ')){ 
          
            if (!wp_script_is($handle, 'enqueued')) {
                if(wp_script_is($handle, 'registered'))
                    wp_enqueue_script($handle);
                else
                    wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);            
            }
        }elseif(!isset(self::$script_handle[$handle])){
            
            self::$script_handle[$handle] = $src;
            return '<pre class="rm-pre-wrapper-for-script-tags"><script type="text/javascript" src="'. $src. '"></script></pre>';
        }
        
    }
    
    /*
     * Loads all the data requires in JS for Admin
     * It will allow to use language strings in JS
     */
    public static function load_admin_js_data(){
        $data= new stdClass();
        // Allowed Filter options
         $data->submission_filter_tags= array(RM_UI_Strings::get("LABEL_HAVE_NOTE"),
                                   RM_UI_Strings::get("LABEL_PAYMENT_RECEIVED"),
                                   RM_UI_Strings::get("LABEL_PAYMENT_PENDING"),
                                   RM_UI_Strings::get("LABEL_PENDING_OFFLINE_PAYMENTS"),
                                   RM_UI_Strings::get("LABEL_NO_ATTACHMENT"),
                                   RM_UI_Strings::get("LABEL_ATTACHMENT"),
                                   RM_UI_Strings::get("LABEL_READ"),
                                   RM_UI_Strings::get("LABEL_UNREAD"),
                                   RM_UI_Strings::get("LABEL_BLOCKED"),
                                   );
         echo json_encode($data);
         die;
         
    }
    
    public static function load_js_data(){
        $data= new stdClass();
        
        // Validation message override
        $data->validations= array();
        $data->validations['required']= RM_UI_Strings::get("VALIDATION_REQUIRED");
        $data->validations['email']= RM_UI_Strings::get("INVALID_EMAIL");
        $data->validations['url']= RM_UI_Strings::get("INVALID_URL");
        $data->validations['pattern']= RM_UI_Strings::get("INVALID_FORMAT");
        $data->validations['number']= RM_UI_Strings::get("INVALID_NUMBER");
        $data->validations['digits']= RM_UI_Strings::get("INVALID_DIGITS");        
        $data->validations['maxlength']= RM_UI_Strings::get("INVALID_MAXLEN");
        $data->validations['minlength']= RM_UI_Strings::get("INVALID_MINLEN");
        $data->validations['max']= RM_UI_Strings::get("INVALID_MAX");
        $data->validations['min']= RM_UI_Strings::get("INVALID_MIN");        
        
        echo json_encode($data);
        wp_die();
         
    }
    
    public static function save_submit_label(){
     $form_id=$_POST['form_id'];
     $label=$_POST['label'];
    
     $form=new RM_Forms;
     $form->load_from_db($form_id);
     $form->form_options->form_submit_btn_label=$label;
     $form->update_into_db();
     echo "changed";die;
    }
    
    public static function update_tour_state($tour_id, $state)
    {
        $gopts = new RM_Options;
        
        $existing_tour = $gopts->get_value_of('tour_state');
        
        if(is_array($existing_tour))
        {
            $existing_tour[$tour_id] = strtolower($state);
        } else {
            $existing_tour = array($tour_id => strtolower($state));
        }
        $gopts->set_value_of('tour_state', $existing_tour);
    }    
    
    public static function has_taken_tour($tour_id)
    {
        $gopts = new RM_Options;
        
        $existing_tour = $gopts->get_value_of('tour_state');
        
        if(isset($existing_tour[$tour_id]))
            return ($existing_tour[$tour_id] == 'taken');
        else
            return false;
    }
    
    public static function update_tour_state_ajax()
    {
        $tour_id = $_POST['tour_id'];
        $state = $_POST['state'];
        
        self::update_tour_state($tour_id, $state);
        wp_die();
    }
    
    public static function process_field_options($value)
    {
        $p_options = array();
        
        if(!is_array($value))
            $tmp_options = explode(',', $value);
        else
            $tmp_options = $value;
                
        foreach($tmp_options as $val)
        {
            $val = trim($val);
            $val = trim($val, "|");
            $t = explode("|",$val);

            if(count($t) <= 1 || trim($t[1]) === "")
                $p_options[$val] = $val;
            else
                $p_options[trim($t[1])] = trim($t[0]);
        }
        
        return $p_options;
    }
    
    public static function get_lable_for_option($field_id, $opt_value)
    {
        $rmf = new RM_Fields;
        if(!$rmf->load_from_db($field_id))
            return $opt_value;
        
        //Return same value if it is not a multival field
        if(!in_array($rmf->field_type, array('Checkbox','Radio','Select')))
            return $opt_value;
        
        $val = $rmf->get_field_value();
        $p_opts = self::process_field_options($val);
        
        if(!is_array($opt_value))
        {
            if(isset($p_opts[$opt_value]))
                return $p_opts[$opt_value];
            else
                return $opt_value;
        }
        else
        {
            $tmp = array();
            foreach($opt_value as $val)
            {
                if(isset($p_opts[$val]))
                    $tmp[] = $p_opts[$val];
                else
                    $tmp[] = $val;
            }
            return $tmp;
        }
    }
    
    //Print nested array like vars as html table.
    public static function var_to_html($variable)
    {
        $html = "";

        if (is_array($variable) || is_object($variable))
        {
            $html .=  "<table style='border:none; padding:3px; width:100%; margin: 0px;'>";
            if(count($variable) === 0) $html .= "empty";
            foreach ($variable as $k => $v) {
                    $html .=  '<tr><td style="background-color:#F0F0F0; vertical-align:top; min-width:100px;">';
                    $html .=  '<strong>' . $k . "</strong></td><td>";
                    $html .=  self::var_to_html($v);
                    $html .=  "</td></tr>";
            }

            $html .=  "</table>";
            return $html;
        }

        $html .=  $variable ? $variable : "NULL";
        return $html;
   }
   
   public static function is_date_valid()
   {
       $date = $_POST['date'];
       
       try {
            $test = new DateTime($date);
            echo "VALID";
        } catch(Exception $e) {
            echo "INVALID";
        }
        
        wp_die();
   }
   
   public function handel_fb_subscribe()
   {     
       $gopts = new RM_Options;
       $gopts->set_value_of('has_subbed_fb_page','yes');
       wp_die();
   }
   
   //Methods to simplify one-time-action option handeling
    public static function update_action_state($act_id, $state)
    {
        $gopts = new RM_Options;
        
        $one_time_actions = $gopts->get_value_of('one_time_actions');
        
        if(is_array($one_time_actions))
        {
            $one_time_actions[$act_id] = $state;
        } else {
            $one_time_actions = array($act_id => $state);
        }
        $gopts->set_value_of('one_time_actions', $one_time_actions);
    }    
    
    public static function has_action_occured($act_id)
    {
        $gopts = new RM_Options;
        
        $one_time_actions = $gopts->get_value_of('one_time_actions');

        if(isset($one_time_actions[$act_id]))
            return $one_time_actions[$act_id];
        else
            return false;
    }
    
    public static function update_action_state_ajax()
    {
        $act_id = $_POST['action_id'];
        //Pass 'state' as string "true" or "false".
        $state = ($_POST['state'] == 'true');
        
        self::update_action_state($act_id, $state);
        wp_die();
    }
    
   public static function get_allowed_conditional_fields()
   {
       return array('Textbox','Select','Radio','Checkbox','jQueryUIDate','Email','Number','Country','Website',
                      'Language','Timezone','Fname','Lname','Phone','Mobile','Nickname','Bdate','Gender','Custom','Repeatable','Password','Terms','Repeatable_M');
   }
   
   public static function get_fields_dropdown($config= array()) {
        $service= new RM_Services();
        $fields= $service->get_all_form_fields($config['form_id']);
        $options= '';
        if(isset($config['full']))
          $options .= '<select name="'.$config['name'].'" id="'.(isset($config['id']) ? $config['id']:$config['name']).'">';
         if ($fields)
            foreach ($fields as $field){
                 if(!empty($config['exclude']) && in_array($field->field_id, $config['exclude']))
                         continue;
                 if(!empty($config['inc_by_type']) && !in_array($field->field_type,$config['inc_by_type']))
                         continue;
                 if(!empty($config['ex_by_type']) && in_array($field->field_type,$config['ex_by_type']))
                         continue;

                 if(isset($config['def']) && $field->field_id==$config['def'])
                     $options .= '<option selected value="'.$field->field_id.'">'.$field->field_label.'</option>';
                 else
                     $options .= '<option value="'.$field->field_id.'">'.$field->field_label.'</option>';
            }
         if(isset($config['full']))
          $options .= '</select>';       
        return $options;
    }
    
    public static function get_allowed_cond_op($config= array()) {
       return array(
                'Equals'=>'==', 'Not equals'=>'!=','Less than or equals'=>'<=',
                'Less than'=>'<','Greater than'=>'>','Greater than or equals'=>'>=',
                'Contains'=> 'in',
                'Empty'=>'_blank','Not Empty'=>'_not_blank'
       );
    }
    
    public static function get_cond_op_dd($config= array()) {
      $operators= self::get_allowed_cond_op();
      $options='';
      if(isset($config['full']))
          $options .= '<select name="'.$config['name'].'" id="'.(isset($config['id']) ? $config['id']:$config['name']).'">';
          
      foreach($operators as $key=>$op)
      {
          if(isset($config['def']) && $op==$config['def'])
            $options .= '<option selected value="'.$op.'">'.$key.'</option>';
          else
             $options .= '<option value="'.$op.'">'.$key.'</option>'; 
      }
      if(isset($config['full']))
          $options .= '</select>';
      return $options;
    }
    
    public static function pdf_excluded_widgets(){
        return array("Spacing","HTMLCustomized","HTML","Timer","Iframe");
    }
    
    public static function csv_excluded_widgets(){
        return array("HTMLH","Spacing","HTMLCustomized","HTML","Timer","HTMLP","Divider","Spacing","RichText","Link","YouTubeV","Iframe");
    }
    
    public static function submission_manager_excluded_fields(){
        return array('File','Spacing','Divider','HTMLH','HTMLP','Address','RichText','Timer','YouTubeV',"Link","Iframe",'HTMLCustomized');
    }
    
    public static function extract_youtube_embed_src($string) {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "$2",
            $string
        );
    }
    
    public static function extract_vimeo_embed_src($string){
        
        return (int) substr(parse_url($string, PHP_URL_PATH), 1);
        
    }
    
    public static function check_src_type($string){
        if (strpos($string, 'youtube') > 0) {
            return 'youtube';
        }
        elseif (strpos($string, 'vimeo') > 0) {
            return 'vimeo';
        } 
        else{
            return 'unknown';
        }
    }
}
 
