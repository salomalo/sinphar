<?php

/**
 * Repository of all the string resources used in Dropbox integration
 * for easy translation and management. 
 *
 */

class RM_Dpx_UI_Strings
{
    public static function get($identifier)
    {
        switch($identifier)
        {
            
            case 'LABEL_DPX_ACCESS_TOKEN':
                return __('Dropbox App Access Token','registrationmagic-gold');
                
            case 'LABEL_ENABLE_DPX':
                return __('Upload submission PDF on Dropbox','registrationmagic-gold');
             
            case 'HELP_OPTIONS_DPX':
                return __('Enables Dropbox integration. Submission PDF will be uploaded in corresponding Form folder. Make sure Dropbox App Token is configured in \'External Integrations\'(Global Settings).','registrationmagic-gold');    
                
            case 'HELP_OPTIONS_DPX_TOKEN':
                return __('Dropbox uses App Token for authentication purpose. Token can be generated after creating an App. For more details <a target="_blank" href="https://www.dropbox.com/developers/reference/oauth-guide">Click Here</a>. Once token configured you can enable integration from individual form\'s <b>Post Submission</b> Settings.','registrationmagic-gold'); 
            
            case 'LABEL_F_DPX_SETT':
                return __('Dropbox','registrationmagic-gold');
                
            default:
                return __("NO STRING FOUND (rmdpx)", 'registrationmagic-gold');
        }
    }
}