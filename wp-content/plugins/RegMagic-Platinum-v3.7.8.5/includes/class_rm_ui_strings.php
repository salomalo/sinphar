<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class works as a repository of all the string resources used in product UI
 * for easy translation and management. 
 *
 * @author CMSHelplive
 */
class RM_UI_Strings {

    public static function get($identifier) {

        switch ($identifier) {
            
            case 'PH_USER_ROLE_DD':
                return __('Select User Role', 'registrationmagic-gold');

            case 'TITLE_NEW_FORM_PAGE':
                return __('New Registration Form', 'registrationmagic-gold');

            case 'SUBTITLE_NEW_FORM_PAGE':
                return __('Some options in this form will only work after you have created custom fields.', 'registrationmagic-gold');

            case 'TITLE_EDIT_PAYPAL_FIELD_PAGE':
                return __('Edit Product', 'registrationmagic-gold');

            case 'TITLE_USER_EDIT_PAGE':
                return __('Edit User', 'registrationmagic-gold');

            case 'TITLE_NEW_PAYPAL_FIELD_PAGE':
                return __('New Product', 'registrationmagic-gold');

            case 'TITLE_ATTACHMENT_PAGE':
                return __('Attachments', 'registrationmagic-gold');

            case 'TITLE_SUBMISSION_MANAGER':
                return __('Inbox', 'registrationmagic-gold');

            case 'HEADING_ADD_ROLE_FORM':
                return __('Add New Role', 'registrationmagic-gold');

            case 'LABEL_FORM_TITLE':
                return __('Form Title', 'registrationmagic-gold');

            case 'LABEL_UNIQUE_TOKEN_SHORT':
                return __('Unique Token No.', 'registrationmagic-gold');

            case 'LABEL_NOTE_TEXT':
                return __('Note Text', 'registrationmagic-gold');

            case 'LABEL_ADD_OTHER':
                return __('Allow Users to input custom value?', 'registrationmagic-gold');

            case 'MAIL_REGISTRAR_DEF_SUB':
                return __('Your Submission', 'registrationmagic-gold');

            case 'MAIL_NEW_USER_DEF_SUB':
                return __('New User', 'registrationmagic-gold');

            case 'MSG_THEIR_ANS':
                return __('User Input', 'registrationmagic-gold');

            case 'MSG_NO_FIELD_STAT_DATA':
                return __('No data recorded for this field to generate pie chart', 'registrationmagic-gold');

            case 'LABEL_FIELD_LABEL':
                return __('Field Label', 'registrationmagic-gold');

            case 'LABEL_NOTE_COLOR':
                return __('Note Color', 'registrationmagic-gold');

            case 'LABEL_MY_SUBS':
                return __('Registrations', 'registrationmagic-gold');

            case 'LABEL_MY_SUB':
                return __('Registration', 'registrationmagic-gold');

            case 'LABEL_OPT_IN_CB':
                return __('Show opt-in checkbox', 'registrationmagic-gold');

            case 'HELP_OPT_IN_CB':
                return __('Display a checkbox, allowing users to opt-in for subscription.', 'registrationmagic-gold');

            case 'LABEL_OPT_IN_CB_TEXT':
                return __('Opt-in checkbox text', 'registrationmagic-gold');

            case 'MSG_NO_SUBMISSION_MATCHED':
                return __('No Submission matched your search.', 'registrationmagic-gold');

            case 'HELP_OPT_IN_CB_TEXT':
                return __('This text will appear with the opt-in checkbox.', 'registrationmagic-gold');

            case 'PH_NO_FORMS':
                return __('No Forms', 'registrationmagic-gold');

            case 'LABEL_PAY_HISTORY':
                return __('Payment History', 'registrationmagic-gold');

            case 'MSG_NOT_AUTHORIZED':
                return __('You are not authorized to view the contents of this page. Please log in to view the submissions', 'registrationmagic-gold');

            case 'MSG_FORM_EXPIRY':
                return __('This Form has expired.', 'registrationmagic-gold');

            case 'MSG_NO_FIELDS':
                return __('This Form has no fields.', 'registrationmagic-gold');

            case 'LABEL_LOG_OFF':
                return __('Log Off', 'registrationmagic-gold');

            case 'LABEL_PRINT':
                return __('Print', 'registrationmagic-gold');

            case 'LABEL_VISIBLE_FRONT':
                return __('Visible to User on Front-End', 'registrationmagic-gold');

            case 'LABEL_SELECT':
                return __('Select', 'registrationmagic-gold');

            case 'LABEL_BACK':
                return __('Back', 'registrationmagic-gold');

            case 'LABEL_ADD_NOTE':
                return __('Add Note', 'registrationmagic-gold');

            case 'LABEL_STATUS_PAYMENT':
                return __('Payment Status', 'registrationmagic-gold');

            case 'MSG_SUBSCRIBE':
                return __('Subscribe for emails', 'registrationmagic-gold');

            case 'LABEL_FAILED':
                return __('Failed', 'registrationmagic-gold');

            case 'MSG_USER_PASS_NOT_SET':
                return __('User Password is not set.', 'registrationmagic-gold');

            case 'LABEL_PAID_AMOUNT':
                return __('Paid Amount', 'registrationmagic-gold');

            case 'LABEL_AMOUNT':
                return __('Amount', 'registrationmagic-gold');

            case 'MSG_NO_DATA_FOR_EMAIL':
                return __('No submission data for this email.', 'registrationmagic-gold');

            case 'LABEL_TXN_ID':
                return __('Transaction Id', 'registrationmagic-gold');

            case 'LABEL_SUPPORT_EMAIL_LINK':
                return __('Email', 'registrationmagic-gold');

            case 'LABEL_PREVIOUS':
                return __('Prev', 'registrationmagic-gold');

            case 'LABEL_NEXT':
                return __('Next', 'registrationmagic-gold');

            case 'LABEL_FIRST':
                return __('First', 'registrationmagic-gold');

            case 'LABEL_LAST':
                return __('Last', 'registrationmagic-gold');

            case 'LABEL_LAYOUT':
                return __('Layout', 'registrationmagic-gold');

            case 'LABEL_LAYOUT_LABEL_LEFT':
                return __('Label left', 'registrationmagic-gold');

            case 'LABEL_LAYOUT_LABEL_TOP':
                return __('Label top', 'registrationmagic-gold');

            case 'LABEL_LAYOUT_TWO_COLUMNS':
                return __('Two columns', 'registrationmagic-gold');


            case 'LABEL_NO_FORMS':
                return __('No forms.', 'registrationmagic-gold');
                
            case 'LOGIN_ERROR':
                return __("The password you entered is incorrect.", 'custom-registration-form-builder-with-submission-manager');


            case 'MSG_DO_NOT_HAVE_ACCESS':
                return __('You do not have access to see this page.', 'registrationmagic-gold');

            case 'LABEL_DATE_OF_PAYMENT':
                return __('Date Of Payment', 'registrationmagic-gold');

            case 'MSG_INVALID_SUBMISSION_ID_FOR_EMAIL':
                return __('Invalid Submission Id', 'registrationmagic-gold');

            case 'MSG_INVALID_SUBMISSION_ID':
                return __('Invalid Submission Id', 'registrationmagic-gold');

            case 'MSG_NO_CUSTOM_FIELDS':
                return __('No custom field values available for this user.<br>This area displays fields marked by &quot;Add this field to User Account&quot;.', 'registrationmagic-gold');

            case 'MSG_NO_SUBMISSIONS_USER':
                return __('This user has not submitted any forms yet.', 'registrationmagic-gold');

            case 'MSG_NO_FORMS_ATTACHMENTS':
                return __('You have not created any form yet.<br>Once you have created a form and submissions start coming, this area will show all submitted attachments for the form.', 'registrationmagic-gold');

            case 'MSG_NO_PAYMENTS_USER':
                return __('No payment records exist for this user.', 'registrationmagic-gold');

            case 'LABEL_REGISTRATIONS':
                return __('Inbox', 'registrationmagic-gold');

            case 'LABEL_INVOICE':
                return __('Payment Invoice', 'registrationmagic-gold');

            case 'LABEL_TAXATION_ID':
                return __('Payment TXN ID', 'registrationmagic-gold');

            case 'LABEL_CREATED_BY':
                return __('Created By', 'registrationmagic-gold');

            case 'LABEL_TYPES':
                return __('Types', 'registrationmagic-gold');

            case 'NO_SUBMISSION_FOR_FORM':
                return __('No Submissions for this form yet.', 'registrationmagic-gold');

            case 'LABEL_TYPE':
                return __('Type', 'registrationmagic-gold');

            case 'HELP_PRICE_FIELD':
                return __('Please Enter a value greater than zero.', 'registrationmagic-gold');

            case 'HELP_PASSWORD_MIN_LENGTH':
                return __('Password must be at least 7 characters long.', 'registrationmagic-gold');

            case 'MSG_NO_FORM_SUB_MAN':
                return __('No Forms you have created yet.<br>Once you have created a form and submissions start coming, this area will show you a nice little table with all the submissions.', 'registrationmagic-gold');

            case 'FORM_ERR_INVALID':
                return __("%element% is invalid.", 'registrationmagic-gold');

            case 'FORM_ERR_FILE_TYPE':
                return __("Invalid type of file uploaded in %element%.", 'registrationmagic-gold');

            case 'FORM_ERR_INVALID_DATE':
                return __("%element% must contain a valid date.", 'registrationmagic-gold');

            case 'FORM_ERR_INVALID_EMAIL':
                return __("%element% must contain a valid email address.", 'registrationmagic-gold');

            case 'FORM_ERR_INVALID_NUMBER':
                return __("%element% must be numeric.", 'registrationmagic-gold');

            case 'FORM_ERR_INVALID_REGEX':
                return __("%element% contains invalid charcters.", 'registrationmagic-gold');

            case 'FORM_ERR_INVALID_URL':
                return __("%element% must contain a url (e.g. http://www.google.com).", 'registrationmagic-gold');

            case 'LABEL_ROLE_DISPLAY_NAME':
                return __('Display Name For Role', 'registrationmagic-gold');

            case 'LABEL_FORM_DESC':
                return __('Form Description', 'registrationmagic-gold');

            case 'LABEL_NO_ATTACHMENTS':
                return __('No Attachments for this form yet.', 'registrationmagic-gold');

            case 'LABEL_CUSTOM_FIELD':
                return __('Details', 'registrationmagic-gold');

            case 'LABEL_DOWNLOAD_ALL':
                return __('Download All', 'registrationmagic-gold');

            case 'LABEL_DOWNLOAD':
                return __('Download', 'registrationmagic-gold');

            case 'LABEL_SR':
                return __('Sr.', 'registrationmagic-gold');

            case 'LABEL_CREATE_WP_ACCOUNT':
                return __('Also create WP User account', 'registrationmagic-gold');

            case 'LABEL_DO_ASGN_WP_USER_ROLE':
                return __('Automatically Assigned WP User Role', 'registrationmagic-gold');

            case 'LABEL_LET_USER_PICK':
                return __('Or Let Users Pick Their Role', 'registrationmagic-gold');

            case 'LABEL_USER_ROLE_FIELD':
                return __('WP User Role Field Label', 'registrationmagic-gold');

            case 'LABEL_ALLOW_WP_ROLE':
                return __('Allow Role Selection from', 'registrationmagic-gold');

            case 'LABEL_ROLE':
                return __('Role', 'registrationmagic-gold');

            case 'LABEL_CONTENT_ABOVE':
                return __('Content Above The Form', 'registrationmagic-gold');

            case 'LABEL_SUCC_MSG':
                return __('Success Message', 'registrationmagic-gold');

            case 'LABEL_UNIQUE_TOKEN':
                return __('Show Unique Token Number', 'registrationmagic-gold');

            case 'LABEL_USER_REDIRECT':
                return __('After Submission, Redirect User to', 'registrationmagic-gold');

            case 'LABEL_PAGE':
                return __('Page', 'registrationmagic-gold');

            case 'LABEL_URL':
                return __('URL', 'registrationmagic-gold');

            case 'LABEL_AUTO_REPLY':
                return __('Auto-Reply the User', 'registrationmagic-gold');

            case 'LABEL_AR_EMAIL_SUBJECT':
                return __('Auto-Reply Email Subject', 'registrationmagic-gold');

            case 'LABEL_AR_EMAIL_BODY':
                return __('Auto-Reply Email Body', 'registrationmagic-gold');

            case 'LABEL_SUBMIT_BTN':
                return __('Submit Button Label', 'registrationmagic-gold');

            case 'LABEL_SUBMIT_BTN_COLOR':
                return __('Submit Button Label Color', 'registrationmagic-gold');

            case 'MSG_NO_SUBMISSION_SUB_MAN':
                return __('No Submissions for this form yet.<br>Once submissions start coming, this area will show you a nice little table with all the submissions.', 'registrationmagic-gold');

            case 'MSG_NO_SUBMISSION_SUB_MAN_INTERVAL':
                return __('No Submissions during the period.', 'registrationmagic-gold');

            case 'LABEL_SUBMIT_BTN_COLOR_BCK':
                return __('Submit Button Background Color', 'registrationmagic-gold');

            case 'LABEL_AUTO_EXPIRE':
                return __('Auto Expires', 'registrationmagic-gold');

            case 'LABEL_EXPIRY':
                return __('Limits', 'registrationmagic-gold');

            case 'LABEL_SUB_LIMIT':
                return __('Submissions Limit', 'registrationmagic-gold');

            case 'LABEL_EXPIRY_DATE':
                return __('Date of Expiry', 'registrationmagic-gold');

            case 'LABEL_EXPIRY_MSG':
                return __('Display Message in Place of the Form After the Limit Expires', 'registrationmagic-gold');

            case 'LABEL_SAVE':
                return __('Save', 'registrationmagic-gold');

            case 'LABEL_CANCEL':
                return __('Cancel', 'registrationmagic-gold');

            case 'LABEL_CREATE_WP_ACCOUNT_DESC':
                return __('This will add Username and Password fields to this form', 'registrationmagic-gold');

            case 'TITLE_FORM_MANAGER':
                return __('All Forms', 'registrationmagic-gold');

            case 'LABEL_ADD_NEW':
                return __('New Form', 'registrationmagic-gold');

            case 'LABEL_ADD_NEW_FIELD':
                return __('Add Field', 'registrationmagic-gold');

            case 'LABEL_DUPLICATE':
                return __('Duplicate', 'registrationmagic-gold');

            case 'LABEL_FILTERS':
                return __('Filters', 'registrationmagic-gold');

            case 'LABEL_TIME':
                return __('Time', 'registrationmagic-gold');

            case 'LABEL_SUBMISSIONS':
                return __('Submissions', 'registrationmagic-gold');

            case 'LABEL_SEARCH':
                return __('Search', 'registrationmagic-gold');

            case 'LABEL_BY_NAME':
                return __('By Name', 'registrationmagic-gold');

            case 'LABEL_SORT':
                return __('Sort', 'registrationmagic-gold');

            case 'LABEL_LAST_AT':
                return __('Last at', 'registrationmagic-gold');

            case 'LABEL_FIELDS':
                return __('Fields', 'registrationmagic-gold');

            case 'LABEL_SUCCESS_RATE':
                return __('Success rate', 'registrationmagic-gold');

            case 'LABEL_LAST_MODIFIED_BY':
                return __('Last modified by', 'registrationmagic-gold');

            case 'LABEL_EDIT':
                return __('Edit', 'registrationmagic-gold');

            case 'LABEL_EDITED_BY':
                return __('Edited By', 'registrationmagic-gold');

            case 'LABEL_PAYER_NAME':
                return __('Payer name', 'registrationmagic-gold');

            case 'LABEL_PAYER_EMAIL':
                return __('Payer email', 'registrationmagic-gold');

            case 'MSG_NO_FORMS':
                return __('No Forms Yet', 'registrationmagic-gold');

            case 'MSG_NO_FORMS_FUNNY':
                return __('No Forms Yet! Why not create one.', 'registrationmagic-gold');


            case 'LABEL_SUBMIT_BTN_COLOR_BCK_DSC':
                return __('Does not works with Classic form style', 'registrationmagic-gold');

            case 'LABEL_SELECT_TYPE':
                return __('Select Type', 'registrationmagic-gold');

            case 'TITLE_NEW_FIELD_PAGE':
                return __('New Field', 'registrationmagic-gold');

            case 'LABEL_LABEL':
                return __('Label', 'registrationmagic-gold');

            case 'LABEL_PLACEHOLDER_TEXT':
                return __('Placeholder text', 'registrationmagic-gold');

            case 'LABEL_CSS_CLASS':
                return __('CSS Class Attribute', 'registrationmagic-gold');

            case 'LABEL_MAX_LENGTH':
                return __('Maximum Length', 'registrationmagic-gold');

            case 'TEXT_RULES':
                return __('Rules', 'registrationmagic-gold');

            case 'LABEL_IS_REQUIRED':
                return __('Is Required', 'registrationmagic-gold');

            case 'LABEL_SHOW_ON_USER_PAGE':
                return __('Add this field to User Account', 'registrationmagic-gold');

            case 'LABEL_PARAGRAPF_TEXT':
                return __('Paragraph Text', 'registrationmagic-gold');

            case 'LABEL_OPTIONS':
                return __('Options', 'registrationmagic-gold');

            case 'LABEL_DROPDOWN_OPTIONS_DSC':
                return __('value seprated by comma ","', 'registrationmagic-gold');

            case 'LABEL_DEFAULT_VALUE':
                return __('Default Value', 'registrationmagic-gold');

            case 'LABEL_COLUMNS':
                return __('Columns', 'registrationmagic-gold');

            case 'LABEL_VALUE':
                return __('Value', 'registrationmagic-gold');

            case 'LABEL_ROWS':
                return __('Rows', 'registrationmagic-gold');

            case 'LABEL_IS_READ_ONLY':
                return __('Is Read Only', 'registrationmagic-gold');

            case 'LABEL_T_AND_C':
                return __('Terms & Conditions', 'registrationmagic-gold');

            case 'LABEL_FILE_TYPES':
                return __('Define allowed file types (file extensions)', 'registrationmagic-gold');

            case 'LABEL_FILE_TYPES_DSC':
                return __('For example PDF|JPEG|XLS', 'registrationmagic-gold');

            case 'LABEL_PRICING_FIELD':
                return __('Select Product', 'registrationmagic-gold');

            case 'LABEL_PRICE':
                return __('Price', 'registrationmagic-gold');

            case 'VALUE_CLICK_TO_ADD':
                return __('Click to add more', 'registrationmagic-gold');

            case 'TITLE_EDIT_FORM_PAGE':
                return __('Edit Form', 'registrationmagic-gold');

            case 'TITLE_FORM_FIELD_PAGE':
                return __('Fields Manager', 'registrationmagic-gold');

            case 'LABEL_ADD_FIELD':
                return __('Add Field', 'registrationmagic-gold');

            case 'LABEL_FORM':
                return __('Form', 'registrationmagic-gold');

            case 'LABEL_REMOVE':
                return __('Remove', 'registrationmagic-gold');

            case 'LABEL_COMMON_FIELDS':
                return __('Common Fields', 'registrationmagic-gold');

            case 'LABEL_SPECIAL_FIELDS':
                return __('Special Fields', 'registrationmagic-gold');

            case 'LABEL_PROFILE_FIELDS':
                return __('Profile Fields', 'registrationmagic-gold');

            case 'PH_SELECT_A_FIELD':
                return __('Select A Field', 'registrationmagic-gold');

            case 'FIELD_TYPE_TEXT':
                return __('Single Line', 'registrationmagic-gold');

            case 'WIDGET_TYPE_PARAGRAPH':
                return __('Paragraph', 'registrationmagic-gold');

            case 'WIDGET_TYPE_HEADING':
                return __('Heading', 'registrationmagic-gold');

            case 'FIELD_TYPE_DROPDOWN':
                return __('Drop Down', 'registrationmagic-gold');

            case 'FIELD_TYPE_RADIO':
                return __('Radio Button', 'registrationmagic-gold');

            case 'FIELD_TYPE_TEXTAREA':
                return __('Multiple Line', 'registrationmagic-gold');

            case 'FIELD_TYPE_CHECKBOX':
                return __('Checkbox', 'registrationmagic-gold');

            case 'FIELD_TYPE_DATE':
                return __('Date', 'registrationmagic-gold');

            case 'LABEL_DATE' :
                return __('Date', 'registrationmagic-gold');

            case 'FIELD_TYPE_EMAIL':
                return __('Email', 'registrationmagic-gold');

            case 'FIELD_TYPE_NUMBER':
                return __('Number', 'registrationmagic-gold');

            case 'FIELD_TYPE_COUNTRY':
                return __('Country', 'registrationmagic-gold');

            case 'FIELD_TYPE_TIMEZONE':
                return __('Timezone', 'registrationmagic-gold');

            case 'FIELD_TYPE_T_AND_C':
                return __('T&C Checkbox', 'registrationmagic-gold');

            case 'FIELD_TYPE_FILE':
                return __('File Upload', 'registrationmagic-gold');

            case 'FIELD_TYPE_PRICE':
                return __('Add Product', 'registrationmagic-gold');

            case 'FIELD_TYPE_REPEAT':
                return __('Repeatable Single Line', 'registrationmagic-gold');

            case 'FIELD_TYPE_FNAME':
                return __('First Name', 'registrationmagic-gold');

            case 'FIELD_TYPE_LNAME':
                return __('Last Name', 'registrationmagic-gold');

            case 'FIELD_TYPE_BINFO':
                return __('Biographical Info', 'registrationmagic-gold');

            case 'LABEL_DELETE':
                return __('Delete', 'registrationmagic-gold');


            case 'LABEL_BIO':
                return __('Bio', 'registrationmagic-gold');

            case 'NO_FIELDS_MSG':
                return __('No fields for this form yet.', 'registrationmagic-gold');

            case 'NO_PRICE_FIELDS_MSG':
                return __('You do not have any product yet. Select a Pricing Type above to start creating products.<br>These products can be later inserted into any form for accepting payment.', 'registrationmagic-gold');

            case 'MSG_NO_FORM_SELECTED':
                return __('No form selected', 'registrationmagic-gold');

            case 'TITLE_EDIT_FIELD_PAGE':
                return __('Edit Field', 'registrationmagic-gold');

            case 'LABEL_ADD':
                return __('Add', 'registrationmagic-gold');

            case 'LABEL_EMAIL':
                return __('Email', 'registrationmagic-gold');

            case 'LABEL_STATUS':
                return __('Status', 'registrationmagic-gold');

            case 'LABEL_NAME':
                return __('Name', 'registrationmagic-gold');

            case 'LABEL_DEACTIVATED':
                return __('Deactivated', 'registrationmagic-gold');

            case 'LABEL_ACTIVATED':
                return __('Activated', 'registrationmagic-gold');

            case 'LABEL_MATCH_FIELD':
                return __('Match Field', 'registrationmagic-gold');

            case 'MSG_CLICK_TO_ADD':
                return __('Click to add options', 'registrationmagic-gold');

            case 'LABEL_HEADING_TEXT':
                return __('Heading Text', 'registrationmagic-gold');

            case 'MSG_NO_FIELD_SELECTED':
                return __('No Field Selected', 'registrationmagic-gold');

            case 'ALERT_DELETE_FORM':
                return __('You are going to delete this form(s). This will also delete all data assosiated with the form(s) including submissions and payment records. Users will not be deleted. Do you want to proceed?', 'registrationmagic-gold');

            /* 9th March */
            case 'USER_MANAGER':
                return __('User Manager', 'registrationmagic-gold');

            case 'NEW_USER':
                return __('New User', 'registrationmagic-gold');

            case 'ACTIVATE':
                return __('Activate', 'registrationmagic-gold');

            case 'DEACTIVATE':
                return __('Deactivate', 'registrationmagic-gold');

            case 'IMAGE':
                return __('Image', 'registrationmagic-gold');

            case 'FIRST_NAME':
                return __('First Name', 'registrationmagic-gold');

            case 'LAST_NAME':
                return __('Last Name', 'registrationmagic-gold');

            case 'DOB':
                return __('DOB', 'registrationmagic-gold');

            case 'ACTION':
                return __('Action', 'registrationmagic-gold');

            case 'VIEW':
                return __('View', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS':
                return __('Global Settings', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_GENERAL':
                return __('General Settings', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_GENERAL_EXCERPT':
                return __('Form look, Default pages, Attachment settings etc.', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_SECURITY':
                return __('Security', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_SECURITY_EXCERPT':
                return __('reCAPTCHA placement, Google reCAPTCHA keys', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_USER':
                return __('User Accounts', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_USER_EXCERPT':
                return __('Password behavior, Manual approvals etc.', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_EMAIL_NOTIFICATIONS':
                return __('Email Notifications', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_EMAIL_NOTIFICATIONS_EXCERPT':
                return __('Admin notifications, multiple email notifications, From email', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_EXTERNAL_INTEGRATIONS':
                return __('EXTERNAL INTEGRATION', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_EXTERNAL_INTEGRATIONS_EXCERPT':
                return __('Facebook, MailChimp (more coming soon!)', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_PAYMENT':
                return __('Payments', 'registrationmagic-gold');

            case 'LABEL_PAYMENTS':
                return __('Payments', 'registrationmagic-gold');

            case 'LABEL_PAYMENT':
                return __('Payment', 'registrationmagic-gold');

            case 'LABEL_TITLE':
                return __('Title', 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_PAYMENT_EXCERPT':
                return __('Currency, Symbol Position, Checkout Page etc.', 'registrationmagic-gold');

            case 'SETTINGS':
                return __('Settings', 'registrationmagic-gold');

            case 'SELECT_PAGE':
                return __('Select Page', 'registrationmagic-gold');

            case 'LABEL_NOT_APPLICABLE_ABB':
                return __('N/A', 'registrationmagic-gold');

            case 'LABEL_FORM_STYLE':
                return __('Form Style:', 'registrationmagic-gold');

            case 'LABEL_CAPTURE_INFO':
                return __('Capture IP and Browser Info:', 'registrationmagic-gold');

            case 'ALLOWED_FILE_TYPES_HELP':
                return __('(file extensions) (For example PDF|JPEG|XLS)', 'registrationmagic-gold');

            case 'LABEL_ALLOWED_FILE_TYPES':
                return __('Allowed File Types', 'registrationmagic-gold');

            case 'LABEL_ALLOWED_MULTI_FILES':
                return __('Allow Uploading Multiple Files:', 'registrationmagic-gold');

            case 'LABEL_DEFAULT_REGISTER_URL':
                return __('Default WP Registration Page:', 'registrationmagic-gold');

            case 'LABEL_AFTER_LOGIN_URL':
                return __('After Login Redirect User to:', 'registrationmagic-gold');

            case 'LABEL_ANTI_SPAM':
                return __('Anti Spam', 'registrationmagic-gold');

            case 'LABEL_ENABLE_CAPTCHA':
                return __('Enable reCaptcha:', 'registrationmagic-gold');

            case 'LABEL_CAPTCHA_LANG':
                return __('reCAPTCHA Language:', 'registrationmagic-gold');

            case 'LABEL_CAPTCHA_AT_LOGIN':
                return __('reCAPTCHA under User Login:', 'registrationmagic-gold');

            case 'LABEL_SITE_KEY':
                return __('Site Key:', 'registrationmagic-gold');

            case 'LABEL_CAPTCHA_KEY':
                return __('Secret Key:', 'registrationmagic-gold');

            case 'LABEL_CAPTCHA_METHOD':
                return __('Request Method:', 'registrationmagic-gold');

            case 'LABEL_CAPTCHA_METHOD_HELP':
                return __('(Change this setting if your ReCaptcha is not working as expected.)', 'registrationmagic-gold');

            case 'LABEL_AUTO_PASSWORD':
                return __('Auto Generated Password:', 'registrationmagic-gold');

            case 'LABEL_SEND_PASS_EMAIL':
                return __('Send Username and Password To User Through Email:', 'registrationmagic-gold');

            case 'LABEL_REGISTER_APPROVAL':
                return __('WP Registration Auto Approval', 'registrationmagic-gold');

            case 'LABEL_USER_NOTIFICATION_FRONT_END':
                return __('Send Notification to the User for Front-End Notes:', 'registrationmagic-gold');

            case 'LABEL_NOTIFICATIONS_TO_ADMIN':
                return __('Send Notification To Site Admin:', 'registrationmagic-gold');

            case 'LABEL_ENABLE_SMTP':
                return __('Enable SMTP:', 'registrationmagic-gold');

            case 'LABEL_SMTP_HOST':
                return __('SMTP Host:', 'registrationmagic-gold');

            case 'LABEL_SMTP_PORT':
                return __('SMTP Port:', 'registrationmagic-gold');

            case 'LABEL_SMTP_ENCTYPE':
                return __('Encryption type:', 'registrationmagic-gold');

            case 'LABEL_SMTP_AUTH':
                return __('Authentication:', 'registrationmagic-gold');

            case 'LABEL_SMTP_TESTMAIL':
                return __('Email address for testing:', 'registrationmagic-gold');

            case 'LABEL_TEST':
                return __('Test', 'registrationmagic-gold');

            case 'LABEL_ADD_EMAIL':
                return __('Add Fields', 'registrationmagic-gold');

            case 'LABEL_FROM_EMAIL':
                return __('From Email', 'registrationmagic-gold');

            case 'LABEL_FROM_EMAIL_DISP_NAME':
                return __('Display name for sender', 'registrationmagic-gold');

            case 'LABEL_ADD_FORM':
                return __('Add Form', 'registrationmagic-gold');

            case 'LABEL_FILTER_BY':
                return __('Filter by', 'registrationmagic-gold');

            case 'LABEL_DISPLAYING_FOR':
                return __('Displaying for', 'registrationmagic-gold');

            case 'LABEL_SELECT_RESIPIENTS':
                return __('Select recipients from', 'registrationmagic-gold');

            case 'LABEL_LOGIN_FACEBOOK_OPTION':
                return __('Allow User to Login using Facebook:', 'registrationmagic-gold');

            case 'LABEL_FACEBOOK_APP_ID':
                return __('Facebook App ID:', 'registrationmagic-gold');

            case 'LABEL_FACEBOOK_SECRET':
                return __('Facebook App Secret', 'registrationmagic-gold');

            case 'LABEL_MAILCHIMP_INTEGRATION':
                return __('MailChimp Integration:', 'registrationmagic-gold');

            case 'LABEL_MAILCHIMP_API':
                return __('MailChimp API:', 'registrationmagic-gold');

            case 'LABEL_PAYMENT_PROCESSOR':
                return __('Payment Processor:', 'registrationmagic-gold');

            case 'LABEL_TEST_MODE':
                return __('Test Mode:', 'registrationmagic-gold');

            case 'LABEL_PAYPAL_EMAIL':
                return __('PayPal Email:', 'registrationmagic-gold');

            case 'LABEL_CURRENCY':
                return __('Currency:', 'registrationmagic-gold');

            case 'LABEL_PAYPAL_STYLE':
                return __('PayPal Page Style:', 'registrationmagic-gold');

            case 'LABEL_CURRENCY_SYMBOL':
                return __('Currency Symbol Position', 'registrationmagic-gold');

            case 'LABEL_CURRENCY_SYMBOL_HELP':
                return __('Choose the location of the currency sign.', 'registrationmagic-gold');

            case 'LABEL_RECIPIENTS_OPTION':
                return __('Define Recipients Manually', 'registrationmagic-gold');

            case 'ERROR_FILE_FORMAT':
                return __('Uploaded files must be in allowed format.', 'registrationmagic-gold');

            case 'ERROR_FILE_SIZE':
                return __('File is too large to upload.', 'registrationmagic-gold');

            case 'ERROR_FILE_UPLOAD':
                return __('File upload was not successfull', 'registrationmagic-gold');

            case 'ERROR_INVALID_RECAPTCHA':
                return __('The reCAPTCHA response provided was incorrect.  Please re-try.', 'registrationmagic-gold');

            case 'OPTION_SELECT_LIST':
                return __('Select a List', 'registrationmagic-gold');

            case 'LABEL_MAILCHIMP_LIST':
                return __('Send To MailChimp List', 'registrationmagic-gold');

            case 'LABEL_USERNAME':
                return __('Username', 'registrationmagic-gold');

            case 'LABEL_PASSWORD':
                return __('Password', 'registrationmagic-gold');

            case 'LABEL_PASSWORD_AGAIN':
                return __('Enter password again', 'registrationmagic-gold');

            case 'ERR_PW_MISMATCH':
                return __('Passwords do not match', 'registrationmagic-gold');

            case 'LABEL_NONE':
                return __('None', 'registrationmagic-gold');

            case 'LABEL_CONFIRM_PASSWORD':
                return __('Confirm Password', 'registrationmagic-gold');

            case 'LABEL_LOGIN':
                return __('Login', 'registrationmagic-gold');

            case 'ERROR_REQUIRED':
                return __('is a required field.', 'registrationmagic-gold');

            case 'LOGGED_STATUS':
                return __('You are already logged in.', 'registrationmagic-gold');

            case 'RM_LOGIN_HELP':
                return __('To show login box on a page, you can use Shortcode [RM_Login], or you can select it from the dropdown just like any other form.', 'registrationmagic-gold');

            case 'LABEL_TODAY':
                return __('Today', 'registrationmagic-gold');

            case 'LABEL_YESTERDAY':
                return __('Yesterday', 'registrationmagic-gold');

            case 'LABEL_THIS_WEEK':
                return __('This Week', 'registrationmagic-gold');

            case 'LABEL_LAST_WEEK':
                return __('Last Week', 'registrationmagic-gold');

            case 'LABEL_THIS_MONTH':
                return __('This Month', 'registrationmagic-gold');

            case 'LABEL_THIS_YEAR':
                return __('This Year', 'registrationmagic-gold');

            case 'LABEL_PERIOD':
                return __('Specific Period', 'registrationmagic-gold');

            case 'LABEL_ACTIVE':
                return __('Active', 'registrationmagic-gold');

            case 'LABEL_PENDING':
                return __('Pending', 'registrationmagic-gold');

            case 'LABEL_ROLE_AS':
                return __('Register As', 'registrationmagic-gold');

            case 'MSG_REDIRECT_URL_INVALID':
                return __('After Submission redirect URL not given.', 'registrationmagic-gold');

            case 'MSG_REDIRECT_PAGE_INVALID':
                return __('After submission redirect Page not given.', 'registrationmagic-gold');

            case 'MSG_EXPIRY_LIMIT_INVALID':
                return __('Form expiry limit is invalid.', 'registrationmagic-gold');

            case 'MSG_EXPIRY_DATE_INVALID':
                return __('Form expiry date is invalid.', 'registrationmagic-gold');

            case 'MSG_FORM_EXPIRED':
                return __('<div class="form_expired">Form Expired</div>', 'registrationmagic-gold');

            case 'MSG_EXPIRY_INVALID':
                return __('Please select a form expiration criterion (By Date, By Submissions etc.)', 'registrationmagic-gold');

            case 'MSG_EXPIRY_BOTH_INVALID':
                return __('Please select both expiry criterion (By Date, By Submissions). ', 'registrationmagic-gold');

            case 'MSG_NO_SUBMISSION':
                return __('Latest Submissions not available for this form.', 'registrationmagic-gold');

            case 'MSG_NO_SUBMISSION_FRONT':
                return __('There are no submissions for this email right now.', 'registrationmagic-gold');

            case 'USERNAME_EXISTS':
                return __("This user is already registered. Please try with different username or login.", 'registrationmagic-gold');

            case 'P_FIELD_TYPE_FIXED':
                return __("Fixed", 'registrationmagic-gold');

            case 'P_FIELD_TYPE_MULTISEL':
                return __("Multi Select", 'registrationmagic-gold');

            case 'P_FIELD_TYPE_DROPDOWN':
                return __("DropDown", 'registrationmagic-gold');

            case 'P_FIELD_TYPE_USERDEF':
                return __("User Defined", 'registrationmagic-gold');

            case 'USEREMAIL_EXISTS':
                return __("This email is already associated with a user account. Please login to fill this form..", 'registrationmagic-gold');

            case 'USER_EXISTS':
                return __("This user already registered. Please try with different username or email.", 'registrationmagic-gold');

            case 'LABEL_CREATE_FORM':
                return __("Create New Form", 'registrationmagic-gold');

            case 'LABEL_NEWFORM_NOTIFICATION':
                return __("New Form Notification", 'registrationmagic-gold');

            case 'TITLE_SUPPORT_PAGE':
                return __("Support, Feature Requests and Feedback", 'registrationmagic-gold');

            case 'MAIL_BODY_NEW_USER_NOTIF':
                return __("Your account has been successfully created on {{SITE_NAME}}. You can now login using following credentials:<br>Username : {{USER_NAME}}<br>Password : {{USER_PASS}}", 'registrationmagic-gold');

            case 'SUBTITLE_SUPPORT_PAGE':
                return __("For support, please fill in the support form with relevant details.", 'registrationmagic-gold');

            case 'LABEL_FORM_DELETED':
                return __("Form deleted", 'registrationmagic-gold');

            case 'LABEL_SUPPORT_FORM':
                return __("SUPPORT FORM", 'registrationmagic-gold');

            case 'LABEL_ROLE_NAME':
                return __("Role Name", 'registrationmagic-gold');

            case 'LABEL_USER_ROLES':
                return __("User Roles", 'registrationmagic-gold');

            case 'LABEL_ADD_ROLE':
                return __("Add Role", 'registrationmagic-gold');

            case 'LABEL_EXPORT_ALL':
                return __("Export All", 'registrationmagic-gold');

            case 'LABEL_USEREMAIL':
                return __("User Email", 'registrationmagic-gold');

            case 'LABEL_PERMISSION_LEVEL':
                return __("Permission Level", 'registrationmagic-gold');

            case 'MSG_INVALID_CHAR':
                return __("Error: invalid chartacter!", 'registrationmagic-gold');

            case 'LABEL_MAILCHIMP_MAP_EMAIL':
                return __("Map With MailChimp Email Field", 'registrationmagic-gold');

            case 'LABEL_MAILCHIMP_MAP_FIRST_NAME':
                return __("Map With MailChimp First Name Field", 'registrationmagic-gold');

            case 'LABEL_MAILCHIMP_MAP_LAST_NAME':
                return __("Map With MailChimp Last Name Field", 'registrationmagic-gold');

            case 'SELECT_DEFAULT_OPTION':
                return __("Please select a value", 'registrationmagic-gold');

            case 'MAILCHIMP_FIRST_NAME_ERROR':
                return __("Please select First Name field for mailchimp integration.", 'registrationmagic-gold');

            case 'MAILCHIMP_LIST_ERROR':
                return __("Please select a mailchimp list.", 'registrationmagic-gold');

            case 'TITLE_PAYPAL_FIELD_PAGE':
                return __("Products", 'registrationmagic-gold');

            case 'TITLE_USER_MANAGER':
                return __("Users Manager", 'registrationmagic-gold');

            case 'ERROR_STAT_INSUFF_DATA':
                return __('Sorry, insufficient data captured for this form. Check back after few more submissions have been recorded or select another form from above dropdown.', 'registrationmagic-gold');

            case 'LABEL_IP':
                return __("Visitor IP", 'registrationmagic-gold');

            case 'LABEL_SUBMISSION_STATE':
                return __("Submission", 'registrationmagic-gold');

            case 'LABEL_SUBMITTED_ON':
                return __("Submitted on", 'registrationmagic-gold');

            case 'LABEL_VISITED_ON':
                return __("Time (UTC)", 'registrationmagic-gold');

            case 'LABEL_SUCCESS':
                return __("Successful", 'registrationmagic-gold');

            case 'LABEL_TIME_TAKEN':
                return __("Filling Time", 'registrationmagic-gold');

            case 'LABEL_TIME_TAKEN_AVG':
                return __("Average Filling Time", 'registrationmagic-gold');

            case 'LABEL_FAILURE_RATE':
                return __("Failure Rate", 'registrationmagic-gold');

            case 'LABEL_SUBMISSION_RATE':
                return __("Submission Rate", 'registrationmagic-gold');

            case 'LABEL_SUCCESS_RATE':
                return __("Success Rate", 'registrationmagic-gold');

            case 'LABEL_TOTAL_VISITS':
                return __("Total Visits", 'registrationmagic-gold');

            case 'LABEL_VISITS':
                return __("Visits", 'registrationmagic-gold');

            case 'LABEL_CONVERSION':
                return __("Conversion", 'registrationmagic-gold');

            case 'LABEL_CONV_BY_BROWSER':
                return __("Browser wise Conversion", 'registrationmagic-gold');

            case 'LABEL_HITS':
                return __("Hits", 'registrationmagic-gold');

            case 'LABEL_BROWSERS_USED':
                return __("Browsers Used", 'registrationmagic-gold');

            case 'LABEL_BROWSER':
                return __("Browser", 'registrationmagic-gold');

            case 'LABEL_BROWSER_OTHER':
                return __("Other", 'registrationmagic-gold');

            case 'LABEL_BROWSER_CHROME':
                return __("Chrome", 'registrationmagic-gold');

            case 'LABEL_BROWSER_IE':
            case 'LABEL_BROWSER_INTERNET EXPLORER':
                return __("Internet Explorer", 'registrationmagic-gold');

            case 'LABEL_BROWSER_FIREFOX':
                return __("Firefox", 'registrationmagic-gold');

            case 'LABEL_BROWSER_EDGE':
                return __("Edge", 'registrationmagic-gold');

            case 'LABEL_BROWSER_ANDROID':
                return __("Android", 'registrationmagic-gold');

            case 'LABEL_BROWSER_IPHONE':
                return __("iPhone", 'registrationmagic-gold');

            case 'LABEL_BROWSER_SAFARI':
                return __("Safari", 'registrationmagic-gold');

            case 'LABEL_BROWSER_OPERA':
                return __("Opera", 'registrationmagic-gold');

            case 'LABEL_BROWSER_BLACKBERRY':
                return __("BlackBerry", 'registrationmagic-gold');

            case 'LABEL_RESET_STATS':
                return __("Reset All Stats", 'registrationmagic-gold');

            case 'ALERT_STAT_RESET':
                return __("You are going to delete all stats for selected form. Do you want to proceed?", 'registrationmagic-gold');

            case 'TITLE_FORM_STAT_PAGE':
                return __("Form Analytics", 'registrationmagic-gold');

            case 'TITLE_FIELD_STAT_PAGE':
                return __("Field Analytics", 'registrationmagic-gold');

            case 'ALERT_SUBMISSIOM_LIMIT':
                return __("Submission limit reached for this form, please try back after 24 hours.", 'registrationmagic-gold');

            case 'LABEL_SUB_LIMIT_ANTISPAM':
                return __("Form submission limit for a device", 'registrationmagic-gold');

            case 'LABEL_SUB_LIMIT_ANTISPAM_HELP':
                return __("Limits how many times a form can be submitted from a device within a day. Helpful to prevent spams. Set it to zero(0) to disable this feature.", 'registrationmagic-gold');

            case 'LABEL_FAILED_SUBMISSIONS':
                return __("Not submitted", 'registrationmagic-gold');

            case 'LABEL_BANNED_SUBMISSIONS':
                return __("Banned", 'registrationmagic-gold');

            case 'MSG_AUTO_USER_ROLE_INVALID':
                return __("Please select either Automatically Assigned WP User Role or Pick user role manually.", 'registrationmagic-gold');

            case 'LABEL_ALL':
                return __("All", 'registrationmagic-gold');

            case 'MSG_WP_ROLE_LABEL_INVALID':
                return __("WP User Role Field Label is required.", 'registrationmagic-gold');

            case 'MSG_ALLOWED_ROLES_INVALID':
                return __("Please select Allowed WP Roles for Users.", 'registrationmagic-gold');

            case 'LABEL_ENTRY_ID':
                return __("Submission ID", 'registrationmagic-gold');

            case 'LABEL_ENTRY_TYPE':
                return __("Submission Type", 'registrationmagic-gold');

            case 'LABEL_USER_NAME':
                return __("User Name", 'registrationmagic-gold');

            case 'LABEL_SEND':
                return __("Send", 'registrationmagic-gold');

            case 'MSG_AUTO_REPLY_CONTENT_INVALID':
                return __("Auto reply email body is invalid.", 'registrationmagic-gold');

            case 'MSG_AUTO_REPLY_SUBJECT_INVALID':
                return __("Auto reply email subject is invalid", 'registrationmagic-gold');

            case 'TITLE_INVITES':
                return __("Bulk Email", 'registrationmagic-gold');

            case 'LABEL_QUEUE_IN_PROGRESS':
                return __("Queue in progress", 'registrationmagic-gold');

            case 'LABEL_SENT':
                return __("Sent", 'registrationmagic-gold');

            case 'LABEL_STARTED_ON':
                return __("Started on", 'registrationmagic-gold');

            case 'MSG_QUEUE_RUNNING':
                return __("This form is already processing an email queue. You cannot add another queue, until this task is finished", 'registrationmagic-gold');

            case 'ERROR_INVITE_NO_MAIL':
                return __("No email submissions found for this form.", 'registrationmagic-gold');

            case 'ERROR_INVITE_NO_QUEUE':
                return __("No active queue. Select a form from dropdown to send emails.", 'registrationmagic-gold');

            case 'LABEL_RESET':
                return __("Reset", 'registrationmagic-gold');

            case 'LABEL_SHOW_ON_FORM':
                return __("Show on form", 'registrationmagic-gold');

            case 'MSG_REDIRECTING_TO':
                return __("Redirecting you to", 'registrationmagic-gold');

            case 'MSG_PAYMENT_SUCCESS':
                return __("Payment Successfull", 'registrationmagic-gold');

            case 'MSG_PAYMENT_FAILED':
                return __("Payment Failed!", 'registrationmagic-gold');

            case 'MSG_PAYMENT_PENDING':
                return __("Payment Pending.", 'registrationmagic-gold');

            case 'MSG_PAYMENT_CANCEL':
                return __("Transaction Cancelled", 'registrationmagic-gold');

            case 'LABEL_UNIQUE_TOKEN_EMAIL':
                return __("Unique Token", 'registrationmagic-gold');

            case 'LABEL_DEFAULT_SELECT_OPTION':
                return __("Please select a value", 'registrationmagic-gold');

            case 'LABEL_REMEMBER':
                return __("Remember me", 'registrationmagic-gold');

            case 'TITLE_DASHBOARD_WIDGET':
                return __('Registration Activity', 'registrationmagic-gold');

            case 'MSG_OTP_SUCCESS':
                return __("Success! an email with one time password (OTP) was sent to your email address.", 'registrationmagic-gold');

            case 'LABEL_OTP':
                return __("One Time Password", 'registrationmagic-gold');

            case 'OTP_MAIL':
                return __("Your One Time Password is ", 'registrationmagic-gold');

            case 'MSG_EMAIL_NOT_EXIST':
                return __("Oops! We could not find this email address in our submissions database.", 'registrationmagic-gold');

            case 'INVALID_EMAIL':
                return __("Invalid username or email.Please try again.", 'registrationmagic-gold');

            case 'MSG_AFTER_OTP_LOGIN':
                return __("You have successfully logged in using OTP.", 'registrationmagic-gold');

            case 'MSG_INVALID_OTP':
                return __("The OTP you entered is invalid. Please enter correct OTP code from the email we sent you, or you can generate a new OTP.", 'registrationmagic-gold');

            case 'MSG_NOTE_FROM_ADMIN':
                return __(" Admin added a note for you: <br><br>", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_TITLE':
                return __("Name of your form.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_DESC':
                return __("For your reference only. Not visible on front end.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_CREATE_WP_USER':
                return __("Selecting this will register the user in WP Users area.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_WP_USER_ROLE_AUTO':
                return __("Which user role will be assigned to the user.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_WP_USER_ROLE_PICK':
                return __("This will allow users to select a role themselves. A new field will appear on the form.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_ROLE_SELECTION_LABEL':
                return __("Label of the role selection field which will appear on the form.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_ALLOWED_USER_ROLE':
                return __("Only the checked roles will appear for selection on the form.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_CONTENT_ABOVE_FORM':
                return __("This content will be displayed above the fields in the form.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_SUCCESS_MSG':
                return __("Message to show to the user after the form is submitted successfully.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_UNIQUE_TOKEN':
                return __("User will receive a unique random number in email.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_REDIRECT_AFTER_SUB':
                return __("Redirect the user to a new page after submission (and success message).", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_REDIRECT_PAGE':
                return __("Select the page to which user is redirected after form submission.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_REDIRECT_URL':
                return __("Enter the URL where the user is redirected after form submission.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_AUTO_RESPONDER':
                return __("Turns on auto responder email for the form. After successful submission an email is sent to the user.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_AUTO_RESP_SUB':
                return __("Subject of the mail sent to the user.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_AUTO_RESP_MSG':
                return __("Content of the email to be sent to the user. You can use rich text and values the user submitted in the form for a more personalized message. If you are creating a new form, Add Fields drop down will be empty. You can come back after adding fields to the form.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_SUB_BTN_LABEL':
                return __("Label for the button that will submit the form. Leave blank for default label.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_SUB_BTN_FG_COLOR':
                return __("Color of the text inside the submit button. Leave blank for default theme colors.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_SUB_BTN_BG_COLOR':
                return __("Color of the submit button. Leave blank for default theme colors.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_MC_LIST':
                return __("Required for connecting the form with a MailChimp List. To make it work, please set MailChimp in Global Settings &#8594; <a target='blank' class='rm_help_link' href='admin.php?page=rm_options_thirdparty'>External Integration</a>.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_MC_EMAIL':
                return __("Choose the form field which will be connected to MailChimp&#39;s email field.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_MC_FNAME':
                return __("Choose the form field which will be connected to MailChimp&#39;s First Name field.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_MC_LNAME':
                return __("Choose the form field which will be connected to MailChimp&#39;s Last Name field.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_AUTO_EXPIRE':
                return __("Select this if you want to auto unpublished the form after required number of submissions or reaching a specific date.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_EXPIRE_BY':
                return __("Select the condition for auto unpublishing the form", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_AUTO_EXP_SUB_LIMIT':
                return __("The form will not be visible to the user after this number is reached. It can be reset later.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_AUTO_EXP_TIME_LIMIT':
                return __("The form will not be visible to the user after this date. It can be reset later.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_AUTO_EXP_MSG':
                return __("User will see this message when accessing the form if the form is in unpublished state after reaching submission limit or expiry date.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_SELECT_TYPE':
                return __("Select  or change type of the field if not already selected.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_LABEL':
                return __("Label of the field as it appears on forms and inside user accounts. This does not apply to fields without labels like Shortcode field.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_PLACEHOLDER':
                return __("Value or message that will appear inside the field before user fill it.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_CSS_CLASS':
                return __("Apply a CSS Class defined in the theme CSS file or in Appearance &#8594; Editor", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_MAX_LEN':
                return __("Maximum Allowed length (characters) of the user submitted value. Leave blank for no limit. ", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_IS_REQUIRED':
                return __("Make this field mandatory to be filled. Form will show user an error if he/ she tries to submit the form without filling this field", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_SHOW_ON_USERPAGE':
                return __("Display's this field's value inside RegistrationMagic's User Manager area. It also displays the value on frontend User Account area created by RegistrationMagic's shortcode. Please note, RegistrationMagic's account area is different from WordPress' user page.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_PARA_TEXT':
                return __("The text you want the user to see.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_HEADING_TEXT':
                return __("The text you want the user to see as heading.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_OPTIONS_SORTABLE':
                return __("Options for user to choose from. Drag and drop to arrange their order inside the list.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_DEF_VALUE':
                return __("This option will appear selected by default when form loads.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_COLS':
                return __("Width of the text area defined in terms of columns where each column is equivalent to one character.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_ROWS':
                return __("Height of the text area defined in terms of number of text lines.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_TnC_VAL':
                return __("Paste or insert your terms and conditions here.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_FILETYPE':
                return __("Limits the type of file allowed to be attached. If you will leave it blank then extensions defined in global settings will be used.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_PRICE_FIELD':
                return __("Select the product created in &quot;Products&quot; section of RegistrationMagic.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_OPTIONS_COMMASEP':
                return __("Options for drop down list. Separate multiple values with a comma(,).", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_BDATE_RANGE':
                return __("Enable this to force selection of date of birth from a certain range.", 'registrationmagic-gold');

            case 'HELP_ADD_PRIMARY_FIELD_EMAIL':
                return __("This is primary email field. Type of this field can not be changed.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_GEN_THEME':
                return __("Select visual style of your forms. Classic applies a set neutral tone which looks pleasing with all kinds of WordPress themes. Match My Theme will let forms pick visual elements automatically from your active WordPress theme. When this is selected, you can also override the design of individual forms in Form Settings.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_GEN_LAYOUT':
                return __("Select the position of field labels and columns for your forms. Two column layout will look best with themes that offer wide content area.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_GEN_FILETYPES':
                return __("Limit the type of file allowed to be attached. You will need to define extension of the file types here.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_GEN_FILE_MULTIPLE':
                return __("Allows users to attach multiple files to your single file field.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_GEN_REG_URL':
                return __("Choose which page you want to show to the user when he or she clicks on &quot;Register&quot; link on your site. Do make sure you have a registration form inserted inside the page you select.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_POST_SUB_REDIR':
                return __("Choose the page you want to redirect the user to after successful login.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ASPM_ENABLE_CAPTCHA':
                return __("Shows recaptcha above the submit button. It verifies if the user is human before accepting submission.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ASPM_SITE_KEY':
                return __("Required to make reCAPTCHA  work. You can generate site key from <a target='blank' class='rm_help_link' href='https://www.google.com/recaptcha/'>here</a>.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ASPM_SECRET_KEY':
                return __("Required to make reCAPTCHA  work. It will be provided when you generate site key.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_USER_AUTOGEN':
                return __("Creates and sends the users random password instead of allowing them to set one on the form. After selecting this, password field will not appear on the forms. ", 'registrationmagic-gold');

            case 'HELP_OPTIONS_USER_AUTOAPPROVAL':
                return __("Automatically activates user accounts after submission. Uncheck it if you want to manually activate each user. It can be done through user manager or by clicking activation link in admin email notification.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_NOTE_NOTIFS':
                return __("An email notification will be send to the user if you add a note to his/her submission and make it visible to him/her.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_ADMIN_NOTIFS':
                return __("An email notification will be sent to Admin of this site for every form submission.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_RESPS':
                return __("Add people who you want to receive notifications for form submissions.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_ENABLE_SMTP':
                return __("Whether to use an external SMTP (Google, Yahoo! etc) instead of local mail server", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_SMTP_HOST':
                return __("Specify host address for SMTP.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_SMTP_PORT':
                return __("Specify port number for SMTP.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_SMTP_ENCTYPE':
                return __("Specify the type of encryption used by your SMTP service provider", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_SMTP_AUTH':
                return __("Please check this if authentication is required at SMTP server. Also, provide credential in the following fields.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_FROM_DISP_NAME':
                return __("A name to identify the sender. It will be shown as &quot;From: MY Blog &lt;me@myblog.com&gt;&quot;", 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_FROM_EMAIL':
                return __("The reply-to email in the header of messages that user or admin receives.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_FB_ENABLE':
                return __("A login using Facebook button will appear alongside the login form.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_FB_SECRET':
                return __("To make Facebook login work, you&#39;ll need an App Secret. It will be provided when you generate and App ID.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_FB_APPID':
                return __("To make Facebook login work, you7ll need an App ID. More information <a target='blank' class='rm_help_link' href='https://developers.facebook.com/docs/apps/register'>here</a>.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_MC_ENABLE':
                return __("This will allow you to fetch your MailChimp lists in individual form settings and map selective fields to your MailChimp fields.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_MC_API':
                return __("You will need a MailChimp API to make integration work. More information <a target='blank' class='rm_help_link' href='http://kb.mailchimp.com/accounts/management/about-api-keys'>here</a>.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_PYMNT_PROCESSOR':
                return __("Select the payment system(s) you want to use for accepting payments. Make sure you configure them right.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_PYMNT_TESTMODE':
                return __("This will put RegistrationMagic payments on test mode. Useful for testing payment system.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_PYMNT_PP_EMAIL':
                return __("Your PayPal account email, to which you will accept the payments.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_PYMNT_CURRENCY':
                return __("Default Currency for accepting payments. Usually, this will be default currency in your PayPal,Stripe or Authorize.Net account. Please visit this <a target='_blank' href='https://support.authorize.net/authkb/index?page=content&id=A414'>link</a> to check currencies supported by Authorize.net. Please make sure currency you select is supported by payment processor(s). Not all currencies work well with all payment processors. ", 'registrationmagic-gold');

            case 'HELP_OPTIONS_PYMNT_PP_PAGESTYLE':
                return __("If you have created checkout pages in your PayPal account and want to show a specific page, you can enter it&#39;s name here.", 'registrationmagic-gold');

            case 'HELP_ADD_PRICE_FIELD_LABEL':
                return __("For your reference only. This name will be visible when you will add product in a form. If you wish to show this name on the form, make sure while adding this product to a form you enter same field label as the product name.", 'registrationmagic-gold');

            case 'HELP_ADD_PRICE_FIELD_SELECT_TYPE':
                return __("Define how the product will be priced.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_INVITES_SUB':
                return __("Subject for the message you are sending to the users.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_INVITES_BODY':
                return __("Content of the message your are sending to the users of selected form. You can use values from form fields filled by the users from &quot;Add Fields&quot; dropdown for personalized message.", 'registrationmagic-gold');

            //Admin menus
            case 'ADMIN_MENU_REG':
                return __("RegistrationMagic", 'registrationmagic-gold');

            case 'ADMIN_MENU_NEWFORM':
                return __("New Form", 'registrationmagic-gold');

            case 'ADMIN_MENU_NEWFORM_PT':
                return __("New Form", 'registrationmagic-gold');

            case 'ADMIN_MENU_SETTINGS':
                return __("Global Settings", 'registrationmagic-gold');

            case 'ADMIN_MENU_SUBS':
                return __("Inbox", 'registrationmagic-gold');

            case 'ADMIN_MENU_FORM_STATS':
                return __("Form Analytics", 'registrationmagic-gold');

            case 'ADMIN_MENU_FIELD_STATS':
                return __("Field Analytics", 'registrationmagic-gold');

            case 'ADMIN_MENU_PRICE':
                return __("Products", 'registrationmagic-gold');

            case 'ADMIN_MENU_ATTS':
                return __("Attachments", 'registrationmagic-gold');

            case 'ADMIN_MENU_INV':
                return __("Bulk Email", 'registrationmagic-gold');

            case 'ADMIN_MENU_USERS':
                return __("User Manager", 'registrationmagic-gold');

            case 'ADMIN_MENU_ROLES':
                return __("User Roles", 'registrationmagic-gold');

            case 'ADMIN_MENU_SUPPORT':
                return __("Support", 'registrationmagic-gold');

            case 'ADMIN_MENU_SETTING_GEN_PT':
                return __("General Settings", 'registrationmagic-gold');

            case 'ADMIN_MENU_SETTING_AS_PT':
                return __("Anti Spam Settings", 'registrationmagic-gold');

            case 'ADMIN_MENU_SETTING_UA_PT':
                return __("User Account Settings", 'registrationmagic-gold');

            case 'ADMIN_MENU_SETTING_AR_PT':
                return __("Auto Responder Settings", 'registrationmagic-gold');

            case 'ADMIN_MENU_SETTING_TP_PT':
                return __("Third Party Integration Settings", 'registrationmagic-gold');

            case 'ADMIN_MENU_SETTING_PP_PT':
                return __("Payment Settings", 'registrationmagic-gold');

            case 'ADMIN_MENU_SETTING_SAVE_PT':
                return __("Save Settings", 'registrationmagic-gold');

            case 'ADMIN_MENU_ADD_NOTE_PT':
                return __("Add Note", 'registrationmagic-gold');

            case 'ADMIN_MENU_MNG_FIELDS_PT':
                return __("Manage Form Fields", 'registrationmagic-gold');

            case 'ADMIN_MENU_ADD_FIELD_PT':
                return __("Add Field", 'registrationmagic-gold');

            case 'ADMIN_MENU_ADD_PP_FIELD_PT':
                return __("Add PayPal Field", 'registrationmagic-gold');

            case 'ADMIN_MENU_PP_PROC_PT':
                return __("PayPal processing", 'registrationmagic-gold');

            case 'ADMIN_MENU_ATT_DL_PT':
                return __("Attachment Download", 'registrationmagic-gold');

            case 'ADMIN_MENU_VIEW_SUB_PT':
                return __("View Submission", 'registrationmagic-gold');

            case 'ADMIN_MENU_USER_ROLE_DEL_PT':
                return __("User Role Delete", 'registrationmagic-gold');

            case 'ADMIN_MENU_REG_PT':
                return __("Registrant", 'registrationmagic-gold');

            case 'MSG_LOST_PASS':
                return __("Lost your password?", 'registrationmagic-gold');

            case 'SUPPORT_PAGE_NOTICE':
                return __("Note: If you wish to roll back to earlier version of RegistrationMagic due to broken upgrade, please <a href='http://registrationmagic.com/free/'>go here</a>. You will need to deactivate or uninstall this version and reinstall version 2.5. No data will be lost. If you want to resolve any issue with version 3.0, please use one of the links below to contact support.", 'registrationmagic-gold');

            case 'LABEL_MY_DETAILS':
                return __("Personal Details", 'registrationmagic-gold');

            case 'LABEL_ADMIN_NOTES':
                return __("Admin Notes", 'registrationmagic-gold');

            case 'LABEL_SHOW_PROG_BAR':
                return __("Show expiry countdown above the form?", 'registrationmagic-gold');

            case 'HELP_OPTIONS_GEN_PROGRESS_BAR':
                return __("Shows form filling status above the form when Limits are turned on. For example, 2 out 50 registrations complete or 2 days to go before registration ends.", 'registrationmagic-gold');

            case 'MSG_REQUIRED_FIELD':
                return __("This is a required field", 'registrationmagic-gold');

            case 'HELP_OPTIONS_USER_SEND_PASS':
                return __("Sends user a mail about his/her user-name and password after registration.", 'registrationmagic-gold');

            case 'MSG_CREATE_PRICE_FIELD':
                return __("First Create a product from Products > Add New", 'registrationmagic-gold');

            case 'LABEL_EXPORT_TO_URL_CB':
                return __("Send Submitted Data to External URL", 'registrationmagic-gold');

            case 'LABEL_EXPORT_URL':
                return __("URL", 'registrationmagic-gold');

            case 'HELP_SEND_SUB_TO_URL':
                return __("URL to the script on external server which will handle the data", 'registrationmagic-gold');

            case 'HELP_SEND_SUB_TO_URL_CB':
                return __("Posts submitted data to external server. This could be useful for maintaining another database for submissions.", 'registrationmagic-gold');

            case 'ADMIN_SUBMENU_REG':
                return __("Registration Forms", 'registrationmagic-gold');

            case 'LABEL_STRIPE_API_KEY' :
                return __("Stripe API Key", 'registrationmagic-gold');

            case 'LABEL_STRIPE_PUBLISH_KEY' :
                return __("Stripe Publishable Key", 'registrationmagic-gold');

            case 'HELP_OPTIONS_PYMNT_STRP_API_KEY' :
                return __("Secret and publishable keys are used to identify your Stripe account. You can grab the test and live API keys for your account under <a href='https://dashboard.stripe.com/account/apikeys' target='blank'>Your Account > API Keys</a>", 'registrationmagic-gold');

            case 'HELP_OPTIONS_PYMNT_STRP_PUBLISH_KEY' :
                return __("&nbsp;", 'registrationmagic-gold');

            case 'SELECT_FIELD_FIRST_OPTION':
                return __("Select an option", 'registrationmagic-gold');

            case 'MSG_CLICK_TO_REVIEW' :
                return __("Click here to review", 'registrationmagic-gold');

            case 'MSG_LIKED_RM' :
                return __("Liked <span class='rm-brand'>RegistrationMagic </span>so far? Please rate it <span class='rm-bold'> 5 stars</span> on wordpress.org and help us keep it going!", 'registrationmagic-gold');

            case 'LABEL_SELECT_PAYMENT_METHOD':
                return __("Select a payment method", 'registrationmagic-gold');

            case 'LABEL_STRIPE_CARD_NUMBER':
                return __("Card Number", 'registrationmagic-gold');

            case 'LABEL_STRIPE_CARD_MONTH':
                return __("Month", 'registrationmagic-gold');

            case 'LABEL_STRIPE_CARD_YEAR':
                return __("Year", 'registrationmagic-gold');

            case 'LABEL_STRIPE_CARD_CVC':
                return __("CVC/CVV", 'registrationmagic-gold');

            case 'LABEL_CUSTOM_RANGE':
                return __("Specific Period", 'registrationmagic-gold');

            case 'LABEL_CUSTOM_RANGE_FROM_DATE':
                return __("From", 'registrationmagic-gold');

            case 'LABEL_CUSTOM_RANGE_UPTO_DATE':
                return __("Up to", 'registrationmagic-gold');

            case 'CRIT_ERROR_TITLE':
                return __("Uh, oh! Looks like we've hit a road block", 'registrationmagic-gold');

            case 'CRIT_ERROR_SUBTITLE':
                return __("Following requirement(s) are not met, I can not continue. :(", 'registrationmagic-gold');

            case 'CRIT_ERR_XML':
                return __("PHP extension SimpleXML is not enabled on server.", 'registrationmagic-gold');

            case 'CRIT_ERR_MCRYPT':
                return __("PHP extension mcrypt is not enabled on server.", 'registrationmagic-gold');

            case 'CRIT_ERR_PHP_VERSION':
                return __("This plugin requires atleast php version 5.3. Older version found.", 'registrationmagic-gold');

            case 'ERROR_NA_SEND_TO_URL_FEAT':
                return __("Feature not available. PHP extension CURL is not enabled on server.", 'registrationmagic-gold');

            case 'RM_ERROR_EXTENSION_CURL':
                return __("PHP extension CURL is not enabled on server. Following features will not be available:<ul style=\"padding-left:25px;list-style-type:disc;margin-top:0px;\"><li>Facebook Integration</li><li>Mailchimp Integration</li><li>Stripe Payment</li><li>Export submission to external URL</li></ul>", 'registrationmagic-gold');

            case 'RM_ERROR_EXTENSION_ZIP':
                return __("PHP extension ZIP is not enabled on server. Following features will not be available:<ul style=\"padding-left:25px;list-style-type:disc;margin-top:0px;\"><li>Downloading multiple attachments as zip</li></ul>", 'registrationmagic-gold');


            case 'NEWSLETTER_SUB_MSG':
                return __("<span class='rm-newsletter-button'><a href='javascript:void(0)' onclick='handle_newsletter_subscription_click(\"" . self::get('MSG_NEWSLETTER_SUBMITTED') . "\")'> Click here</a></span> to keep up with breakthroughs and innovations we are bringing to WordPress registration system.", 'registrationmagic-gold');

            case 'MAIL_ACTIVATE_USER_DEF_SUB':
                return __("Activate User", 'registrationmagic-gold');

            case 'MAIL_NEW_USER1' :
                return __("A new user has been registered on {{SITE_NAME}}", 'registrationmagic-gold');

            case 'MAIL_NEW_USER2' :
                return __("Please click on the button below to activate the user.", 'registrationmagic-gold');

            case 'MAIL_NEW_USER3' :
                return __("If the above button is not working you can paste the following link to your browser", 'registrationmagic-gold');

            case 'ACT_AJX_FAILED_DEL' :
                return __("Failed to update user information.Can not activate user", 'registrationmagic-gold');

            case 'ACT_AJX_ACTIVATED' :
                return __("You have successfully activated the user.", 'registrationmagic-gold');

            case 'ACT_AJX_ACTIVATED2' :
                return __("If the user is activated by mistake or you do not want to activate the user you can deactivate the user using dashboard.", 'registrationmagic-gold');

            case 'ACT_AJX_ACTIVATE_FAIL' :
                return __("Unable to activate the user. Try activating the user using your dashboard.", 'registrationmagic-gold');

            case 'ACT_AJX_NO_ACCESS' :
                return __("You are not authorized to perform this action.", 'registrationmagic-gold');

            case 'FIELD_TYPE_MAP' :
                return __("Map", 'registrationmagic-gold');

            case 'LABEL_ST_ADDRESS' :
                return __("Street Address", 'registrationmagic-gold');

            case 'LABEL_ADDR_CITY' :
                return __("City", 'registrationmagic-gold');

            case 'LABEL_ADDR_STATE' :
                return __("State", 'registrationmagic-gold');

            case 'LABEL_ADDR_COUNTRY' :
                return __("Country", 'registrationmagic-gold');

            case 'LABEL_ADDR_ZIP' :
                return __("Zip Code", 'registrationmagic-gold');

            case 'FIELD_TYPE_ADDRESS' :
                return __("Address", 'registrationmagic-gold');

            case 'PH_ENTER_ADDR':
                return __("Enter your address", 'registrationmagic-gold');

            case 'LABEL_GOOGLE_API_KEY':
                return __("Google Maps API Key", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_GGL_API':
                return __("You will need a Google maps API to make 'Map' and 'Address' type fields work. To get API key <a target='blank' class='rm_help_link' href='https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true'>Click here</a>", 'registrationmagic-gold');

            case 'MSG_FRONT_NO_GOOGLE_API_KEY':
                return __("No Google Maps API configured.Please set a valid API Key from RegistrationMagic &#8594; Global Settings &#8594; EXTERNAL INTEGRATION.", 'registrationmagic-gold');

            case 'MSG_RM_NO_API_NOTICE':
                return __("Google Maps API Keys are required for this field.Please make sure you have configured a valid API key in Global Settings <span>&#8594;</span> EXTERNAL INTEGRATION.", 'registrationmagic-gold');

            case 'MSG_NEWSLETTER_SUBMITTED':
                return __("Congratulations! You have subscribed the newsletter successfully.", 'registrationmagic-gold');

            case 'MSG_USER_DELETED':
                return __("</em>User Deleted</em>", 'registrationmagic-gold');

            case 'ERR_SESSION_DIR_NOT_WRITABLE':
                return __('Session directory is not writable, please contact your server support to enable write permission to following directory: <br>%s', 'registrationmagic-gold');

            case 'MSG_GET_EMBED':
                return __('Get form embed code', 'registrationmagic-gold');

            case 'MSG_BANNED':
                return __("Access Denied", 'registrationmagic-gold');

            case 'MAIL_ACCOUNT_ACTIVATED' :
                return __('Hi,<br/><br/> Thank you for registering with <a href="{{SITE_URL}}">{{SITE_NAME}}</a>. Your account is now active.<br/><br/>Regards.', 'registrationmagic-gold');

            case 'MAIL_ACOOUNT_ACTIVATED_DEF_SUB' :
                return __('Account Activated', 'registrationmagic-gold');

            case 'VALIDATION_ERROR_IP_ADDRESS':
                return __("Only numbers, dot(.) and wildcard(?) are allowed.", 'registrationmagic-gold');

            case 'LABEL_BAN_IP_HELP':
                return __("Enter IP Address to ban, separate by space for multiple addresses. Wildcard(?) allowed (for IPv4 addresses only). For example: 127.233.12?.01? will ban all IPs from 127.233.120.010 to 127.233.129.019", 'registrationmagic-gold');

            case 'LABEL_BAN_IP':
                return __("Banned IP Addresses from accessing form.", 'registrationmagic-gold');

            case 'LABEL_BAN_EMAIL_HELP':
                return __("Enter Email Addresses to ban, separate by space for multiple addresses. Wildcard(* and ?) allowed. For example: joh*@gmail.com will ban all submissions done using gmail domain and start with 'joh'", 'registrationmagic-gold');

            case 'LABEL_BAN_USERNAME':
                return __("Blacklisted/reserved username", 'registrationmagic-gold');

            case 'LABEL_BAN_USERNAME_HELP':
                return __("User will not be able to register using these usernames, separate multiple usernames using space or newline", 'registrationmagic-gold');

            case 'LABEL_BAN_USERNAME_MSG':
                return __("This username can not be used", 'registrationmagic-gold');

            case 'LABEL_BAN_EMAIL':
                return __("Banned Email Addresses from submitting form", 'registrationmagic-gold');

            case 'LABEL_IS_REQUIRED_SCROLL':
                return __("Scrolling T&C is required", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_REQUIRED_SCROLL':
                return __("Force user to scroll past complete T&C before accepting.", 'registrationmagic-gold');

            case 'LABEL_LOGOUT':
                return __("Logout", 'registrationmagic-gold');

            case 'LABEL_FORM_CONF':
                return __("Form Configuration", 'registrationmagic-gold');

            case 'LABEL_F_GEN_SETT':
                return __("General Settings", 'registrationmagic-gold');


            case 'LABEL_F_VIEW_SETT':
                return __("Edit Design", 'registrationmagic-gold');


            case 'LABEL_F_ACC_SETT':
                return __("Accounts", 'registrationmagic-gold');


            case 'LABEL_F_PST_SUB_SETT':
                return __("Post Submission", 'registrationmagic-gold');


            case 'LABEL_F_AUTO_RESP_SETT':
                return __("Auto Responder", 'registrationmagic-gold');

            case 'LABEL_F_LIM_SETT':
                return __("Limits", 'registrationmagic-gold');


            case 'LABEL_F_MC_SETT':
                return __("MailChimp", 'registrationmagic-gold');


            case 'LABEL_F_ACTRL_SETT':
                return __("Access Control", 'registrationmagic-gold');


            case 'LABEL_F_GEN_SETT_DESC':
                return __("Name, description and general content", 'registrationmagic-gold');


            case 'LABEL_F_VIEW_SETT_DESC':
                return __("Personalize this form and make it your own!", 'registrationmagic-gold');


            case 'LABEL_F_ACC_SETT_DESC':
                return __("Define user account and role behavior", 'registrationmagic-gold');


            case 'LABEL_F_PST_SUB_SETT_DESC':
                return __("Success message, redirections and external submissions", 'registrationmagic-gold');


            case 'LABEL_F_AUTO_RESP_SETT_DESC':
                return __("Define auto responder settings with mail merge", 'registrationmagic-gold');


            case 'LABEL_F_LIM_SETT_DESC':
                return __("Limit form submissions based specific conditions and message", 'registrationmagic-gold');


            case 'LABEL_F_MC_SETT_DESC':
                return __("MailChimp Integration with advanced field mapping", 'registrationmagic-gold');

            case 'LABEL_F_ACTRL_SETT_DESC':
                return __("Form access restrictions based on date, passphrase and role.", 'registrationmagic-gold');

            case 'MSG_MC_KEY_NO_SET':
                return __("Mailchimp is not configured to work with this form. Please enter a valid mailchimp API key in Global Settings&#10148;External Integration&#10148;Mailchimp Api Key", 'registrationmagic-gold');

            case 'MSG_FS_NOT_AUTHORIZED' :
                return __("You are not authorized to see this page.", 'registrationmagic-gold');

            case 'SELECT_FIELD' :
                return __("Select a field.", 'registrationmagic-gold');

            case 'SELECT_LIST' :
                return __("Select a list.", 'registrationmagic-gold');

            case 'NOTICE_GOLD_i2_ACTIVATION':
                return __("RegistrationMagic Premium edition is already activated. Please disable Premium to activate Gold edition.", 'registrationmagic-gold');

            case 'NOTICE_SILVER_ACTIVATION':
                return __("RegistrationMagic Premium edition is already activated. Please disable Premium to activate Silver edition.", 'registrationmagic-gold');

            case 'NOTICE_BASIC_ACTIVATION':
                return __("RegistrationMagic Premium edition is already activated. Please disable Premium to activate Basic edition.", 'registrationmagic-gold');

            case 'LABEL_FORM_EXPIRED':
                return __("Expired", 'registrationmagic-gold');

            case 'LABEL_FORM_EXPIRES_ON':
                return __("Expires on", 'registrationmagic-gold');

            case 'LABEL_FORM_EXPIRES_IN':
                return __("Expires in %d days", 'registrationmagic-gold');

            case 'LABEL_HELP_TEXT':
                return __("Help text", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_HELP_TEXT':
                return __("This is displayed inside a fade-in box to the user when he/ she brings cursor above a field. The box disappears as soon as the cursor moves away from the field.", 'registrationmagic-gold');

            case 'LABEL_ENABLE_PW_RESTRICTIONS':
                return __("Enable custom password restrictions", 'registrationmagic-gold');

            case 'LABEL_PW_RESTRICTIONS':
                return __("Password rules", 'registrationmagic-gold');

            case 'LABEL_PW_RESTS_PWR_UC':
                return __("Must contain uppercase letter", 'registrationmagic-gold');

            case 'FIELD_TYPE_PHONE':
                return __("Phone Number", 'registrationmagic-gold');

            case 'FIELD_TYPE_PASSWORD':
                return __("Password", 'registrationmagic-gold');

            case 'FIELD_TYPE_NICKNAME':
                return __("Nick Name", 'registrationmagic-gold');

            case 'FIELD_TYPE_BDATE':
                return __("Birth Date", 'registrationmagic-gold');

            case 'FIELD_TYPE_SEMAIL':
                return __("Secondary email", 'registrationmagic-gold');

            case 'FIELD_TYPE_GENDER':
                return __("Gender", 'registrationmagic-gold');

            case 'FIELD_TYPE_LANGUAGE':
                return __("Language", 'registrationmagic-gold');

            case 'LABEL_IS_REQUIRED_RANGE':
                return __("Limited range of birth date", 'registrationmagic-gold');

            case 'LABEL_IS_REQUIRED_MAX_RANGE':
                return __("Maximum Date", 'registrationmagic-gold');

            case 'LABEL_IS_REQUIRED_MIN_RANGE':
                return __("Minimum Date", 'registrationmagic-gold');

            case 'TEXT_RANGE':
                return __("Range", 'registrationmagic-gold');

            case 'LABEL_SECEMAIL':
                return __("Secondary Email", 'registrationmagic-gold');

            case 'FIELD_TYPE_FACEBOOK':
                return __("Facebook", 'registrationmagic-gold');

            case 'FIELD_TYPE_TWITTER':
                return __("Twitter", 'registrationmagic-gold');

            case 'FIELD_TYPE_GOOGLE':
                return __("Google+", 'registrationmagic-gold');

            case 'FIELD_TYPE_INSTAGRAM':
                return __("Instagram", 'registrationmagic-gold');

            case 'FIELD_TYPE_LINKED':
                return __("LinkedIn", 'registrationmagic-gold');

            case 'FIELD_TYPE_YOUTUBE':
                return __("YouTube", 'registrationmagic-gold');

            case 'FIELD_TYPE_VKONTACTE':
                return __("VKontacte", 'registrationmagic-gold');

            case 'FIELD_TYPE_SKYPE':
                return __("Skype Id", 'registrationmagic-gold');

            case 'FIELD_TYPE_SOUNDCLOUD':
                return __("SoundCloud", 'registrationmagic-gold');

            case 'FIELD_TYPE_TIME':
                return __("Time", 'registrationmagic-gold');

            case 'FIELD_TYPE_IMAGE':
                return __("Image upload", 'registrationmagic-gold');

            case 'FIELD_TYPE_MOBILE':
                return __("Mobile Number", 'registrationmagic-gold');

            case 'FIELD_TYPE_SHORTCODE':
                return __("Shortcode", 'registrationmagic-gold');

            case 'WIDGET_TYPE_DIVIDER':
                return __("Divider", 'registrationmagic-gold');

            case 'WIDGET_TYPE_SPACING':
                return __("Spacing", 'registrationmagic-gold');

            case 'FIELD_TYPE_MULTI_DROP_DOWN':
                return __("Multi-Dropdown", 'registrationmagic-gold');

            case 'FIELD_TYPE_RATING':
                return __("Rating", 'registrationmagic-gold');

            case 'FACEBOOK_ERROR':
                return __("Incorrect Format of Facebook Url", 'registrationmagic-gold');

            case 'TWITTER_ERROR':
                return __("Incorrect Format of twitter Url", 'registrationmagic-gold');

            case 'PHONE_ERROR':
                return __("Incorrect Format of Phone Number", 'registrationmagic-gold');

            case 'GOOGLE_ERROR':
                return __("Incorrect Format of Google plus Url", 'registrationmagic-gold');

            case 'INSTAGRAM_ERROR':
                return __("Incorrect Format of Instagram Url", 'registrationmagic-gold');

            case 'LINKED_ERROR':
                return __("Incorrect Format of LinkedIn Url", 'registrationmagic-gold');

            case 'YOUTUBE_ERROR':
                return __("Incorrect Format of YouTube Url", 'registrationmagic-gold');

            case 'VKONTACTE_ERROR':
                return __("Incorrect Format of Vkontacte Url", 'registrationmagic-gold');

            case 'SKYPE_ERROR':
                return __("Incorrect Format of Skype Id", 'registrationmagic-gold');

            case 'SOUNDCLOUD_ERROR':
                return __("Incorrect Format of Sound cloud url", 'registrationmagic-gold');

            case 'MOBILE_ERROR':
                return __("Incorrect Format of Mobile Number", 'registrationmagic-gold');

            case 'LABEL_TIME_ZONE':
                return __("Timezone", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_TIME_ZONE':
                return __("Timezone for the field.", 'registrationmagic-gold');

            case 'LABEL_SHORTCODE_TEXT':
                return __("Shortcodes", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_SHORTCODE_TEXT':
                return __("Enter shortcodes that will appear on the form.", 'registrationmagic-gold');

            case 'FIELD_TYPE_WEBSITE':
                return __("Website", 'registrationmagic-gold');

            case 'WEBSITE_ERROR':
                return __("Incorrect Format of Website Url", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_IS_SHOW_ASTERIX':
                return __("Hide the red Asterisk(*) besides the label. Useful for marking required fields.", 'registrationmagic-gold');


            case 'LABEL_IS_SHOW_ASTERIX':
                return __("Hide Asterisk", 'registrationmagic-gold');

            case 'EMBED_CODE_INFO':
                return __("To use embed code X-Frame-Options must be set to 'ALLOWALL' on server or must be unset.", 'registrationmagic-gold');

            case 'LABEL_PW_RESTS_PWR_NUM':
                return __("Must contain numeral", 'registrationmagic-gold');

            case 'LABEL_PW_RESTS_PWR_SC':
                return __("Must contain special character", 'registrationmagic-gold');

            case 'LABEL_PW_RESTS_PWR_MINLEN':
                return __("Minimum length", 'registrationmagic-gold');

            case 'ERR_TITLE_CSTM_PW':
                return __("Error: Password must follow these rules:", 'registrationmagic-gold');

            case 'LABEL_PW_MINLEN_ERR':
                return __("Must not be shorter than %d characters", 'registrationmagic-gold');

            case 'LABEL_PW_MAXLEN_ERR':
                return __("Must not be longer than %d characters", 'registrationmagic-gold');

            case 'LABEL_PW_RESTS_PWR_MAXLEN':
                return __("Maximum length", 'registrationmagic-gold');

            case 'HELP_OPTIONS_CUSTOM_PW_RESTS':
                return __("Force custom rules for password that user choose during registration. Does not appy on auto-generated passwords.", 'registrationmagic-gold');


            case 'LABEL_RESET_PASS':
                return __("Reset Password", 'registrationmagic-gold');

            case 'LABEL_OLD_PASS':
                return __("Old Password", 'registrationmagic-gold');

            case 'LABEL_NEW_PASS':
                return __("New Password", 'registrationmagic-gold');

            case 'LABEL_NEW_PASS_AGAIN':
                return __("Confirm new password", 'registrationmagic-gold');

            case 'ERR_PASS_DOES_NOT_MATCH':
                return __("New password can not be confirmed.", 'registrationmagic-gold');

            case 'ERR_WRONG_PASS':
                return __("Password you have entered is incorrect.", 'registrationmagic-gold');

            case 'PASS_RESET_SUCCESSFUL':
                return __("Your password has been reset successfully. Redirecting you to the login page...", 'registrationmagic-gold');

            case 'ACCOUNT_NOT_ACTIVE_YET':
                return __("Your account is not active yet.", 'registrationmagic-gold');

            case 'LOGIN_AGAIN_AFTER_RESET':
                return __("Please login again with your new password.", 'registrationmagic-gold');

            case 'LABEL_ERROR':
                return __("ERROR", 'registrationmagic-gold');

            case 'LABEL_SUB_PDF_HEADER_IMG':
                return __("Logo on submission PDF header", 'registrationmagic-gold');

            case 'LABEL_SUB_PDF_HEADER_TEXT':
                return __("Text below the logo on submission PDF", 'registrationmagic-gold');

            case 'SUB_PDF_HEADER_IMG_HELP':
                return __("You can brand Submissions PDF with your logo.", 'registrationmagic-gold');

            case 'SUB_PDF_HEADER_TEXT_HELP':
                return __("Puts a line of text on Submission PDF header, as a note or part of branding.", 'registrationmagic-gold');

            case 'LABEL_ACTRL_DATE_CB':
                return __("Enable date based form access control", 'registrationmagic-gold');

            case 'LABEL_ACTRL_PASS_CB':
                return __("Enable passphrase based form access control", 'registrationmagic-gold');

            case 'LABEL_ACTRL_ROLE_CB':
                return __("Enable user role based form access control", 'registrationmagic-gold');

            case 'HELP_FORM_ACTRL_DATE':
                return __("User will be asked to input a date before accessing form. Useful for setting age based restrictions.", 'registrationmagic-gold');

            case 'HELP_FORM_ACTRL_PASS':
                return __("Users will be asked to enter a passphrase before accessing form.", 'registrationmagic-gold');

            case 'HELP_FORM_ACTRL_ROLE':
                return __("Only users with specified roles will be able to view form", 'registrationmagic-gold');

            case 'LABEL_ACTRL_DATE_QUESTION':
                return __("Question for asking date", 'registrationmagic-gold');

            case 'LABEL_ACTRL_PASS_QUESTION':
                return __("Question for asking passphrase", 'registrationmagic-gold');

            case 'LABEL_ACTRL_DATE_QUESTION_DEF':
                return __("Enter your date of birth", 'registrationmagic-gold');

            case 'LABEL_ACTRL_PASS_QUESTION_DEF':
                return __("Enter the secret code", 'registrationmagic-gold');

            case 'HELP_FORM_ACTRL_DATE_QSTN':
                return __("This question will be asked to user for entering a date", 'registrationmagic-gold');

            case 'HELP_FORM_ACTRL_PASS_QSTN':
                return __("This question will be asked to user for entering passphrase", 'registrationmagic-gold');

            case 'LABEL_ACTRL_DATE_TYPE':
                return __("Limit type", 'registrationmagic-gold');

            case 'LABEL_ACTRL_DATE_LLIMIT':
                return __("Lower limit", 'registrationmagic-gold');

            case 'LABEL_ACTRL_DATE_ULIMIT':
                return __("Upper limit", 'registrationmagic-gold');

            case 'LABEL_ACTRL_DATE_TYPE_DIFF':
                return __("Age limit", 'registrationmagic-gold');

            case 'LABEL_ACTRL_DATE_TYPE_DATE':
                return __("Absolute dates", 'registrationmagic-gold');

            case 'HELP_FORM_ACTRL_DATE_TYPE':
                return __("Type of the limits. User entered date must fall into the given date range or age range.", 'registrationmagic-gold');

            case 'HELP_FORM_ACTRL_ROLE_ROLES':
                return __("Only users with these roles will be able to access form", 'registrationmagic-gold');

            case 'LABEL_ACTRL_ROLE_ROLES':
                return __("Select User Roles", 'registrationmagic-gold');

            case 'LABEL_ACTRL_PASS_PASS':
                return __("Passphrase", 'registrationmagic-gold');

            case 'HELP_FORM_ACTRL_PASS_PASS':
                return __("The passphrase/secret code that user must enter to access the form. Separate multiple passphrases with pipe (|).", 'registrationmagic-gold');

            case 'MSG_INVALID_ACTRL_DATE_TYPE':
                return __("Invalid date limit type.", 'registrationmagic-gold');

            case 'MSG_INVALID_ACTRL_DATE_LIMIT':
                return __("Atleast one limit must be input", 'registrationmagic-gold');

            case 'MSG_INVALID_ACTRL_PASS_PASS':
                return __("Passphrase can not be empty", 'registrationmagic-gold');

            case 'MSG_INVALID_ACTRL_ROLES':
                return __("No user-roles selected.", 'registrationmagic-gold');

            case 'LABEL_ACTRL_FAIL_MSG':
                return __("Denial message", 'registrationmagic-gold');

            case 'HELP_FORM_ACTRL_FAIL_MSG':
                return __("If user is not authorised to access the form this message will be displayed in place of form.", 'registrationmagic-gold');

            case 'LABEL_ACTRL_FAIL_MSG_DEF':
                return __("Sorry, you are not authorised to access this content.", 'registrationmagic-gold');

            case 'LABEL_FIELD_ICON_FG_COLOR':
                return __("Icon color", 'registrationmagic-gold');

            case 'HELP_FIELD_ICON_FG_COLOR':
                return __("Foreground color of the icon", 'registrationmagic-gold');

            case 'LABEL_FIELD_ICON_BG_COLOR':
                return __("Background color", 'registrationmagic-gold');

            case 'HELP_FIELD_ICON_BG_COLOR':
                return __("Background color of the icon", 'registrationmagic-gold');

            case 'LABEL_FIELD_ICON_SHAPE':
                return __("Shape", 'registrationmagic-gold');

            case 'LABEL_FIELD_ICON_CLOSE':
                return __("Close", 'registrationmagic-gold');

            case 'MSG_CAN_NOT_SAVE_FS_VIEW_AJX':
                return __("No data to be saved.", 'registrationmagic-gold');

            case 'LABEL_CLICK_HERE':
                return __("Click Here", 'registrationmagic-gold');

            case 'LABEL_REGISTER':
                return __("Register", 'registrationmagic-gold');

            case 'LABEL_FLOATING_ICON_BCK_COLOR':
                return __("Floating Icon Background Color", 'registrationmagic-gold');

            case 'LABEL_SHOW_FLOATING_ICON':
                return __("Show Magic Pop-up Button, Menu and Panels", 'registrationmagic-gold');

            case 'HELP_SHOW_FLOATING_ICON':
                return __("Makes it easier to let your users to sign in, register and access their data WITHOUT going through process of setting up shortcodes and custom menu links!", 'registrationmagic-gold');

            case 'HELP_FLOATING_ICON_BCK_COLOR':
                return __("Define accent of the front end buttons and panels. Match it to your theme or contrast it for better visibility. This can be edited live by visiting the front end!", 'registrationmagic-gold');

            case 'LABEL_ICON':
                return __("Icon", 'registrationmagic-gold');

            case 'LABEL_TEXT':
                return __("Text", 'registrationmagic-gold');

            case 'LABEL_BOTH':
                return __("Both", 'registrationmagic-gold');

            case 'LABEL_SHOW_FLOATING_BUTTON_AS':
                return __("Show floating button as", 'registrationmagic-gold');

            case 'HELP_SHOW_FLOATING_BUTTON_AS':
                return __("&nbsp;", 'registrationmagic-gold');

            case 'LABEL_FLOATING_BUTTON_TEXT':
                return __("Floating Button Text", 'registrationmagic-gold');

            case 'HELP_FLOATING_BUTTON_TEXT':
                return __("&nbsp;", 'registrationmagic-gold');

            case 'LABEL_FIELD_ICON_CHANGE':
                return __("Change", 'registrationmagic-gold');

            case 'LABEL_FIELD_ICON':
                return __("Icon", 'registrationmagic-gold');

            case 'HELP_FIELD_ICON':
                return __("Display an icon before the label of this field to add little pizzaz to your form. You can style the icon below.", 'registrationmagic-gold');

            case 'HELP_FIELD_ICON_SHAPE':
                return __("Icon will be masked by this shape", 'registrationmagic-gold');

            case 'FIELD_ICON_SHAPE_SQUARE':
                return __("Square", 'registrationmagic-gold');

            case 'FIELD_ICON_SHAPE_ROUND':
                return __("Round", 'registrationmagic-gold');

            case 'FIELD_ICON_SHAPE_STICKER':
                return __("Sticker", 'registrationmagic-gold');

            case 'LABEL_ACTRL_BUTTON_CONT':
                return __("Continue", 'registrationmagic-gold');

            case 'ADMIN_MENU_FRONTEND':
                return __("Frontend", 'registrationmagic-gold');

            case 'NO_DEFAULT_FORM':
                return __("No Registration form is selected.", 'registrationmagic-gold');

            case 'LABEL_FORM_PRESENTATION':
                return __("Edit Form Presentation", 'registrationmagic-gold');

            case 'LABEL_FIELD_ICON_BG_ALPHA':
                return __("Background transparency", 'registrationmagic-gold');

            case 'HELP_FIELD_ICON_BG_ALPHA':
                return __("Change the opacity of icon's background", 'registrationmagic-gold');

            case 'MSG_PLEASE_LOGIN_FIRST':
                return __("Please login to view this page.", 'registrationmagic-gold');

            case 'INFO_USERS_SELECTED_FOR_MAIL':
                return __('This Message will be sent to  <b>%d users</b> who have filled the form ', 'registrationmagic-gold');

            case 'LABEL_AUTO_LOGIN':
                return __("Automatically log in user after registration", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_AUTO_LOGIN':
                return __("User will be logged in automatically on next page refresh after successfull account creation. You may set up auto-redirect after submission. Note that it will work only if auto-approval is enabled.", 'registrationmagic-gold');
            case 'SELECT_FIELD_MULTI_OPTION':
                return __("Select options", 'registrationmagic-gold');

            case 'TITLE_EDIT_NOTE_PAGE':
                return __("Edit Note", 'registrationmagic-gold');

            case 'HELP_ADD_BDATE_RANGE_MAX':
                return __("Maximum date of for the field ", 'registrationmagic-gold');

            case 'HELP_ADD_BDATE_RANGE_MIN':
                return __("Minimum date of for the field", 'registrationmagic-gold');

            case 'LABEL_CONSTANT_CONTACT_OPTION':
                return __("Constant Contact ", 'registrationmagic-gold');

            case 'LABEL_CONSTANT_CONTACT_OPTION_INTEGRATION':
                return __("Constant Contact Integration", 'registrationmagic-gold');

            case 'LABEL_CONSTANT_CONTACT_APP_ID':
                return __("Constant Contact App Key ", 'registrationmagic-gold');

            case 'LABEL_CONSTANT_CONTACT_ACCESS_TOKEN':
                return __("Constant Contact Access Token ", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_CC_APP_ID':
                return __("Provide the app key of your constant contact acount. ", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_CC_ACCESS_TOKEN':
                return __("Provide the access token of your constant contact acount. ", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_CC_ENABLE':
                return __(" Enable Constant Contact Integration", 'registrationmagic-gold');

            case 'LABEL_F_ACTRL_CC_DESC':
                return __(" Constant Contact Integration with advanced field mapping", 'registrationmagic-gold');

            case 'LABEL_MNAME':
                return __("Middle Name", 'registrationmagic-gold');

            case 'LABEL_COMPANY':
                return __("Company Name", 'registrationmagic-gold');

            case 'LABEL_JOB_TILE':
                return __("Job Title", 'registrationmagic-gold');

            case 'LABEL_WORK_PHONE':
                return __("Work Phone", 'registrationmagic-gold');

            case 'LABEL_CELL_PHONE':
                return __("Cell Phone", 'registrationmagic-gold');

            case 'LABEL_HOME_PHONE':
                return __("Home Phone", 'registrationmagic-gold');

            case 'LABEL_FAX':
                return __("Fax", 'registrationmagic-gold');

            case 'LABEL_ADDRESS':
                return __("Address", 'registrationmagic-gold');

            case 'LABEL_CREATED_DATE':
                return __("Created date", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_CC':
                return __("This will map the selected field to the corresponding constant contact field.", 'registrationmagic-gold');

            case 'LABEL_CC_LIST':
                return __("Constant contact list", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_CC_LIST':
                return __("Select a Constant contact list", 'registrationmagic-gold');

            case 'MSG_SUBSCRIBE_CC':
                return __("Subscibe to Constant contact", 'registrationmagic-gold');

            case 'FIELD_TYPE_CUSTOM':
                return __("Custom Field", 'registrationmagic-gold');

            case 'LABEL_VALIDATION':
                return __("Validation", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_VALIDATIONS':
                return __("Choose one of the validation you want to apply to the field", 'registrationmagic-gold');

            case 'LABEL_CUSTOM_VALIDATION':
                return __("Custom Validation", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_CUSTOM_VALIDATION':
                return __("Enter any reguler expression you want to apply as a validation.", 'registrationmagic-gold');

            case 'VALIDATION_ERROR':
                return __("Invalid Content", 'registrationmagic-gold');

            case 'SELECT_VALIDATION':
                return __("Select a validation", 'registrationmagic-gold');

            case 'LABEL_AWEBER_OPTION':
                return __("Aweber", 'registrationmagic-gold');

            case 'LABEL_AWEBER_OPTION_INTEGRATION':
                return __("Aweber Integration", 'registrationmagic-gold');

            case 'LABEL_AWEBER_CONSUMER_KEY':
                return __("Aweber Consumer Key", 'registrationmagic-gold');

            case 'LABEL_AWEBER_CONSUMER_SECRET':
                return __("Aweber Consumer Secret", 'registrationmagic-gold');

            case 'LABEL_AWEBER_ACCESS_KEY':
                return __("Aweber Access Token", 'registrationmagic-gold');

            case 'LABEL_AWEBER_ACCESS_SECRET':
                return __("Aweber Access Secret", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_AW_ENABLE':
                return __("Integrate with your Aweber developer and featured account", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_A_CONSUMER_KEY':
                return __("Provide consumer Key of your App in Aweber Developer Account.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_A_CONSUMER_SECRET':
                return __("Provide consumer Secret of your App in Aweber Developer Account.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_A_ACCESS_KEY':
                return __("Provide Access token of your App in Aweber Developer Account.If you dont know where to get this ,use link given below.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_A_ACCESS_SECRET':
                return __("Provide Access Secret of your App in Aweber Developer Account.If you dont know where to get this ,use link given below.", 'registrationmagic-gold');

            case 'LABEL_F_ACTRL_AW_DESC':
                return __("Aweber Integration with basic field mapping.", 'registrationmagic-gold');

            case 'LABEL_AW_LIST':
                return __("Select Aweber list.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_AW_LIST':
                return __("Select the Aweber list in which you want add subscribers.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_FIELD':
                return __("Map you Aweber field with form field.", 'registrationmagic-gold');

            case 'HELP_OPT_IN_CB_AW':
                return __("Display a checkbox, allowing users to opt-in for subscription.", 'registrationmagic-gold');

            case 'TITLE_NEW_NOTE_PAGE':
                return __("New Note", 'registrationmagic-gold');

            case 'LABEL_ADD_NEW_PRICE_FIELD':
                return __("New Product", 'registrationmagic-gold');

            ////////////////
            case 'FIELD_HELP_TEXT_Textbox':
                return __('Simple single line text field.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_HTMLP':
                return __('This is a read only field which can be used to display formatted content inside the form. HTML is supported.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_HTMLH':
                return __('Large size read only text useful for creating custom headings.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Select':
                return __('Allows user to choose a value from multiple predefined options displayed as drop down list.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Radio':
                return __('Allows user to choose a value from multiple predefined options displayed as radio boxes.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Textarea':
                return __('This allows user to input multiple lines of text as value.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Checkbox':
                return __('Allows user to choose more than one value from multiple predefined options displayed as checkboxes.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_jQueryUIDate':
                return __('Allows users to pick a date from graphical calendar or enter manually.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Email':
                return __('An additional email field. Please note, primary email field always appears in the form and cannot be removed.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Number':
                return __('Allows user to input value in numbers.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Country':
                return __('A drop down list of all countries appears to the user for selection.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Timezone':
                return __('A drop down list of all time-zones appears to the user for selection.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Terms':
                return __('Useful for adding terms and conditions to the form. User must select the check box to continue with submission if you select &quot;Is Required&quot; below.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_File':
                return __('Display a field to the user for attaching files from his/ her computer to the form.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Price':
                return __('Adds product to the form. Products are separately defined in &quot;Products&quot; section of RegistrationMagic. This field type allows you to insert one of the products defined there.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Repeatable':
                return __('Allows user to add extra text field boxes to the form for submitting different values. Useful where a field requires multiple user input  values. ', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Map':
                return __('Displays a Map on the form with ability to search and mark an address.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Address':
                return __('Adds field set for entering an address with Google Geolocation autocomplete support', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Fname':
                return __('This field is connected directly to WordPress&#39; User area First Name field. ', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Lname':
                return __('This field is connected directly to WordPress&#39; User area Last Name field. ', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_BInfo':
                return __('This field is connected directly to WordPress&#39; User area Bio field. It allows inserting multiple lines of text. ', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Phone':
                return __('Adds a phone number field.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Mobile':
                return __('Adds a Mobile number field', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Password':
                return __('Add a field that masks entered value like password.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Nickname':
                return __('A Nickname field bound to WordPress&#39; default User field with same name.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Bdate':
                return __('A speciality date field that records date of birth', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_SecEmail':
                return __('A secondary email field, it will displayed on the user profile page.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Gender':
                return __('Gender/ Sex selection radio box', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Language':
                return __('Adds a drop down language selection field with common languages as options', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Facebook':
                return __('A speciality URL field for asking Facebook Profile page', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Twitter':
                return __('A speciality URL field for asking Twitter page', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Google':
                return __('A speciality URL field for asking Google+ Profile page', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Linked':
                return __('A speciality URL field for asking LinkedIn Profile page', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Youtube':
                return __('A speciality URL field for asking YouTube Channel or Video page', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_VKontacte':
                return __('A speciality URL field for asking VKontacte page', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Instagram':
                return __('Asks User his/ her Instagram Profile', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Skype':
                return __('Asks User his/ her Skype ID', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_SoundCloud':
                return __('A speciality URL field for asking SoundClound URL', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Time':
                return __('A field for entering time', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Image':
                return __('A speciality file upload field optimized for image upload', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Shortcode':
                return __('You can use this field to enter a WordPress plugin shortcode. ShortCode will be parsed and rendered automatically inside the form.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Divider':
                return __('Divider for separating fields.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Spacing':
                return __('Useful for adding space between fields', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Multi-Dropdown':
                return __('A dropdown field with a twist. Users can now select more than one option.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Rating':
                return __('A rating field that allows users to submit a rating by selecting number of stars (or another icon of your choice).', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Website':
                return __('A website URL field bound to WordPress&#39; default User field with same name.', 'registrationmagic-gold');
            ////////////////

            case 'LABEL_WELCOME':
                return __("Welcome", 'registrationmagic-gold');

            case 'LABEL_SWITCH':
                return __("Switch", 'registrationmagic-gold');

            case 'LABEL_LIGHT':
                return __("Light", 'registrationmagic-gold');

            case 'LABEL_DARK':
                return __("Dark", 'registrationmagic-gold');

            case 'DISCLAIMER_FORM_VIEW_SETTING':
                return __("<b>Note: This is not a 100% accurate representation of how the form will appear on the front end.<br>Front end presentation is influenced by multiple factors including your theme&#39;s CSS.</b>", 'registrationmagic-gold');

            case 'LABEL_F_FIELDS':
                return __("Custom Fields", 'registrationmagic-gold');

            case 'LABEL_F_FIELDS_DESC':
                return __("Add, edit or modify various custom fields in this form", 'registrationmagic-gold');

            case 'LABEL_IMPORT':
                return __("Import", 'registrationmagic-gold');

            case 'LABEL_EXPORT':
                return __("Export", 'registrationmagic-gold');

            case 'UPLOAD_XML':
                return __("Upload Rmagic.xml ", 'registrationmagic-gold');

            case 'UPLOAD_XML_HELP':
                return __("Upload the backup Rmagic.xml file you had exported earlier, to import all the form data.", 'registrationmagic-gold');

            case 'CC_ERROR':
                return __("<div class='rmnotice'>Oops!! Something went wrong.<ul><li>Possible causes:-</li><li>Couldn't access your  constant contact account with the details you have provided in Global settings->External Integrations.</li><li>You have not created any list in your constant contact account.</li></ul></div>", 'registrationmagic-gold');

            case 'AW_ERROR':
                return __("<div class='rmnotice'>Oops!! Something went wrong.<ul><li>Possible causes:-</li><li>Couldn't access your  aweber account with the details you have provided in Global settings->External Integrations.</li><li>You have not created any list in your aweber account.</li></ul></div>", 'registrationmagic-gold');

            case 'MC_ERROR':
                return __("<div class='rmnotice'>Oops!! Something went wrong.<ul><li>Possible causes:-</li><li>Couldn't access your  mailchimp account with the details you have provided in Global settings->External Integrations.</li><li>You have not created any list in your mailchimp account.</li></ul></div>", 'registrationmagic-gold');

            case 'RM_ERROR_EXTENSION_CURL_CC':
                return __("PHP extension CURL is not enabled on server.So Constant Contact will not work.", 'registrationmagic-gold');

            case 'RM_ERROR_PHP_4.5':
                return __("Constant Contact requires PHP version 5.4+.Please upgrade your php version to use constant contact", 'registrationmagic-gold');

            case 'LABEL_YES':
                return __("Yes", 'registrationmagic-gold');

            case 'LABEL_NO':
                return __("No", 'registrationmagic-gold');

            case 'LABEL_DEFAULT':
                return __("Default", 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Custom':
                return __('Add a generic field with custom validation set below.', 'registrationmagic-gold');

            case 'LABEL_SECTION_NAME':
                return __("Section Name", 'registrationmagic-gold');

            case 'LABEL_LABEL_COLOR':
                return __("Label Color", 'registrationmagic-gold');

            case 'LABEL_TEXT_COLOR':
                return __("Text Color", 'registrationmagic-gold');

            case 'LABEL_PLACEHOLDER_COLOR':
                return __("Placeholder Color", 'registrationmagic-gold');

            case 'LABEL_OUTLINE_COLOR':
                return __("Outline Color", 'registrationmagic-gold');

            case 'LABEL_FOCUS_COLOR':
                return __("Focus Color", 'registrationmagic-gold');

            case 'LABEL_FOCUS_BG_COLOR':
                return __("Background on Focus", 'registrationmagic-gold');

            case 'LABEL_FORM_PADDING':
                return __("Form Padding", 'registrationmagic-gold');

            case 'LABEL_SECTION_BG_COLOR':
                return __("Section Background Color", 'registrationmagic-gold');

            case 'LABEL_SECTION_TEXT_COLOR':
                return __("Section Text Color", 'registrationmagic-gold');

            case 'LABEL_SECTION_TEXT_STYLE':
                return __("Section Text Style", 'registrationmagic-gold');

            case 'LABEL_BORDER_COLOR':
                return __("Border Color", 'registrationmagic-gold');

            case 'LABEL_BORDER_WIDTH':
                return __("Border Width", 'registrationmagic-gold');

            case 'LABEL_BORDER_RADIUS':
                return __("Border Radius", 'registrationmagic-gold');

            case 'LABEL_BORDER_STYLE':
                return __("Border Style", 'registrationmagic-gold');

            case 'LABEL_BACKGROUND_IMAGE':
                return __("Background Image", 'registrationmagic-gold');

            case 'LABEL_IMAGE_REPEAT':
                return __("Image Repeat", 'registrationmagic-gold');

            case 'LABEL_BUTTON_LABEL':
                return __("Button Label", 'registrationmagic-gold');

            case 'LABEL_FONT_COLOR':
                return __("Font Color", 'registrationmagic-gold');

            case 'LABEL_HOVER_COLOR':
                return __("Hover Color", 'registrationmagic-gold');

            case 'LABEL_BACKGROUND_COLOR':
                return __("Background Color", 'registrationmagic-gold');

            case 'LABEL_T_AND_C_CB_LABEL':
                return __("Checkbox label", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_TnC_CB_LABEL':
                return __("This will appear along with the checkbox. You might want to set it up to something like &quot;I accept&quot;", 'registrationmagic-gold');

            case 'LABEL_SOCIAL_FIELDS':
                return __('Social Fields', 'registrationmagic-gold');

            case 'HELP_OPT_IN_CB_CC':
                return __("Display a checkbox, allowing users to opt-in for subscription.", 'registrationmagic-gold');

            case 'LABEL_SUBMISSION_ON_CARD':
                return __('Submission badge count on form card', 'registrationmagic-gold');

            case 'HELP_SUBMISSION_ON_CARD':
                return __('The number on form card badge will count based on this criteria.', 'registrationmagic-gold');

            case 'ADMIN_MENU_SETTING_FAB_PT':
                return __("Magic Popup Button Setting", 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_FAB':
                return __("Magic Popup Button", 'registrationmagic-gold');

            case 'GLOBAL_SETTINGS_FAB_EXCERPT':
                return __("One button to rule them all!", 'registrationmagic-gold');

            case 'LABEL_SELECT_FORM_TYPE':
                return __("Select Form Type", 'registrationmagic-gold');

            case 'LABEL_REG_FORM':
                return __("Enable WordPress User Account Creation", 'registrationmagic-gold');

            case 'LABEL_NON_REG_FORM':
                return __("Disable WordPress User Account Creation", 'registrationmagic-gold');

            case 'HELP_SELECT_FORM_TYPE_REG':
                return __("For those who want to create WP User accounts after form submission or Manual Approval.", 'registrationmagic-gold');

            case 'HELP_SELECT_FORM_TYPE_NON_REG':
                return __("For those who do not want to create WP User accounts with form submissions.Ideal for offline registration processes or using this form as simple contact/enquiry form.", 'registrationmagic-gold');

            case 'LABEL_POST_EXP_ACTION':
                return __("Post Expiry Action", 'registrationmagic-gold');

            case 'HELP_POST_EXP_ACTION':
                return __("Select action to perform after this form expires", 'registrationmagic-gold');

            case 'LABEL_DISPLAY_MSG':
                return __("Display a message", 'registrationmagic-gold');

            case 'LABEL_SWITCH_FORM':
                return __("Display another form", 'registrationmagic-gold');

            case 'LABEL_SELECT_FORM':
                return __("Select form", 'registrationmagic-gold');

            case 'HELP_POST_EXP_FORM':
                return __("This form will be displayed to user in place of the expired form.", 'registrationmagic-gold');

            case 'LABEL_FAB_ICON':
                return __("Icon On Magic Popup Button", 'registrationmagic-gold');

            case 'LABEL_FAB_ICON_BTN':
                return __("Select", 'registrationmagic-gold');

            case 'TEXT_FAB_ICON_HELP':
                return __("Display an image on Magic Popup Button instead of the default icon.", 'registrationmagic-gold');

            case 'LABEL_HIDE_PREV_BUTTON':
                return __("Do not show &quot;Previous&quot; button:<br/>(For Multi-Step Registration Form Only)", 'registrationmagic-gold');

            case 'HELP_HIDE_PREV_BUTTON':
                return __("Enabling this will remove previous button from multi-page forms, thus prohibiting user from navigating back to already filled pages without reloading the form.", 'registrationmagic-gold');

            case 'LABEL_IS_PAID_ROLE':
                return __("Is paid role", 'registrationmagic-gold');

            case 'HELP_IS_PAID_ROLE':
                return __("User will be charged for this role.(Make sure that you have configured payment option in Global Settings->Payments)", 'registrationmagic-gold');

            case 'LABEL_ROLE_PRICE':
                return __("Role Charges", 'registrationmagic-gold');

            case 'HELP_ROLE_PRICE':
                return __("This charge will be added to the form and user redirected to the payment when this role is auto assigned to the form.", 'registrationmagic-gold');

            case 'LABEL_FAB_ICON_BTN_REM':
                return __("Remove", 'registrationmagic-gold');

            case 'LABEL_SHOW_FAB_LINK1':
                return __("Custom Link #1", 'registrationmagic-gold');

            case 'LABEL_SHOW_FAB_LINK2':
                return __("Custom Link #2", 'registrationmagic-gold');

            case 'LABEL_SHOW_FAB_LINK3':
                return __("Custom Link #3", 'registrationmagic-gold');

            case 'HELP_SHO_FAB_LINK':
                return __("Adds a custom link of your choice on the front-end Magic Popup menu.", 'registrationmagic-gold');

            case 'LABEL_FAB_LINK_TYPE':
                return __("Link Type", 'registrationmagic-gold');

            case 'LABEL_VISIBILITY':
                return __("Visible to", 'registrationmagic-gold');

            case 'LABEL_FAB_URL_LABEL':
                return __("Label of the URL", 'registrationmagic-gold');

            case 'TEXT_FROM':
                return __("From", 'registrationmagic-gold');

            case 'LABEL_BLOCK_EMAIL':
                return __("Block Email", 'registrationmagic-gold');

            case 'LABEL_UNBLOCK_EMAIL':
                return __("Unblock Email", 'registrationmagic-gold');

            case 'LABEL_UNBLOCK_IP':
                return __("Unblock IP", 'registrationmagic-gold');

            case 'LABEL_BLOCK_IP':
                return __("Block IP", 'registrationmagic-gold');

            case 'NOTE_MAGIC_PANEL_STYLING':
                return __("Magic Panels can be styled by logging in as admin and visiting site front end.", 'registrationmagic-gold');

            case 'MSG_LOGIN_SUCCESS':
                return __("You have logged in successfully.", 'registrationmagic-gold');

            case 'LABEL_SEND_MESSAGE':
                return __("Send Message", 'registrationmagic-gold');

            case 'LABEL_MESSAGE_TEXT':
                return __("Message", 'registrationmagic-gold');

            case 'TITLE_NEW_MESSAGE_PAGE':
                return __("New Message", 'registrationmagic-gold');

            case 'MSG_FROM_ADMIN':
                return __("Admin sent a message to you:<br><br>", 'registrationmagic-gold');

            case 'LABEL_SENT_BY':
                return __("Sent by", 'registrationmagic-gold');

            case 'LABEL_RELATED':
                return __("Related", 'registrationmagic-gold');

            case 'LABEL_HIDE_USERNAME':
                return __("Hide Username", 'registrationmagic-gold');

            case 'HELP_HIDE_USERNAME':
                return __("This will hide the Username field. Email address will be treated as Username.", 'registrationmagic-gold');

            case 'LABEL_HAVE_NOTE':
                return __("Has Note", 'registrationmagic-gold');

            case 'LABEL_PAYMENT_RECEIVED':
                return __("Payment Received", 'registrationmagic-gold');

            case 'LABEL_PAYMENT_PENDING':
                return __("Payment Pending", 'registrationmagic-gold');

            case 'LABEL_NO_ATTACHMENT':
                return __("No Attachment", 'registrationmagic-gold');

            case 'LABEL_ATTACHMENT':
                return __("Attachment", 'registrationmagic-gold');

            case 'LABEL_READ':
                return __("Read", 'registrationmagic-gold');

            case 'LABEL_UNREAD':
                return __("Unread", 'registrationmagic-gold');

            case 'AWEBER_MESSAGE':
                return __("<p style='padding-left: 20px;'>Don't know how to get Access token and secret key? Click <a %s>HERE</a> to get these.</p>", 'registrationmagic-gold');

            case 'LABEL_IS_FIELD_EDITABLE':
                return __("Allow users to edit this field after submission", 'registrationmagic-gold');

            case 'HELP_LABEL_IS_FIELD_EDITABLE':
                return __("If you have set up a front-end for your users and want them to login and edit the form submission once they have filled and sent the form, you must turn this on.", 'registrationmagic-gold');

            case 'VALIDATION_REQUIRED':
                return __("This field is required.", 'registrationmagic-gold');

            case 'INVALID_URL':
                return __("Please enter a valid URL.", 'registrationmagic-gold');

            case 'INVALID_FORMAT':
                return __("Invalid Format.", 'registrationmagic-gold');

            case 'INVALID_NUMBER':
                return __("Please enter a valid number.", 'registrationmagic-gold');

            case 'INVALID_DIGITS':
                return __("Please enter only digits.", 'registrationmagic-gold');

            case 'LABEL_ALLOW_MULTILINE':
                return __("Allow Multiline", 'registrationmagic-gold');

            case 'LABEL_DEFAULT_STATE':
                return __("Default State.", 'registrationmagic-gold');

            case 'LABEL_CHECKED':
                return __("Checked", 'registrationmagic-gold');

            case 'LABEL_UNCHECKED':
                return __("Unchecked", 'registrationmagic-gold');

            case 'MSG_OPT_IN_DEFAULT_STATE':
                return __("Default state of the opt in check box.", 'registrationmagic-gold');

            case 'MSG_EDIT_SUBMISSION':
                return __("Edit This Submission", 'registrationmagic-gold');

            case 'MSG_EDIT_YOUR_SUBMISSIONS':
                return __("Edit Your Submissions", 'registrationmagic-gold');

            case 'LABEL_SHOW_PAYMENT_TAB':
                return __("Show payment tab.", 'registrationmagic-gold');

            case 'LABEL_SHOW_SUBMISSION_TAB':
                return __("Show registrations tab", 'registrationmagic-gold');

            case 'LABEL_SHOW_DETAILS_TAB':
                return __("Show my details tab.", 'registrationmagic-gold');

            case 'HELP_SHOW_SUBMISSION_TAB':
                return __("This will show a tab on popup menu named Submissions.", 'registrationmagic-gold');

            case 'HELP_SHOW_PAYMENT_TAB':
                return __("This will show a tab on popup menu named Payments.", 'registrationmagic-gold');

            case 'HELP_SHOW_DETAILS_TAB':
                return __("This will show a tab on popup menu named My details.", 'registrationmagic-gold');

            case 'LABEL_SHOW_ASTERIX':
                return __("Show Asterisk on required fields", 'registrationmagic-gold');

            case 'LABEL_BLOCKED':
                return __("Blocked", 'registrationmagic-gold');

            case 'HELP_SHOW_ASTERIX':
                return __("Show the red Asterisk(*) besides the label. Useful for marking required fields.", 'registrationmagic-gold');

            case 'LABEL_LOGIN_GPLUS_OPTION':
                return __('Allow User to Login using Google+:', 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_GP_ENABLE':
                return __("A login using Google+ button will appear alongside the login form.", 'registrationmagic-gold');

            case 'LABEL_GPLUS_CLIENT_ID':
                return __("Google+ client ID", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_GP_CLIENT_ID':
                return __("To make Google+ login work, you&#39;ll need a client ID. More information <a target='blank' class='rm_help_link' href='https://developers.google.com/identity/sign-in/web/devconsole-project'>here</a>.", 'registrationmagic-gold');

            case 'LABEL_LOGIN_LINKEDIN_OPTION':
                return __('Allow User to Login using LinkedIn:', 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_LINKEDIN_ENABLE':
                return __("A login using LinkedIn button will appear alongside the login form.", 'registrationmagic-gold');

            case 'LABEL_LIN_API_KEY':
                return __("LinkedIn Client ID/API Key", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_LIN_API_KEY':
                return __("To make LinkedIn login work, you&#39;ll need an API Key. More information <a target='blank' class='rm_help_link' href='https://developer.linkedin.com/support/faq'>here</a>.", 'registrationmagic-gold');

            case 'LABEL_LOGIN_WINDOWS_OPTION':
                return __('Allow User to Login using Microsoft Live', 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_WINDOWS_ENABLE':
                return __("A login using Microsoft Live button will appear alongside the login form.", 'registrationmagic-gold');

            case 'LABEL_WIN_CLIENT_ID':
                return __("Microsoft App/Client ID", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_WIN_CLIENT_ID':
                return __("To make Microsoft Live login work, you&#39;ll need an App/Client ID. More information <a target='blank' class='rm_help_link' href='https://msdn.microsoft.com/en-in/library/bb676626.aspx'>here</a>.", 'registrationmagic-gold');

            case 'FD_LABEL_ADD_NEW':
                return __("Add New", 'registrationmagic-gold');

            case 'FD_LABEL_SWITCH_FORM':
                return __("Switch Form", 'registrationmagic-gold');

            case 'FD_LABEL_PERMALINK':
                return __("Permalink", 'registrationmagic-gold');

            case 'FD_MSG_HOW_FORM_DOING':
                return __("How's your form <b>doing?</b>", 'registrationmagic-gold');

            case 'LABEL_INBOX':
                return __("Inbox", 'registrationmagic-gold');

            case 'FD_LABEL_NOT_INSTALLED':
                return __("Not Installed", 'registrationmagic-gold');

            case 'FD_MSG_LOOK_AND_FEEL':
                return __("<b>Look and Feel</b> of your form", 'registrationmagic-gold');

            case 'FD_LABEL_DESIGN':
                return __("Design", 'registrationmagic-gold');

            case 'FD_LABEL_FORM_FIELDS':
                return __("Fields Manager", 'registrationmagic-gold');

            case 'FD_THINGS_CAN_DO_WITH_FORM':
                return __("<b>Things you can do</b> with form data", 'registrationmagic-gold');

            case 'FD_FINE_TUNE_FORM':
                return __("<b>Fine Tune</b> Your Form", 'registrationmagic-gold');

            case 'FD_LABEL_LIMITED':
                return __("Limited", 'registrationmagic-gold');

            case 'LABEL_F_OVERRIDES_SETT':
                return __("Global Overrides", 'registrationmagic-gold');

            case 'FD_MULTISTEP_FORM':
                return __("Multi-Step Forms", 'registrationmagic-gold');

            case 'FD_LABEL_COMINGSOON':
                return __("Coming Soon", 'registrationmagic-gold');

            case 'FD_ADD_APPS_TO_FORM':
                return __("<b>Add Apps</b> To Your Form", 'registrationmagic-gold');

            case 'NAME_CONSTANT_CONTACT':
                return __("Constant Contact", 'registrationmagic-gold');

            case 'NAME_WOOCOMMERCE':
                return __("WooCommerce", 'registrationmagic-gold');

            case 'FD_BADGE_NEW':
                return __("New", 'registrationmagic-gold');

            case 'FD_LABEL_VIEW_ALL':
                return __("View All", 'registrationmagic-gold');

            case 'FD_LABEL_FORM_SHORTCODE':
                return __("Shortcode", 'registrationmagic-gold');

            case 'FD_LABEL_COPY':
                return __("Copy", 'registrationmagic-gold');

            case 'FD_LABEL_FORM_VISIBILITY':
                return __("Visibility", 'registrationmagic-gold');

            case 'FD_LABEL_FORM_CREATED_ON':
                return __("Created On", 'registrationmagic-gold');

            case 'FD_FORM_PAGES':
                return __("Pages", 'registrationmagic-gold');

            case 'FD_FORM_SUBMIT_BTN_LABEL':
                return __("Submit Label", 'registrationmagic-gold');

            case 'FD_LABEL_VISITORS':
                return __("Visitors", 'registrationmagic-gold');

            case 'FD_DOWNLOAD_REGISTRATIONS':
                return __("Download Records", 'registrationmagic-gold');

            case 'FD_AVG_TIME':
                return __("Avg. Time", 'registrationmagic-gold');

            case 'FD_AUTORESPONDER':
                return __("Auto-Responder", 'registrationmagic-gold');

            case 'FD_WP_REG':
                return __("WP Registrations", 'registrationmagic-gold');

            case 'FD_LABEL_REDIRECTION':
                return __("Redirection", 'registrationmagic-gold');

            case 'FD_LABEL_AUTO_APPROVAL':
                return __("Auto Approval", 'registrationmagic-gold');

            case 'FD_ISSUE_SUB_TOKEN':
                return __("Issue Token No", 'registrationmagic-gold');

            case 'NAME_RECAPTCHA':
                return __("reCAPTCHA", 'registrationmagic-gold');

            case 'FD_FORM_TOGGLE_PH':
                return __("Select a Form", 'registrationmagic-gold');

            case 'FD_LABEL_STATS':
                return __("Stats", 'registrationmagic-gold');

            case 'FD_LABEL_STATUS':
                return __("Status", 'registrationmagic-gold');

            case 'FD_LABEL_CONTENT':
                return __("Content", 'registrationmagic-gold');

            case 'FD_LABEL_QCK_TOGGLE':
                return __("Quick Toggles", 'registrationmagic-gold');

            case 'FD_LABEL_PUBLIC':
                return __("Public", 'registrationmagic-gold');

            case 'FD_LABEL_RESTRICTED':
                return __("Limited", 'registrationmagic-gold');
            case 'LABEL_LOGIN_TWITTER_OPTION':
                return __('Allow User to Login using Twitter:', 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_TWITTER_ENABLE':
                return __("A login using Twitter button will appear alongside the login form.", 'registrationmagic-gold');

            case 'LABEL_TW_CONSUMER_KEY':
                return __("Twitter Consumer Key", 'registrationmagic-gold');

            case 'LABEL_TW_CONSUMER_SEC':
                return __("Twitter Consumer Secret", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_TW_CONSUMER_KEY':
                return __("To make Twitter login work, you&#39;ll need a Client ID. More information <a target='blank' class='rm_help_link' href='https://apps.twitter.com/'>here</a>.", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_TW_CONSUMER_SEC':
                return __("To make Twitter login work, you&#39;ll need a Client ID. More information <a target='blank' class='rm_help_link' href='https://apps.twitter.com/'>here</a>.", 'registrationmagic-gold');


            case 'LABEL_LOGIN_INSTAGRAM_OPTION':
                return __('Allow User to Login using Instagram', 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_INSTAGRAM_ENABLE':
                return __("A login using Instagram button will appear alongside the login form.", 'registrationmagic-gold');

            case 'LABEL_INS_CLIENT_ID':
                return __("Instagram App/Client ID", 'registrationmagic-gold');

            case 'HELP_OPTIONS_THIRDPARTY_INS_CLIENT_ID':
                return __("To make Instagram login work, you&#39;ll need a Client ID. More information <a target='blank' class='rm_help_link' href='https://www.instagram.com/developer/authentication/'>here</a>.", 'registrationmagic-gold');

            case 'LABEL_MARK_ALL_READ':
                return __("Mark all read", 'registrationmagic-gold');

            case 'LABEL_ADD_DEFAULT_FORM':
                return __("Add Default Form", 'registrationmagic-gold');

            case 'LABEL_CHANGE_DEFAULT_FORM':
                return __("Change Default Form", 'registrationmagic-gold');

            case 'LABEL_SUBS_OVER_TIME':
                return __("Submissions over time", 'registrationmagic-gold');

            case 'STAT_TIME_RANGES':
                return __("Last %d days", 'registrationmagic-gold');

            case 'LABEL_SELECT_TIMERANGE':
                return __("Show data for", 'registrationmagic-gold');

            case 'LABEL_F_GLOBAL_OVERRIDE_SETT':
                return __("Global Overrides", 'registrationmagic-gold');

            case 'MSG_NO_SUBMISSION_FD':
                return __('No Submissions for this form yet.<br>Once submissions start coming, this area will show the latest submissions.', 'registrationmagic-gold');

            case 'FD_LABEL_F_FIELDS':
                return __('Fields', 'registrationmagic-gold');

            case 'MSG_NO_REGISTERED_USERS':
                return __('No Users are registered yet.', 'registrationmagic-gold');

            case 'TITLE_SENT_EMAILS_MANAGER':
                return __('Sent Emails', 'registrationmagic-gold');

            case 'MSG_NO_SENT_EMAILS_MAN':
                return __('No sent emails yet.', 'registrationmagic-gold');

            case 'MSG_NO_SENT_EMAILS_USER':
                return __('No email has been sent to this user yet.', 'registrationmagic-gold');

            case 'LABEL_EMAIL_TO':
                return __('To', 'registrationmagic-gold');

            case 'LABEL_EMAIL_SUB':
                return __('Subject', 'registrationmagic-gold');

            case 'LABEL_EMAIL_BODY':
                return __('Content', 'registrationmagic-gold');

            case 'LABEL_EMAIL_SENT_ON':
                return __('Sent on', 'registrationmagic-gold');

            case 'ADMIN_MENU_SENT_MAILS':
                return __('Sent Emails', 'registrationmagic-gold');

            case 'LABEL_SENT_EMAILS':
                return __('Sent Emails', 'registrationmagic-gold');

            case 'MSG_INVALID_SENT_EMAIL_ID':
                return __('Invalid sent email id', 'registrationmagic-gold');

            case 'SEND_MAIL':
                return __('Send a new email', 'registrationmagic-gold');

            case 'GLOBAL_OVERRIDES_NOTE':
                return __('Global Overrides provide an easy way for power users to override default Global Settings on individual forms. Once you have turned on the override, corresponding Global Setting values will have no effect on this form. ', 'registrationmagic-gold');

            case 'EMBED_CODE':
                return __("Embed Code", 'registrationmagic-gold');

            case 'FD_TOGGLE_TOOLTIP':
                return __("To toggle this setting you need to configure it first. <a href='%s'>Click here </a>to configure now.</span>", 'registrationmagic-gold');

            case 'DASHBOARD_WIDGET_TABLE_CAPTION':
                return __("Latest Submissions", 'registrationmagic-gold');

            case 'LABEL_CUSTOM_FILTERS':
                return __('Custom filters', 'registrationmagic-gold');

            case 'SAVE_SEARCH':
                return __('Save search as filter', 'registrationmagic-gold');

            case 'MSG_NO_SENT_EMAIL_USER':
                return __('No email sent yet', 'registrationmagic-gold');

            case 'RM_SOCIAL_ERR_ACC_UNAPPROVED':
                return __("Please wait for Admin's approval before you can log in.", 'registrationmagic-gold');

            case 'RM_SOCIAL_ERR_NEW_ACC_UNAPPROVED':
                return __("Account has been created. Please wait for Admin's approval before you can log in.", 'registrationmagic-gold');

            case 'MSG_NO_SENT_EMAIL_MATCHED':
                return __('No sent email matched your search.', 'registrationmagic-gold');

            case 'MSG_NO_SENT_EMAIL_INTERVAL':
                return __('No email sent during the period.', 'registrationmagic-gold');

            case 'MSG_SUB_EDITED_BY' :
                return __('Submission edited by <b>%s</b> on <em>%s</em>', 'registrationmagic-gold');

            case 'MSG_ERR_USER_ACCOUNT_NOT_ACTIVATED':
                return __('Account has not been activated yet', 'registrationmagic-gold');

            case 'RM_SUB_LEFT_CAPTION' :
                return __('%s submission slots remain', 'registrationmagic-gold');

            case 'LABEL_TOUR' :
                return __('Tour', 'registrationmagic-gold');

            case 'INVALID_MAXLEN' :
                return __('Please enter no more than {0} characters.', 'registrationmagic-gold');

            case 'INVALID_MINLEN' :
                return __('Please enter at least {0} characters.', 'registrationmagic-gold');

            case 'INVALID_MAX' :
                return __('Please enter a value less than or equal to {0}.', 'registrationmagic-gold');

            case 'INVALID_MIN' :
                return __('Please enter a value greater than or equal to {0}', 'registrationmagic-gold');

            case 'LABEL_PREV_FORM_PAGE':
                return __('Prev', 'registrationmagic-gold');

            case 'LABEL_ENABLE_INCLUDE_PDF':
                return __('Attach submission as pdf with email', 'registrationmagic-gold');

            case 'HELP_OPTIONS_ARESP_INCLUDE_PDF':
                return __('A pdf copy of data submitted by user will be included with email.', 'registrationmagic-gold');

            case 'LABEL_AFTER_LOGOUT_URL' :
                return __('After logout redirect user to:', 'registrationmagic-gold');

            case 'HELP_OPTIONS_POST_LOGOUT_REDIR' :
                return __('User will be redirected to this page after logging out.', 'registrationmagic-gold');

            case 'EXPIRY_DETAIL_BOTH' :
                return __('%1$d out of %2$d filled and %3$d days to go', 'registrationmagic-gold');

            case 'EXPIRY_DETAIL_SUBS' :
                return __('%1$d out of %2$d filled', 'registrationmagic-gold');

            case 'EXPIRY_DETAIL_DATE' :
                return __('%d days to go', 'registrationmagic-gold');

            case 'LABEL_PAYPAL_TRANSACTION_LOG' :
                return __('Transaction log', 'registrationmagic-gold');

            case 'LABEL_GENDER_MALE' :
                return __('Male', 'registrationmagic-gold');

            case 'LABEL_GENDER_FEMALE' :
                return __('Female', 'registrationmagic-gold');

            case 'LABEL_LEGEND' :
                return __('Legend', 'registrationmagic-gold');

            case 'LABEL_LEGEND_PAYMENT_PENDING' :
                return __('Payment Pending', 'registrationmagic-gold');

            case 'LABEL_LEGEND_PAYMENT_COMPLETED' :
                return __('Payment Completed', 'registrationmagic-gold');

            case 'LABEL_LEGEND_USER_BLOCKED' :
                return __('User Blocked', 'registrationmagic-gold');

            case 'LABEL_LEGEND_NOTES' :
                return __('Has Notes', 'registrationmagic-gold');

            case 'LABEL_LEGEND_MESSAGE' :
                return __('Messaged', 'registrationmagic-gold');

            case 'LABEL_LEGEND_ATTACHMENT' :
                return __('Has Attachment(s)', 'registrationmagic-gold');

            case 'FE_FORM_TOTAL_PRICE' :
                return __('Total Price: %s', 'registrationmagic-gold');

            case 'LABEL_SHOW_TOTAL_PRICE' :
                return __('Show total price on the form', 'registrationmagic-gold');

            case 'HELP_SHOW_TOTAL_PRICE' :
                return __('Enables a real-time display of total amount when you have multiple products added to the form.', 'registrationmagic-gold');

            case 'LABEL_DATE_FORMAT' :
                return __('Date format', 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_DATEFORMAT' :
                return __('For a list of supported types please click <a %s>here</a>.', 'registrationmagic-gold');

            case 'LABEL_NEW_USER_EMAIL' :
                return __('New User Email Body', 'registrationmagic-gold');

            case 'HELP_ADD_FORM_NU_EMAIL_MSG' :
                return __("Content of the email to be sent to the newly created user. You can use rich text and values the user submitted in the form for a more personalized message.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_USER_ACTIVATED_MSG' :
                return __("Content of the email to be sent to the activated user. You can use rich text and values the user submitted in the form for a more personalized message.", 'registrationmagic-gold');

            case 'HELP_ADD_FORM_ACTIVATE_USER_MSG' :
                return __("Content of the email to be sent to admin with activation link. You can use rich text and values the user submitted in the form for a more personalized message.", 'registrationmagic-gold');

            case 'LABEL_USER_ACTIVATION_EMAIL' :
                return __('User Activation Email Body', 'registrationmagic-gold');

            case 'LABEL_ACTIVATE_USER_EMAIL' :
                return __('Active User Email Body (To Admin)', 'registrationmagic-gold');

            case 'LABEL_ADMIN_NEW_SUBMISSION_EMAIL' :
                return __('New Submission Email Body (To Admin)', 'registrationmagic-gold');

            case 'HELP_ADD_FORM_ADMIN_NS_MSG' :
                return __("Content of the email to be sent to admin on new submission. You can use rich text and values the user submitted in the form for a more personalized message.", 'registrationmagic-gold');

            case 'LABEL_F_EMAIL_TEMPLATES_SETT':
                return __("Email Templates", 'registrationmagic-gold');

            case 'HELP_FOPTIONS_ARESP_ADMIN_NOTIFS':
                return __("An email notification will be sent to recipients of this form for every submission.", 'registrationmagic-gold');

            case 'LABEL_FORM_NOTIFS_TO':
                return __('Send Notification To:', 'registrationmagic-gold');

            case 'LABEL_ALLOW_QUANTITY' :
                return __('Allow user to specify quantity', 'registrationmagic-gold');

            case 'HELP_PRICE_FIELD_ALLOW_QUANTITY' :
                return __('User will be able to purchase more than one item.', 'registrationmagic-gold');

            case 'LABEL_ANET_LOGIN_ID' :
                return __('Authorize.Net Login ID', 'registrationmagic-gold');

            case 'LABEL_ANET_TRANSACTION_KEY' :
                return __('Authorize.Net Transaction Key', 'registrationmagic-gold');

            case 'LABEL_ANET_HASH_KEY' :
                return __('Authorize.Net MD5 Hash Key', 'registrationmagic-gold');

            case 'HELP_OPTIONS_ANET_LOGIN_ID' :
                return __('This identifies your account to the payment gateway when submitting transaction requests from your website. The API Login ID is at least eight characters in length, includes uppercase and lowercase letters, numbers, and/or symbols.', 'registrationmagic-gold');

            case 'HELP_OPTIONS_ANET_TRANS_KEY' :
                return __('This is a 16-character alphanumeric value that is randomly generated in the Merchant Interface and is used as an additional layer of authentication when submitting transaction requests from your website.', 'registrationmagic-gold');

            case 'HELP_OPTIONS_ANET_HASH_KEY' :
                return __('Key for encrypting information to make it unreadable but unique to a given transaction', 'registrationmagic-gold');

            case 'HELP_OPTIONS_ANET_TESTMODE' :
                return __('This will put Authorize.Net payments on test mode.', 'registrationmagic-gold');

            case 'LABEL_INVOICE_SHORT':
                return __('Invoice', 'registrationmagic-gold');

            case 'LABEL_PENDING_OFFLINE_PAYMENTS':
                return __('Pending Offline Payments', 'registrationmagic-gold');

            case 'LABEL_LEGEND_PAYMENT_CANCELED' :
                return __('Payment Canceled', 'registrationmagic-gold');

            case 'LABEL_LEGEND_PAYMENT_REFUNDED' :
                return __('Payment Refunded', 'registrationmagic-gold');

            case 'LABEL_PAYMENT_DETAILS' :
                return __('Payment Details', 'registrationmagic-gold');

            case 'LABEL_FORM_SUB_ERROR_HEADER' :
                return __('Following error(s) were found:', 'registrationmagic-gold');

            case 'HELP_NOTE_ADD_NOTE_TEXT':
                return __('Text for your note.', 'registrationmagic-gold');

            case 'HELP_NOTE_ADD_NOTE_COLOR':
                return __('Color code to identify your note. You can use same color for specific type of notes to make identification easier.', 'registrationmagic-gold');


            case 'HELP_NOTE_ADD_IS_VISIBLE':
                return __('The note will also appear under this submission on user end. If configured, a notification email will be sent to the user stating that a new note has been added to their submission. It can be used for submission specific comments and notes you wish to share with this user. Please remember, for non submission specific communication, use "Send a New Email" on User Profile page (accessible from User Manager >> View). All outgoing messages are stored in RegistrationMagic Outbox.', 'registrationmagic-gold');

            case 'LABEL_F_EMAIL_TEMP_SETT':
                return __('Email Templates', 'registrationmagic-gold');

            case 'ADMIN_MENU_FS_ET_PT':
                return __('Email Templates', 'registrationmagic-gold');

            case 'LABEL_NO_MSG_USER_INBOX':
                return __('You have not received any messages from the admin yet', 'registrationmagic-gold');

            case 'MSG_USER_ROLE_NOT_ASSIGNED':
                return __("No role assigned", 'registrationmagic-gold');

            case 'LABEL_DEMO':
                return __("Demo", 'registrationmagic-gold');

            case 'CRON_DISABLED_WARNING_INVITATION':
                return __('Wordpress cron is disabled. This feature will not work. <a target="__blank" href="https://codex.wordpress.org/Editing_wp-config.php#Disable_Cron_and_Cron_Timeout">More info.</a>', 'registrationmagic-gold');

            case 'LABEL_FIELD_SAVE':
                return __("Add to Form", 'registrationmagic-gold');

            case 'LABEL_SELECT_PRICING_TYPE':
                return __('Select Product Pricing Type', 'registrationmagic-gold');

            case 'LABEL_PRODUCT_NAME':
                return __('Product Name', 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_IS_UNIQUE':
                return __("Mark this field as unique. No two users can submit same value for this field. Any subsequent attempt for submission with duplicate value with show a message.", 'registrationmagic-gold');

            case 'LABEL_IS_UNIQUE':
                return __('Is Unique', 'registrationmagic-gold');

            case 'ERROR_UNIQUE':
                return __('should be unique.', 'registrationmagic-gold');

            case 'HELP_UN_ERR_MSG':
                return __('The content of the message that user will see while attempting to submit duplicate value for this field.', 'registrationmagic-gold');

            case 'LABEL_SUB_LIMIT_IND_USER':
                return __('Form submission limit for a user', 'registrationmagic-gold');

            case 'HELP_SUB_LIMIT_IND_USER':
                return __('Limits how many times a form can be submitted by same user. Set it to zero(0) to disable this feature.', 'registrationmagic-gold');

            case 'ERR_SUB_LIMIT_USER':
                return __('Submission limit reached for this user.', 'registrationmagic-gold');

            case 'LABEL_TOGGLE_FORM':
                return __('Toggle Form &rarr;', 'registrationmagic-gold');

            case 'HELP_SHOW_ON_FORM':
                return __("Display price on the form while user fills it. If turned off, user will be directly taken to checkout.", 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_ALLOW_MULTILINE':
                return __("Display textarea instead of textbox which allows for multiline input.", 'registrationmagic-gold');

            case 'LABEL_META_TITLE':
                return __('User meta title', 'registrationmagic-gold');

            case 'HINT_MULTISELECT_FIELD':
                return __('Press ctrl or &#8984; (in Mac) while clicking to select multiple options.', 'registrationmagic-gold');

            case 'FIELD_HELP_TEXT_Hidden':
                return __('Standard hidden type html field.', 'registrationmagic-gold');

            case 'FIELD_TYPE_HIDDEN':
                return __('Hidden Field', 'registrationmagic-gold');

            case 'ADV_FIELD_SETTINGS':
                return __('Advanced Settings', 'registrationmagic-gold');

            case 'ICON_FIELD_SETTINGS':
                return __('ICON Settings', 'registrationmagic-gold');

            case 'LABEL_RATING_MAX_STARS':
                return __('Number of Rating Icons', 'registrationmagic-gold');

            case 'LABEL_RATING_STAR_FACE':
                return __('Rating Icon', 'registrationmagic-gold');

            case 'LABEL_RATING_STAR_COLOR':
                return __('Selected Icon color', 'registrationmagic-gold');

            case 'LABEL_RATING_STEP_SIZE':
                return __('Rating Steps', 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_RATING_MAX_STARS':
                return __('Define the total number of rating icons visible to the user.', 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_RATING_STAR_FACE':
                return __('Select the rating icon to be displayed in your form for this field.', 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_RATING_STAR_COLOR':
                return __('Define the color of the selected rating icon. This will also appear when user hovers cursor above icons allowing them to select a rating. Unselected icons will appear gray.', 'registrationmagic-gold');

            case 'HELP_ADD_FIELD_RATING_STEP_SIZE':
                return __('Define the steps user can jump while increasing rating. 1 means user can only select complete icons, resulting in whole number rating value. 0.5 means users can increase ratings by half-steps allowing them fractional ratings too, for example 4.5/5.', 'registrationmagic-gold');

                
            case 'LABEL_ADD_CONDITION':
                return __ ('Conditions', 'registrationmagic-gold');
                
            case 'LABEL_CONDITIONS':
                return __ ('Conditional Logic', 'registrationmagic-gold');
            
            case 'LABEL_CONTROLLING_FIELD':
                return __("Controlling Field", 'registrationmagic-gold'); 
            case 'LABEL_OPERATOR':
                return __("Operator", 'registrationmagic-gold');
            case 'LABEL_HIDE_PREV_FIELDMAN':
                return __('Hide "Previous" button', 'registrationmagic-gold');

            case 'TITLE_FORMFLOW_CONFIG_PAGE':
                return __('Configuration Manager', 'registrationmagic-gold');
            
            case 'LABEL_FORMCARD_LINK_SETUP':
                return __('Fields', 'registrationmagic-gold');
            
            case 'FD_SEC_1_TITLE':
                return __('Build', 'registrationmagic-gold');
            
            case 'FD_SEC_2_TITLE':
                return __('Configure', 'registrationmagic-gold');
            
            case 'FD_SEC_3_TITLE':
                return __('Integrate', 'registrationmagic-gold');
            
            case 'FD_SEC_4_TITLE':
                return __('Publish', 'registrationmagic-gold');
            
            case 'FD_SEC_5_TITLE':
                return __('Manage', 'registrationmagic-gold');
            
            case 'FD_SEC_6_TITLE':
                return __('Analyze', 'registrationmagic-gold');
            
            case 'FD_SEC_7_TITLE':
                return __('Automate', 'registrationmagic-gold');
                
            case 'LABEL_FORMCARD_LINK_MANAGE':
                return __('Settings', 'registrationmagic-gold');
              
            case 'LABEL_META_ADD':
                 return __('Associated User Meta Key','registrationmagic-gold');
                
            case 'HELP_META_ADD':
                 return __('Define the WordPress User Meta key where values of this field will be stored. Field values will be pre-filled when the form is opened, if currently logged in user has submitted another form in the past with same meta-keys. Please note - Some complex type fields like address do not support pre-filling.','registrationmagic-gold');
            
            case 'LABEL_PUBLISH':
                return __("Publish", 'registrationmagic-gold');
                
            case 'LABEL_PUBLISH_SHORTCODE':
                return __("Shortcode", 'registrationmagic-gold');
                
            case 'LABEL_PUBLISH_HTML_CODE':
                return __("HTML Code", 'registrationmagic-gold');
                
            case 'LABEL_PUBLISH_FORM_WIDGET':
                return __("Form Widget", 'registrationmagic-gold');
                
            case 'LABEL_PUBLISH_USER_DIRECTORY':
                return __("User Directory", 'registrationmagic-gold');
                
            case 'LABEL_PUBLISH_USER_AREA':
                return __("User Area", 'registrationmagic-gold');
                
            case 'LABEL_PUBLISH_MAGIC_POPUP':
                return __("Magic PopUp", 'registrationmagic-gold');
                
            case 'LABEL_PUBLISH_LANDING_PAGE':
                return __("Landing Page", 'registrationmagic-gold');
                
            case 'LABEL_PUBLISH_LOGIN_BOX':
                return __("Login Box", 'registrationmagic-gold');
                
            case 'LABEL_PUBLISH_OTP_WIDGET':
                return __("OTP Login", 'registrationmagic-gold');               
            
            case 'LABEL_OUTBOX':
                return __("Outbox", 'registrationmagic-gold');
                
            case 'LABEL_REDIRECT_ADMIN_TO_DASH':
                return __("Always redirect admin users to dashboard", 'registrationmagic-gold');
                
            case 'HELP_OPTIONS_GEN_REDIRECT_ADMIN_TO_DASH':
                return __("If enabled, admin users will always be redirected to admin dashboard irrespective of page/url selected above", 'registrationmagic-gold');               
            
            case 'LABEL_POST_LOGIN_CUSTOM_URL':
                return __("URL", 'registrationmagic-gold');
                
            case 'LABEL_SELECT_COUNTRY':
                return __("--Select Country--", 'registrationmagic-gold');
            
            case 'ADMIN_MENU_ADD_WIDGET_PT':
                return __("Add Widget", 'registrationmagic-gold');
            
            case 'TITLE_P_WIDGET_PAGE':
                return __("Paragraph Widget", 'registrationmagic-gold');
                
            case 'TITLE_H_WIDGET_PAGE':
                return __("Heading Widget", 'registrationmagic-gold');  
                
            case 'TITLE_SP_WIDGET_PAGE':
                return __("Spacing Widget", 'registrationmagic-gold');  
                
            case 'TITLE_DI_WIDGET_PAGE':
                return __("Divider Widget", 'registrationmagic-gold'); 
                
            case 'WIDGET_TYPE_RICHTEXT':
                return __("Rich Text", 'registrationmagic-gold');    
            
            case 'TITLE_RT_WIDGET_PAGE':
                return __("Rich Text Widget", 'registrationmagic-gold');     
                 
            case 'LABEL_CONTENT':
                return __("Content", 'registrationmagic-gold');   
                
            case 'TITLE_TIMER_WIDGET_PAGE':
                return __("Timer Widget", 'registrationmagic-gold'); 
                
            case 'LABEL_MINUTES':  
                return __("Minutes", 'registrationmagic-gold'); 
                
            case 'LABEL_SECONDS':  
                return __("Seconds", 'registrationmagic-gold');     
            
            case 'WIDGET_TYPE_TIMER':
                return __("Timer", 'registrationmagic-gold'); 
                
            case 'LABEL_ADD_NEW_WIDGET':
                return __('Add Widget', 'registrationmagic-gold');
            
            case 'HELP_RT_CONTENT':
                return __('The text you want the user to see.', 'registrationmagic-gold');
                
            case 'FIELD_HELP_TEXT_RICHTEXT':
                return __('Allows you to display richly formatted text inside your form.', 'registrationmagic-gold');
            
            case 'HELP_ADD_WIDGET_LABEL':
                return __("MagicWidget labels do not appear on form. They only appear inside submissions and submission PDFs.", 'registrationmagic-gold');
                
             case 'HELP_ADD_WIDGET_LINK':
                return __("The clickable text that will be linked to specified URL or page.", 'registrationmagic-gold');
                 
            case 'WIDGET_TYPE_LINK':
                return __("Link", 'registrationmagic-gold');
                
            case 'FIELD_HELP_TEXT_LINK':
                return __("Display link inside your form.", 'registrationmagic-gold');
             
            case 'FIELD_HELP_TEXT_YOUTUBE':
                return __("Insert a YouTube Video in your form.", 'registrationmagic-gold');
                
            case 'FIELD_HELP_TEXT_TIMER':
                return __("Allows you to display richly formatted text inside your form.", 'registrationmagic-gold');
            
            case 'HELP_ADD_WIDGET_LINK':
                return __("Link help text", 'registrationmagic-gold');
                
            case 'LABEL_LINK_SAME_WINDOW':
                return __("Open in same window", 'registrationmagic-gold');
            
            case 'HELP_WIDGET_LINK_SW':
                return __("Opens link in same window.", 'registrationmagic-gold');
                
            case 'TITLE_LINK_WIDGET_PAGE':
                return __("Link Widget", 'registrationmagic-gold');
            
            case 'HELP_ADD_WIDGET_ANCHOR':
                return __("Dummy Text", 'registrationmagic-gold');
                
            case 'LABEL_ANCHOR_LINK':
                return __("Link", 'registrationmagic-gold');
                
            case 'LABEL_CHOOSE_PP':
                return __("Choose from Pages", 'registrationmagic-gold');
            
            case 'TITLE_YOUTUBE_WIDGET_PAGE':
                return __("YouTube Widget", 'registrationmagic-gold');
                
            case 'LABEL_VIDEO_URL':
                return __("Video URL", 'registrationmagic-gold');
                
            case 'LABEL_AUTO_PLAY':
                return __("Auto Play", 'registrationmagic-gold');
                
            case 'LABEL_REPEAT':
                return __("Repeat", 'registrationmagic-gold');
                
            case 'LABEL_RELATED_VIDEOS':
                return __("Related Videos", 'registrationmagic-gold');
            
            case 'IFRAME_LABEL_WIDTH':
                return __("Iframe Width", 'custom-registration-form-builder-with-submission-manager');
              case 'IFRAME_LABEL_HEIGHT':
                return __("Iframe Height", 'custom-registration-form-builder-with-submission-manager');
   
            case 'LABEL_WIDTH':
                return __("Player Width", 'registrationmagic-gold');
                
            case 'LABEL_HEIGHT':
                return __("Player Height", 'registrationmagic-gold');
                
            case 'TITLE_IF_WIDGET_PAGE':
                return __("Iframe Widget", 'registrationmagic-gold');
             
            case 'HELP_WI_VIDEO_URL':
                return __("URL of the YouTube Video you wish to add to your form. For example, https://www.youtube.com/watch?v=Eq9x-e3phHo",'registrationmagic-gold');
           
            case 'HELP_FIELD_YT_WIDTH':
                return __("Width of the YouTube Video. It can be set relative to the form in percentage (%) or in absolute pixels (px). For example, 100%, 50%, 350px etc.",'registration-gold');
            
            case 'HELP_FIELD_YT_HEIGHT':
                return __("Height of the YouTube Video. It can be set relative to the form in percentage (%) or in absolute pixels (px). For example, 100%, 50%, 350px etc.",'registration-gold');
               
            case 'HELP_WIDGET_YT_AUTOPLAY':  
               return __("Autoplays the video when the form first loads.",'registration-gold');
                
            case 'HELP_WIDGET_YT_REPEAT':
                return __("Loops the video after the first play through.",'registration-gold');

            case 'HELP_WIDGET_YT_RELATED':
                return __("Display a list of related videos after the video finishes. This will have no effect if you have turned on Repeat.",'registration-gold');

            case 'LABEL_ANCHOR_TEXT':
                return __("Anchor Text",'registration-gold');

            case 'HELP_ADD_WIDGET_URL':
                return __("Enter URL which you want to link to the anchor text.",'registration-gold');   
            
            case 'HELP_ADD_WIDGET_ANCHOR_LINK':
                return __("Link a page or a specific URL to the Anchor Text.",'registration-gold');
             
            case 'FIELD_HELP_TEXT_IFRAME':
                return __(" Display an external webpage inside your form, using HTML iframe.",'registration-gold');

            case 'HELP_ADD_WIDGET_PAGE':
                return __("Select page which you want to link to the anchor text.",'registration-gold');
            
            case 'HELP_IFRAME_URL':
                return __("Enter the URL of the page which you wish to render inside the iFrame.",'registration-gold');
            
            case 'HELP_FIELD_IF_WIDTH':
                return __("Width of the frame. It can be set relative to the form in percentage (%) or in absolute pixels (px). For example, 100%, 50%, 350px etc.",'registration-gold');
            
            case 'HELP_FIELD_IF_HEIGHT':
                return __("Height of the frame. It can be set in percentage (%) or in absolute pixels (px). For example, 100%, 50%, 400px etc.",'registration-gold');
            
            case 'HELP_ADD_FIELD_MULTI_LINE_TYPE':
                return __("Allows user to add extra text area boxes to the form for submitting different values. Useful where a field requires multiple user input values.",'registration-gold');
            
                default:
                return __('NO STRING FOUND', 'registrationmagic-gold');
        }
    }

}
