<?php

/**
 * This class works as a repository of all the string resources used in product UI
 * for easy translation and management. 
 *
 * @author CMSHelplive
 */

class RM_OLP_UI_Strings
{
    public static function get($identifier)
    {
        switch($identifier)
        {
            case 'OLP_INFO_EMAIL_DEF_SUB':
                return __('Payment details for your submission on - {{SITE_NAME}}','registrationmagic-gold');
            
            case 'OLP_INFO_EMAIL_DEF_BODY':
                return __('<div>Hi,<br/><p>Please pay {{TOTAL_AMOUNT}} to complete your registration. If you require further details regarding offline payment please contact administrator.</p></div>','registrationmagic-gold');
            
            case 'HELP_OLP_SEND_EMAIL_INFO':
                return __('Enable to send an email to user regarding payment. If you do not want to use this email you can include payment information in autoresponder email.','registrationmagic-gold');
            
            case 'HELP_OLP_EMAIL_INFO':
                return __('Content of the email to send. Useful for including information about offline payment such as bank account information etc.','registrationmagic-gold');

            case 'LABEL_OLP_SEND_EMAIL':
                return __('Send Email','registrationmagic-gold');
            
            case 'LABEL_OLP_SEND_EMAIL_INFO':
                return __('Message','registrationmagic-gold');               
            
            case 'LABEL_OLP_PAY_OFFLINE':
                return __('Pay Offline','registrationmagic-gold');
            
            default:
                return __("NO STRING FOUND (rmolp)", 'registrationmagic-gold');
        }
    }
}