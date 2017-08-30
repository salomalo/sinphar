<?php

?>


<!--Text Fields -->

<ul class="rm-field-selector-view rm-dbfl">
    <div class="rm-field-tab-cat"> <?php //echo RM_UI_Strings::get("LABEL_COMMON_FIELDS");  ?>Text Fields</div>

    <li title="<?php //echo RM_UI_Strings::get("FIELD_HELP_TEXT_Textbox");  ?> Single Line" class="rm_button_like_links" onclick="add_new_field_to_page('Textbox')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE264;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php  echo RM_UI_Strings::get("FIELD_TYPE_TEXT");  ?></a>
        </div>
    </li> 

    <li title="<?php // echo RM_UI_Strings::get("FIELD_HELP_TEXT_Textarea");  ?>Multiple Line" class="rm_button_like_links" onclick="add_new_field_to_page('Textarea')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE264;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_TEXTAREA");  ?></a>
        </div>
    </li> 

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Repeatable"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Repeatable')"> 
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE264;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_REPEAT"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Repeatable"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Repeatable_M')"> 
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE264;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php //echo RM_UI_Strings::get("FIELD_TYPE_REPEAT"); ?>Repeatable Multi Line</a>
        </div>
    </li>
</ul> 


<!--End Text Fields -->

<!--Pre-Defined Options Fields -->


<ul class="rm-field-selector-view rm-dbfl">
    <div class="rm-field-tab-cat"><?php // echo RM_UI_Strings::get("LABEL_SPECIAL_FIELDS");  ?> Pre-Defined Options Fields</div>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Select"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Select')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE5C6;</i></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_DROPDOWN"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Checkbox"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Checkbox')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-check-square-o" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_CHECKBOX"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Radio"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Radio')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE837;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_RADIO"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Multi-Dropdown"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Multi-Dropdown')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_MULTI_DROP_DOWN"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Country"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Country')">   
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-globe" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_COUNTRY"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Timezone"); ?>"      class="rm_button_like_links" onclick="add_new_field_to_page('Timezone')"> 
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-globe" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_TIMEZONE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Language"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Language')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE894;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_LANGUAGE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Gender"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Gender')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-venus-mars" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_GENDER"); ?></a>
        </div>
    </li>
</ul>

<!--END Pre-Defined Options Fields -->

<!--Specialized Data Fields -->


                
<ul class="rm-field-selector-view rm-dbfl">
    <div class="rm-field-tab-cat"> <?php //echo RM_UI_Strings::get("LABEL_PROFILE_FIELDS");  ?>Specialized Data Fields</div>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_jQueryUIDate"); ?>"  class="rm_button_like_links" onclick="add_new_field_to_page('jQueryUIDate')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE916;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_DATE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Email"); ?>"         class="rm_button_like_links" onclick="add_new_field_to_page('Email')"> 
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE0BE;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_EMAIL"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Password"); ?>"      class="rm_button_like_links" onclick="add_new_field_to_page('Password')"> 
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE0DA;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_PASSWORD"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Number"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Number')"> 
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_NUMBER"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Terms"); ?>"         class="rm_button_like_links" onclick="add_new_field_to_page('Terms')">  
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-check-square-o" aria-hidden="true"></i></div> 
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_T_AND_C"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Map"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Map')">  
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE52E;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_MAP"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Address"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Address')"> 
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE0C8;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_ADDRESS"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Phone"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Phone')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE0CD;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_PHONE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Mobile"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Mobile')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-mobile" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_MOBILE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Bdate"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Bdate')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE916;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_BDATE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Time"); ?>"  class="rm_button_like_links" onclick="add_new_field_to_page('Time')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE192;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_TIME"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Shortcode"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Shortcode')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE86F;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_SHORTCODE"); ?></a>
        </div>
    </li>



    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Rating"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Rating')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-star" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_RATING"); ?></a>
        </div>
    </li>
</ul>

<!--END Specialized Data Fields -->

<!-- WordPress User-Meta Fields -->

<ul class="rm-field-selector-view rm-dbfl">
    <div class="rm-field-tab-cat"> <?php //echo RM_UI_Strings::get("LABEL_SOCIAL_FIELDS");  ?>WordPress User-Meta Fields</div>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Fname"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Fname')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-user" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_FNAME"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Lname"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Lname')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-user" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_LNAME"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Nickname"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Nickname')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-user" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_NICKNAME"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_BInfo"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('BInfo')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-user" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_BINFO"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_SecEmail"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('SecEmail')">    
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE0BE;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_SEMAIL"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Website"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Website')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE051;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_WEBSITE"); ?></a>
        </div>
    </li>
</ul>

<!--END WordPress User-Meta Fields -->

<!--SOCIAL FIELDS -->
                
<ul class="rm-field-selector-view rm-social-fields rm-dbfl">
    <div class="rm-field-tab-cat"> <?php echo RM_UI_Strings::get("LABEL_SOCIAL_FIELDS"); ?></div>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Facebook"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Facebook')">
        <div class="rm-difl rm-field-icon rm-field-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_FACEBOOK"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Twitter"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Twitter')">
        <div class="rm-difl rm-field-icon rm-field-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_TWITTER"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Google"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Google')">
        <div class="rm-difl rm-field-icon rm-field-google"><i class="fa fa-google-plus" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_GOOGLE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Instagram"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Instagram')">
        <div class="rm-difl rm-field-icon rm-field-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_INSTAGRAM"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Linked"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Linked')">
        <div class="rm-difl rm-field-icon rm-field-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_LINKED"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Youtube"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Youtube')">
        <div class="rm-difl rm-field-icon rm-field-youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_YOUTUBE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_VKontacte"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('VKontacte')">
        <div class="rm-difl rm-field-icon rm-field-vk"><i class="fa fa-vk" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_VKONTACTE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Skype"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Skype')">
        <div class="rm-difl rm-field-icon rm-field-skype"><i class="fa fa-skype" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_SKYPE"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_SoundCloud"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('SoundCloud')">
        <div class="rm-difl rm-field-icon rm-field-soundcloud"><i class="fa fa-soundcloud" aria-hidden="true"></i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_SOUNDCLOUD"); ?></a>
        </div>
    </li>
</ul>
<!--END SOCIAL FIELDS -->

<!--eCommerce Fields -->
<ul class="rm-field-selector-view rm-dbfl">
    <div class="rm-field-tab-cat"> <?php //echo RM_UI_Strings::get("LABEL_SOCIAL_FIELDS");  ?>eCommerce Fields</div>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Price"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Price')">   
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="fa fa-cart-plus" aria-hidden="true"></i></div> 
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_PRICE"); ?></a>
        </div>
    </li>
</ul>

<!--End eCommerce Fields -->

<!-- Advanced Fields -->

<ul class="rm-field-selector-view rm-dbfl">
    <div class="rm-field-tab-cat"> <?php //echo RM_UI_Strings::get("LABEL_SOCIAL_FIELDS");   ?>Advanced Fields</div>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Custom"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Custom')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE8EE;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_CUSTOM"); ?></a>
        </div>
    </li>

    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Hidden"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Hidden')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE8F5;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_HIDDEN"); ?></a>
        </div>
    </li>

</ul>
<!-- End Advanced Fields -->

<!-- File Upload Fields -->

<ul class="rm-field-selector-view rm-dbfl">
    <div class="rm-field-tab-cat"> <?php //echo RM_UI_Strings::get("LABEL_SOCIAL_FIELDS");    ?>File Upload Fields</div>


    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_File"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('File')">   
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE2C6;</i></div>  
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_FILE"); ?></a>
        </div>
    </li>


    <li title="<?php echo RM_UI_Strings::get("FIELD_HELP_TEXT_Image"); ?>" class="rm_button_like_links" onclick="add_new_field_to_page('Image')">
        <div class="rm-difl rm-field-icon rm-field-heading"><i class="material-icons">&#xE439;</i></div>
        <div class="rm-difl rm-field-head">
            <a href="javascript:void(0)"><?php echo RM_UI_Strings::get("FIELD_TYPE_IMAGE"); ?></a>
        </div>
    </li>

</ul>

<!-- End File Upload Fields -->



<script>
   
(function($){

  var colors = ['#71d0b1', '#6e8ecf', '#70afcf', '#717171', '#e9898a', '#fee292', '#c0deda', '#527471', '#cf6e8d', '#fda629', '#fd6d6f', '#8cafac', '#8fd072',]
   , colorsUsed = {}
   , $divsToColor = $('.rm-field-icon'),
   i=0;
   
 $divsToColor.each(function(){
    
   var $div = $(this);

   $div.css('backgroundColor', colors[i]);
     if( colorsUsed[randomColor] ){
         colorsUsed[randomColor]++;
     } else {
         colorsUsed[randomColor] = 1;
     }
     
   if(i >= 12){
       var $div = $(this)
     , randomColor = colors[ Math.floor( Math.random() * colors.length ) ];

   $div.css('backgroundColor', randomColor);
     if( colorsUsed[randomColor] ){
         colorsUsed[randomColor]++;
     } else {
         colorsUsed[randomColor] = 1;
     }
   }  

   i++;
 });



})(jQuery);  
   
</script>
