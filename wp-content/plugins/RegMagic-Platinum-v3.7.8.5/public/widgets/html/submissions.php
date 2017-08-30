<?php
foreach ($submissions as $index => $submission) {
    $submission_id= $submission->submission_id; 
    ?>
    <div class="rm-submission-card">
        <div class="rm-submission-card-title dbfl">
            <a href="<?php echo add_query_arg('submission_id', $submission_id, get_permalink(get_option('rm_option_front_sub_page_id'))); ?>" class="difl"><?php echo $submission->form_name; ?> </a>
            <span onclick="document.getElementById('rmsubmissionfrontform<?php echo $submission_id; ?>').submit()" class="difr"><i class="material-icons">&#xE2C0;</i></span>
        </div>
        <div class="rm-submission-card-content dbfl">
            <div class="rm-submission-details dbfl"><?php echo RM_UI_Strings::get('LABEL_SUBMITTED_ON'); ?> <?php echo $submission->submitted_on; ?></div>
            <div class="rm-submission-icon rm-submission-download difl">
               
            </div>
        </div>
        <form action="" id="rmsubmissionfrontform<?php echo $submission_id; ?>" method="post"> 
            <input type="hidden" value="<?php echo $submission_id; ?>" name="rm_submission_id">
            <input type="hidden" value="rm_submission_print_pdf" name="rm_slug">
        </form>
    </div>
<?php } ?>