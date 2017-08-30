<?php

/**
 * Repository of all the string resources
 * for easy translation and management. 
 *
 */

class RM_NLetter_UI_Strings
{
    public static function get($identifier)
    {
        switch($identifier)
        {
            
            case 'NAME_NLETTER':
                return __('Newsletter','registrationmagic-gold');
                
            case 'LABEL_NLETTER_INTEGRATION':
                return __('Newsletter Integration','registrationmagic-gold');
             
           case 'LABEL_NLETTER_LIST':
                return __('Send To Newsletter List', 'registrationmagic-gold');
   
            case 'HELP_ADD_FORM_MP_LIST':
                return __("Required for connecting the Newsletter list. To make it work, Please enable Newsletter Integration in Global Settings &#8594; <a target='blank' class='rm_help_link' href='admin.php?page=rm_options_thirdparty'>External Integration</a>.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_NL_ENABLE':
                return __('Enable Newsletter Integration', 'registrationmagic-gold');
                
            case 'NL_ERROR':
                return __("<div class='rmnotice'>Oops!! Something went wrong.<ul><li>Possible causes:-</li><li><a target='_blank' href='https://wordpress.org/plugins/newsletter/'>Newsletter</a> is not installed/active.</li></ul></div>", 'registrationmagic-gold');
                
            case 'LABEL_FIRST_NAME':
                return __('First Name','registrationmagic-gold');
                
            case 'LABEL_LAST_NAME':
                return __('Last Name','registrationmagic-gold');
             
            case 'LABEL_GENDER':
                return __('Gender', 'registrationmagic-gold');
   
               
            default:
                return __("NO STRING FOUND (rmdpx)", 'registrationmagic-gold');
        }
    }
}