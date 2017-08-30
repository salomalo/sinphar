<?php
    $users= $data->users;
    if($users!=null && is_array($users)):
?>
<div class="rm_user_list" id="rm_user_list">
     <?php 
           foreach($users as $user):
     ?>
         <div class="rm-submission-field-row">
             <div class="rm-user-profile"><?php echo $user->profile; ?></div>
             <div class="rm-user-data">
                <div class="rm-user-label"><?php echo $user->display_name; ?></div>
                <div class="rm-user-value"><?php echo $user->user_email;   ?></div>
             </div>
         </div>
     <?php
           endforeach;  
     ?>         
 </div> 
<div id="rm-user-load-more" onclick="load_front_users('<?php echo $data->timerange; ?>',<?php echo $data->form_id; ?>)"> Load More </div>
<?php
         else:
             echo RM_UI_Strings::get("MSG_NO_REGISTERED_USERS");
   endif;
?>
