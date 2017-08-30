<?php

function rm_wc_create_tables(){
    /**
     * Code to create tables if needed
     */
}

function rm_wc_render_fields(){ 
   $form_id= get_rm_wc_register_form();
    if($form_id):
        $registration= new RM_WC_Registration($form_id);
        $registration->render();
    endif;
    
}

function rm_wc_check_fac()
{
    $form_id= get_rm_wc_register_form();
    if($form_id):
        
        $service = new RM_Front_Form_Service();
        //Form access interception
        $fac_responce = rmwc_test_form_access($form_id, $service);
        
        if ($fac_responce->status != 'allowed')
        {            
            echo "<div id='rmwc_fac_form'>";
            echo $fac_responce->html_str;
            echo "</div>";
            ?>
            <!-- CSS trickery to hide WooComm fields -->
            <style>
               .register p{ display: none !important;}
            </style>
            <?php
            echo ob_get_clean(); 
            add_filter('rmwc_field_render_start', 'rm_wc_prevent_render');
            return false;
        }
    endif;
}

function rm_wc_check_fac_during_checkout($fields)
{    
    $form_id= get_rm_wc_register_form();
    if($form_id):
        
        $service = new RM_Front_Form_Service();
        //Form access interception
        $fac_responce = rmwc_test_form_access($form_id, $service, false);
        
        if ($fac_responce->status != 'allowed')
        {            
            echo "<div id='rmwc_fac_form'>";
            echo $fac_responce->html_str;
            echo "</div>";
            ?>
            <!-- CSS trickery to hide WooComm fields -->
            <style>
               #customer_details, #order_review, #order_review_heading { display:none; }
               #rmwc_fac_form:after{ content: ""; display: block; clear: both;}
               #rmwc_fac_form button[type="submit"]{ margin: 10px 0px;}
            </style>
            <?php
            echo ob_get_clean(); 
            add_filter('rmwc_field_render_start', 'rm_wc_prevent_render');
            
            return array();
        }
    endif;
    return $fields;
}

function rm_wc_prevent_render()
{
    return false;
}


function rmwc_test_form_access($form_id, $service, $without_form_tag = true){
       $ffc = new RM_Front_Form_Controller;
       $ff = new RM_Form_Factory;
       $fe_form = $ff->create_form($form_id);
       
       return $ffc->test_form_access_v2($fe_form, $service, $_POST, array('without_form_tag' => $without_form_tag));
   }

function rm_wc_checkout_custom_fields(){ 
    $wc_guest_checkout= get_option('woocommerce_enable_guest_checkout');
    if($wc_guest_checkout!="yes")
    {
        $form_id= get_rm_wc_checkout_form(); 
        if(rm_is_form_expired($form_id)) 
        {   
            return;
        }
        if($form_id):
            $registration= new RM_WC_Registration($form_id);
            $registration->render();
        endif;
    }
    
    
}


function get_rm_wc_checkout_form(){
    $options = new RM_WC_Options;
     $form_id= $options->get_value_of('woo_registration_form');
    if($form_id && rm_is_form_expired($form_id))
    {
        $form = new RM_Forms;
        $form->load_from_db($form_id);
        $form_options= $form->get_form_options();
       // echo '<pre>';
        
        if($form_options->post_expiry_action=='switch_to_another_form')
        {  
            return $form_options->post_expiry_form_id;
        }
    }
    
    return $form_id;
}

function get_rm_wc_register_form(){
    $options = new RM_WC_Options;
    $form_id= $options->get_value_of('woo_registration_form');
    if($form_id && rm_is_form_expired($form_id))
    {
        $form = new RM_Forms;
        $form->load_from_db($form_id);
        $form_options= $form->get_form_options();
       // echo '<pre>';
        
        if($form_options->post_expiry_action=='switch_to_another_form')
        {  
            return $form_options->post_expiry_form_id;
        }
    }
    
    return $form_id;
}

function rm_wc_registration($username,$email,$validation_errors){      
    $form_id= get_rm_wc_register_form(); 
    if(!$form_id || rm_is_form_expired($form_id,$validation_errors)) 
    {
        return;
    }
    if($form_id):
        $registration= new RM_WC_Registration($form_id);
        $registration->save_submission($username,$email,$validation_errors);
    endif;
}

function rm_is_form_expired($form_id,$validation_errors=null)
{
    if(!$form_id)
            return true; 
    
    $form = new RM_Forms;
    $form->load_from_db($form_id);
    if($form==null)
            return true; 
        
    $service= new RM_Front_Form_Service;
     if ($service->is_ip_banned())
     {
         if($validation_errors!=null)
             $validation_errors->add("Form Banned",RM_UI_Strings::get('MSG_BANNED'));
        return true;
     }
     //Checking form expiration
     $rm_service = new RM_Services;
     if($rm_service->is_form_expired($form))
     {
         if($validation_errors!=null)
             $validation_errors->add("Form Expired",RM_UI_Strings::get('MSG_FORM_EXPIRY'));
          return true;
     }
           

     return false;
}
function rm_wc_customer_created($customer_id){
    $form_id= get_rm_wc_register_form();
    if(rm_is_form_expired($form_id)) 
    {
        return;
    }
    if($form_id):
        $registration= new RM_WC_Registration($form_id);
        $registration->update_user_profile($customer_id);
    endif;
}

function rm_wc_save_checkout_fields($username=null,$email=null,$validation_errors=null){ 
    $form_id= get_rm_wc_checkout_form();
    
    if(rm_is_form_expired($form_id,$validation_errors)){
        return;
    }
        
    if($form_id):
        $registration= new RM_WC_Registration($form_id);
        $registration->save_submission($username,$email,$validation_errors);
    endif;
}


function rm_wc_locate_template( $template, $template_name, $template_path ) {
  global $woocommerce;
  $rm_wc= rm_wc();
  $_template = $template;
 
  if (!$template_path):
      $template_path = $woocommerce->template_url;
  endif;
 
  $plugin_path  = $rm_wc->plugin_dir . 'includes/views/woocommerce/';
  // Look within passed path within the theme - this is priority
 
  $template = locate_template(array($template_path . $template_name,$template_name));
   
  if (!$template && file_exists( $plugin_path . $template_name ) ):
      $template = $plugin_path . $template_name;
  endif;

  // Use default template
  if ( ! $template )
    $template = $_template;

  // Return what we found
  return $template;
 
}
function filter_woocommerce_login_redirect(){
  $form_id= get_rm_wc_register_form();
  if(rm_is_form_expired($form_id)) 
  {
        return true;
  }
    if($form_id){
        $registration= new RM_WC_Registration($form_id);
   $registration->redirect_user();
    }
}

function rm_wc_show_profile_fields(){ 
    //data for user page
    $data = new stdClass;
    $user = wp_get_current_user();
    $service = new RM_Front_Service;
    if ($user instanceof WP_User) {
        $data->is_user = true;
        $data->user = $user;
        $data->custom_fields = $service->get_custom_fields($user->user_email);
    } else {
        $data->is_user = false;
    }
    ob_start();
    require_once rm_wc()->includes_dir.'views/my_account_user_details.php';    
    echo ob_get_clean();
}

function rm_wc_register_styles(){ 
    $rm_wc= rm_wc();
    wp_register_style('rm_wc_style', $rm_wc->template_url.'css/style.css');
}

function rm_wc_register_scripts(){
    $rm_wc= rm_wc();
    wp_register_script('rm_wc_script', $rm_wc->template_url.'js/front.js');
}

function rm_wc_extended_popup_button_menu($html){
    $cart = new WC_Cart();
    
    $cart->init();
    $cart_items = $cart->get_cart();
    $data = new stdClass;
    $data->cart_content_count = $cart->get_cart_contents_count();
    ob_start();
    require_once rm_wc()->includes_dir.'views/popup_button.php';
    
    $fe_wc = ob_get_clean();
    
    return $html.$fe_wc;
}

function rm_wc_extended_popup_button_menu_update($frags){
    global $woocommerce;
    $data = new stdClass;
    $data->cart_content_count = $woocommerce->cart->cart_contents_count;
    $data->ajax_request = true;
    ob_start();
    require_once plugin_dir_path(plugin_dir_path( __FILE__ )).'views/popup_button.php';   
    $fe_wc = ob_get_clean();
    $frags['#rm-wc-cart-open'] = $fe_wc;
    return $frags;
}


function rm_wc_extended_popup_button_content($html){
    $cart = new WC_Cart;
    $rm_options = new RM_WC_Options();
    
    $cart->init();
    $data = new stdClass;
    $data->cart_items = $cart->get_cart();
    $data->fab_theme = $rm_options->get_value_of('fab_theme');
    $data->fab_color = $rm_options->get_value_of('fab_color');
   
    foreach($data->cart_items as $item_id => $item)
    {
        $data->cart_items[$item_id]['remove_url'] =  $cart->get_remove_url($item_id);
    }
    
    $data->cart_content_count = $cart->cart_contents_count;
    $cart->calculate_totals();
    $data->cart_total = $cart->get_cart_total();
   
    $data->cart_url = wc_get_cart_url();
    ob_start();
    include rm_wc()->includes_dir.'views/popup_panel.php';    
    $fe_wc = ob_get_clean();
    return $html.$fe_wc;
}

function rm_wc_extended_popup_button_content_update($frags){
    global $woocommerce;
    $rm_options = new RM_WC_Options();
    $cart = $woocommerce->cart;//new WC_Cart();
    
    $data = new stdClass;
    $data->cart_items = $cart->get_cart();
    
    $data->fab_theme = $rm_options->get_value_of('fab_theme');
    $data->fab_color = $rm_options->get_value_of('fab_color');
    
    foreach($data->cart_items as $item_id => $item)
    {
        $data->cart_items[$item_id]['remove_url'] =  $cart->get_remove_url($item_id);
    }
    
    $data->cart_content_count = $cart->cart_contents_count;
    $cart->calculate_totals();
    $data->cart_total = $cart->get_cart_total();
    $data->cart_url = $cart->get_cart_url();
    $data->ajax_request = true;
    ob_start();
    
    
    include plugin_dir_path(plugin_dir_path( __FILE__ )).'views/popup_panel.php'; 
    
    $fe_wc = ob_get_clean();
    $frags['#rmwc-pu-cart-panel'] = $fe_wc;
    return $frags;
}

function rm_wc_extended_fe_tabtitle($html, $uid)
{
    $tab_titles = '';
    ob_start();
   // echo '<li><a href="#rmwc_orders_tab">'.RM_WC_UI_Strings::get('LABEL_ORDERS').'</a></li>';
   // echo '<li><a href="#rmwc_downloads_tab">'.RM_WC_UI_Strings::get('LABEL_DOWNLOADS').'</a></li>';
   // echo '<li><a href="#rmwc_address_tab">'.RM_WC_UI_Strings::get('LABEL_ADDRESSES').'</a></li>';
    
    echo '<div class="rmtabs_head" title="'. RM_WC_UI_Strings::get('LABEL_ORDERS').'" data-rmt-tabcontent="#rmwc_orders_tab"><i class="material-icons">inbox</i> '.RM_WC_UI_Strings::get('LABEL_ORDERS').'</a></div>';
    echo '<div class="rmtabs_head" title="'. RM_WC_UI_Strings::get('LABEL_DOWNLOADS').'" data-rmt-tabcontent="#rmwc_downloads_tab"><i class="material-icons">cloud_download</i> '.RM_WC_UI_Strings::get('LABEL_DOWNLOADS').'</a></div>';
    echo '<div class="rmtabs_head" title="'. RM_WC_UI_Strings::get('LABEL_ADDRESSES').'" data-rmt-tabcontent="#rmwc_address_tab"><i class="material-icons">home</i> '.RM_WC_UI_Strings::get('LABEL_ADDRESSES').'</a></div>';
    
    $tab_titles = ob_get_clean();
    return $html.$tab_titles;
}

function rm_wc_extended_fe_tabcontent($html, $uid)
{
    $tab_contents = '';
    $orders = rmwch_get_orders($uid);
    $downloads = wc_get_customer_available_downloads($uid);
    $customer_shipping_address = rmwch_get_formatted_shipping_name_and_address($uid, "<br/>");
    $customer_billing_address = rmwch_get_formatted_billing_name_and_address($uid, "<br/>");
    ob_start();//die('xxxxxx');
    include rm_wc()->includes_dir.'views/frontend_tab_content.php';    
    $tab_contents = ob_get_clean();
    return $html.$tab_contents;
}

function rmwch_get_orders($user_id)
{
    $orders = array();
    $order_types = wc_get_order_types();
    $order_statuses = wc_get_order_statuses();
    
    // Get all customer orders
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $user_id,
        'post_type'   => $order_types,
        'post_status' => array_keys( $order_statuses ),
    ) );
    $order_factory = new WC_Order_Factory();
    foreach($customer_orders as $order)
    {
        //$order_detail = new WC_Order();
        //$order_detail->populate($order);
        //var_dump($order2);
        $order2 = $order_factory->get_order($order->ID);
        $single_order = new stdClass;
        $single_order->id = $order->ID;
        $single_order->status = $order_statuses[$order->post_status];
        $single_order->item_count = $order2->get_item_count();
        $single_order->shipping_address = rmwch_get_shipping_address_inline($order2);
        $single_order->placed_on = $order->post_date;
        $single_order->total = $order2->get_formatted_order_total();
        $single_order->wc_order_object = $order2;
        $orders[] = $single_order;
    }
    
    return $orders;
}

function rmwch_get_shipping_address_inline(WC_ORDER $o)
{
    return str_replace('<br/>',', ', $o->get_formatted_shipping_address());
}

function rmwch_get_billing_address_inline(WC_ORDER $o)
{
    return str_replace('<br/>',', ', $o->get_formatted_billing_address());
}

function rmwch_get_formatted_shipping_name_and_address($user_id, $newline_char="\n") {

    $address = array();
    $address[] = trim(get_user_meta( $user_id, 'shipping_first_name', true ).' '.get_user_meta( $user_id, 'shipping_last_name', true ));
    $address[] = get_user_meta( $user_id, 'shipping_company', true );
    $address[] = get_user_meta( $user_id, 'shipping_address_1', true );
    $address[] = get_user_meta( $user_id, 'shipping_address_2', true );
    $address[] = get_user_meta( $user_id, 'shipping_city', true );
    $address[] = get_user_meta( $user_id, 'shipping_state', true );
    $address[] = get_user_meta( $user_id, 'shipping_postcode', true );
    $address[] = get_user_meta( $user_id, 'shipping_country', true );
    
    $address = array_filter($address);
    $f_add = implode($newline_char, $address);
    return trim($f_add);
}

function rmwch_get_formatted_billing_name_and_address($user_id, $newline_char="\n") {

    $address = array();
    $address[] =  trim(get_user_meta( $user_id, 'billing_first_name', true ).' '.get_user_meta( $user_id, 'billing_last_name', true ));
    $address[] =  get_user_meta( $user_id, 'billing_company', true );
    $address[] =  get_user_meta( $user_id, 'billing_address_1', true );
    $address[] =  get_user_meta( $user_id, 'billing_address_2', true );
    $address[] =  get_user_meta( $user_id, 'billing_city', true );
    $address[] =  get_user_meta( $user_id, 'billing_state', true );
    $address[] =  get_user_meta( $user_id, 'billing_postcode', true );
    $address[] =  get_user_meta( $user_id, 'billing_country', true );

    $address = array_filter($address);
    $f_add = implode($newline_char, $address);
    return trim($f_add);
}

function rmwch_get_user_item_count($user)
{
    global $wpdb;
    $sql = $wpdb->prepare("SELECT SUM(oim.meta_value) total_item_count FROM wp_posts p JOIN wp_woocommerce_order_items oi ON p.ID = oi.order_id JOIN wp_woocommerce_order_itemmeta oim ON oi.order_item_id = oim.order_item_id JOIN wp_postmeta pm ON pm.post_id = p.ID WHERE pm.meta_key = '_customer_user' AND pm.meta_value = %d AND oim.meta_key = %s", $user, '_qty');
    return $wpdb->get_var($sql);
}

