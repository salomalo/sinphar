<?php

/**
 * This class works as a repository of all the string resources used in product UI
 * for easy translation and management. 
 *
 * @author CMSHelplive
 */

class RM_WC_UI_Strings
{
    public static function get($identifier)
    {
        switch($identifier)
        {
            case 'LABEL_SHIPPING_ADDRESS':
                return __('Shipping Address','registrationmagic-gold');
                
            case 'LABEL_BILLING_ADDRESS':
                return __('Billing Address','registrationmagic-gold');
            
            case 'LABEL_ORDER':
                return __('Order','registrationmagic-gold');    
            
            case 'LABEL_ORDERS':
                return __('Orders','registrationmagic-gold');    
            
            case 'LABEL_ORDER_DETAILS':
                return __('Order details','registrationmagic-gold');      
            
            case 'LABEL_DOWNLOADS':
                return __('Downloads','registrationmagic-gold');
            
            case 'LABEL_DOWNLOAD':
                return __('Download','registrationmagic-gold');    
            
            case 'LABEL_ADDRESSES':
                return __('Addresses','registrationmagic-gold');
                
            case 'LABEL_VIEW':
                return __('View','registrationmagic-gold');
            
            case 'LABEL_NAME':
                return __('Name','registrationmagic-gold');
                
            case 'LABEL_TOTAL':
                return __('Total','registrationmagic-gold');
                
            case 'LABEL_SUBTOTAL':
                return __('Subtotal','registrationmagic-gold');
                
            case 'LABEL_SHIPPING':
                return __('Shipping','registrationmagic-gold');
                
            case 'LABEL_DISCOUNT':
                return __('Discount','registrationmagic-gold');
                
            case 'LABEL_TOTAL_DISCOUNT':
                return __('Total Discount','registrationmagic-gold');
                
            case 'LABEL_ORDER_TOTAL':
                return __('Order Total','registrationmagic-gold');
                
            case 'LABEL_COUPONS_USED':
                return __('Coupon(s) Used','registrationmagic-gold');
                
            case 'LABEL_PRODUCT_NAME':
                return __('Product Name','registrationmagic-gold');
                
            case 'LABEL_QUANTITY':
                return __('Quantity','registrationmagic-gold');
                
            case 'LABEL_COST':
                return __('Cost','registrationmagic-gold');
                
            case 'NOTICE_NO_SHIPPING_ADDRESS_USER':
                return __('User has not set up shipping address yet.','registrationmagic-gold');
                
            case 'NOTICE_NO_BILLING_ADDRESS_USER':
                return __('User has not set up billing address yet.','registrationmagic-gold');
                
            case 'LABEL_REMAINING_DOWNLOADS':
                return __('Remaining Downloads','registrationmagic-gold');
                
            case 'LABEL_ACCESS_EXPIRES':
                return __('Access Expires','registrationmagic-gold');
                
            case 'LABEL_ORDER_STATUS':
                return __('Status','registrationmagic-gold');
                
            case 'LABEL_AMOUNT':
                return __('Amount','registrationmagic-gold');
                
            case 'LABEL_PLACED_ON':
                return __('Placed on','registrationmagic-gold');
                
            case 'LABEL_ITEMS':
                return __('Items','registrationmagic-gold');
                
            case 'LABEL_REMAINING_DLS_UNLIMITED':
                return __('Unlimited','registrationmagic-gold');
                
            case 'LABEL_ACCESS_EXPIRES_NEVER':
                return __('Never','registrationmagic-gold');
                
            case 'LABEL_WOO_REG_FORM' : 
                return __ ('Registration Form', 'registrationmagic-gold');
                
            case 'HELP_WOO_REG_FORM' : 
                return __ ('Once selected, fields of this form will appear in the default WooCommerce registration page.', 'registrationmagic-gold');
                
            case 'LABEL_RM_GLOBAL_SETTING_MENU' : 
                return __ ('WooCommerce Integration', 'registrationmagic-gold');
                
            case 'SUBTITLE_RM_GLOBAL_SETTING_MENU' : 
                return __ ('Integrate forms inside WooCommerce', 'registrationmagic-gold');
                
            case 'LABEL_GO_SHOP' : 
                return __ ('Go shopping!', 'registrationmagic-gold');
                
            case 'LABEL_CART_EMPTY' : 
                return __ ('No item in the cart', 'registrationmagic-gold');
                
            case 'LABEL_TOTAL_REVENUE':
                return __('Total Revenue','registrationmagic-gold');
                
            case 'LABEL_ENABLE_CART_IN_FAB':
                return __('Show cart on popup menu','registrationmagic-gold');
                
            case 'HELP_ENABLE_CART_IN_FAB':
                return __('Enables quick access to the cart from the front-end Magic Popup menu.','registrationmagic-gold');
                
            case 'LABEL_ORDER_NOTES':
                return __('Order Notes','registrationmagic-gold');
                
            case 'LABEL_ORDER_NOTE_FOOTER':
                return __('Added by %s on %s','registrationmagic-gold');
                
            case 'ALERT_GUEST_CHECKOUT_ENABLED':
                return __('Guest Checkout is enabled in WooCommerce. Disable it to display RegistrationMagic form for registration during checkout. <a href="%s" target="_blank">Click here</a> to configure.','registrationmagic-gold');
            
             case 'NAME_WC':
                return __('WooCommerce','registrationmagic-gold');
                
             case 'WC_ERROR':
                return __("<div class='rmnotice'>Oops!! Something went wrong.<ul><li>Possible causes:-</li><li><a target='_blank' href='https://wordpress.org/plugins/woocommerce/'>Woocommerce</a> is not installed/active.</li></ul></div>", 'registrationmagic-gold');
                 
            case 'WC_FORM_SETTING_TEXT':
             return __("<div class='rmnotice'>You can configure Woocommerce from <a href='?page=rm_wc_settings'>Global Settings->Woocommerce Integration</a></div>",'registrationmagic-gold');
                
            case 'LABEL_ENABLE_RM_ROLE_OVERRIDE':
                return __('Allow user role assignment according to form settings','registrationmagic-gold');
                
            case 'HELP_ENABLE_RM_ROLE_OVERRIDE':
                return __('If disabled, default woocommerce role will be assigned to the user. Otherwise, user will be assigned role configured in form settings.','registrationmagic-gold');
                    
            default:
                return __("NO STRING FOUND (rmwc)", 'registrationmagic-gold');
        }
    }
}