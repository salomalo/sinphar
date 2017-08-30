
<div class="rmwc_register_fields">
    <?php 
    $pages_with_error_fields = array();
    for ($i = 0; $i < $total_field_pages; $i++):
        ?>
        <h3>Section1</h3>
        <div class="rmwc_field_tab">
            <input type="hidden" name="rmstat" value="<?php echo $stat_id; ?>">
            <?php
            foreach ($fields as $field):
                $error_class = '';
                $field_options = $field->get_field_options();
                $validation_error = new WP_Error();
                $field->is_valid($field_options['value'], $form_id, $validation_error);
                // Page wise filtering of fields
                $page_number = $field->get_page_no();
                if ($page_number == $i + 1):
                    //Validating field in case of POST request
                    if ($_POST):
                        if (!empty($validation_error->errors)):
                            if (!in_array($i, $pages_with_error_fields))
                                $pages_with_error_fields[] = $i;
                            $error_class = 'rmwc_input_error';
                        endif;
                    endif;
                    echo '<script type="text/javascript">jQuery(document).ready(function(){';
                    $field->jquery_document_ready();
                    echo '}) </script>';
                    ?>
                     
                    <div class="rmrow <?php echo $error_class; ?>">
                        <label><?php echo $field->get_field_label(); ?>
                            <?php
                            if (isset($field_options['required']) && $field_options['required']):
                                ?>            
                                <span class="required">*</span>
                            <?php endif; ?>

                        </label>
                        <div class="rmfield" for="form_1_1-element-7" style="">
                            <?php $field->render(); ?>
                        </div>
                    </div>

                    <?php
                else:
                    continue;
                endif;
            endforeach;
            ?>
        </div>
    <?php endfor; ?>
</div>

<?php
// In case field input does not pass validation, Select an active accordion div
if (count($pages_with_error_fields) > 0):
    $active = 'active: ' . $pages_with_error_fields[0] . ',';
else:
    $active = '';
endif;
?>
<script>

    jQuery(document).ready(function () {
        jQuery(".rmwc_register_fields").accordion({<?php echo $active; ?>autoHeight: false, heightStyle: "content"});
    });
</script>   
