<?php

/**
 * Repository of all the string resources used in Dropbox integration
 * for easy translation and management. 
 *
 */

class RM_MailPoet_UI_Strings
{
    public static function get($identifier)
    {
        switch($identifier)
        {
            
            case 'NAME_MAILPOET':
                return __('MailPoet','registrationmagic-gold');
                
            case 'LABEL_MAILPOET_INTEGRATION':
                return __('MailPoet Integration','registrationmagic-gold');
             
            case 'HELP_OPTIONS_THIRDPARTY_MC_ENABLE':
                return __("This will allow you to fetch your MailPoet lists in individual form settings and map selective fields to your MailPoet fields.", 'registrationmagic-gold');
                
           case 'LABEL_MAILPOET_LIST':
                return __('Send To MailPoet List', 'registrationmagic-gold');
   
            case 'HELP_ADD_FORM_MP_LIST':
                return __("Required for connecting the form with a MailPoet Form(List). To make it work, please set MailPoet in Global Settings &#8594; <a target='blank' class='rm_help_link' href='admin.php?page=rm_options_thirdparty'>External Integration</a>.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_MP_ENABLE':
                return __('Enable MailPoet Integration', 'registrationmagic-gold');
                
            case 'MP_ERROR':
                return __("<div class='rmnotice'>Oops!! Something went wrong.<ul><li>Possible causes:-</li><li><a target='_blank' href='https://wordpress.org/plugins/wysija-newsletters/'>MailPoet</a> is not installed/active.</li></ul></div>", 'registrationmagic-gold');
    
            case 'HELP_SUPP_DATE_FIELDS':
                 return __("Supports RM date format with dd,mm,yy", 'registrationmagic-gold');
    
            default:
                return __("NO STRING FOUND (rmdpx)", 'registrationmagic-gold');
        }
    }
}
