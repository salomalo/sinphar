<?php
/**
 * @internal Plugin Template File [For user forms]
 * 
 * This file renders the user made custom forms of the plugin on the front end
 * using the shortcode. * 
 */

RM_Utilities::enqueue_external_scripts('rm_date_sanitizer', RM_BASE_URL.'public/js/rm_date_sanitizer.js');

?>

<div class="rmagic">
<?php if(!isset($data->no_form_tag) || !$data->no_form_tag): ?>
    <form name="rm_fac" id="rm-fac" action="" method="post">   
<?php endif; ?>
        <input type="hidden" name="rm_fac_di_<?php echo $data->form_id; ?>" value="awesome">
        <input type="hidden" name="RM_CLEAR_ERROR" value='true'>
<?php if(isset($data->actrl->date)) { 
        
            if(isset($data->actrl->date->question) && trim($data->actrl->date->question))
                echo $data->actrl->date->question;
            else
                echo RM_UI_Strings::get('LABEL_ACTRL_DATE_QUESTION_DEF');
        
    ?>
        
        <div class="rm-fac-dob">
<!--            <input type="number" name="rm_fac_dday" min="1" max="31" required>-->
        <select name="rm_fac_dday" id="id_rm_fac_day_<?php echo $data->form_id; ?>" required>
        <?php for($i=1; $i<32; $i++)
            echo "<option value=".$i.">".$i."</option>";
        ?>
        </select>/
        <select name="rm_fac_dmonth" id="id_rm_fac_month_<?php echo $data->form_id; ?>" onchange="rm_sanitize_date_selector(<?php echo $data->form_id; ?>)" required>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>            
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>            
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>/
        
        <input type="number" id="id_rm_fac_year_<?php echo $data->form_id; ?>" onchange="rm_sanitize_date_selector(<?php echo $data->form_id; ?>)" name="rm_fac_dyear" min="1800" max="2100" placeholder="<?php echo RM_UI_Strings::get('LABEL_STRIPE_CARD_YEAR'); ?>" required>
        </div>
<?php } 
      if(isset($data->actrl->passphrase)) { 
          
          if(isset($data->actrl->passphrase->question) && trim($data->actrl->passphrase->question))
                echo $data->actrl->passphrase->question;
            else
                echo RM_UI_Strings::get('LABEL_ACTRL_PASS_QUESTION_DEF');
        
    ?>
        <div class="rm-fac-pass"><input type="text" name="rm_fac_pass" required></div>
<?php } ?>
        <button type='submit'><?php echo RM_UI_Strings::get('LABEL_ACTRL_BUTTON_CONT'); ?></button>
<?php if(!isset($data->no_form_tag) || !$data->no_form_tag): ?>
    </form>   
<?php endif; ?>
    
</div>
