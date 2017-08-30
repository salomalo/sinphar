<?php 
        $deactivate_reasons = array(
                        'feature_not_available'=> array(
                                'title' => '<span class="rm-feedback-emoji">&#x1f61e;</span>Doesn\'t have the feature I need',
				'input_placeholder' => 'Please let us know the missing feature...'),
                         'feature_not_working'=> array(
                                'title'=> '<span class="rm-feedback-emoji">&#x1f615;</span>One of the features didn\'t worked',
                                'input_placeholder'=>  'Please let us know the feature, like \'emails notifications\''   
                         ),           
			'found_a_better_plugin' => array(
				'title' => '<span class="rm-feedback-emoji">&#x1f60a;</span>Moved to a different plugin',
				'input_placeholder' => "Could you please share the plugin's name",
			),
                        'plugin_broke_site' => array(
				'title' => '<span class="rm-feedback-emoji">&#x1f621;</span>The plugin broke my site',
				'input_placeholder' => '',
			),
                        'plugin_stopped_working' => array(
				'title' => '<span class="rm-feedback-emoji">&#x1f620;</span>The plugin suddenly stopped working',
				'input_placeholder' => '',
			),
			'temporary_deactivation' => array(
				'title' => '<span class="rm-feedback-emoji">&#x1f60a;</span>It\'s a temporary deactivation',
				'input_placeholder' => '',
			),
			'other' => array(
				'title' => '<span class="rm-feedback-emoji">&#x1f610;</span>Other',
				'input_placeholder' => 'Please share the reason',
			),
	);
?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                
                var rmDeactivateLocation;
                // Shows feedback dialog     
                jQuery('#the-list').find( '[data-slug="registrationmagic-premium"] span.deactivate a' ).click(function(event){
                    jQuery("#rm-deactivate-feedback-dialog-wrapper, .rm-modal-overlay").show();
                    rmDeactivateLocation= jQuery(this).attr('href');
                    event.preventDefault();
                });
                
                jQuery("#rm-feedback-btn").click(function(){
                    var selectedVal= jQuery("input[name='rm_feedback_key']:checked").val();
                    if(selectedVal===undefined){
                        location.href= rmDeactivateLocation;
                        return;
                    }
                        
                    var feedbackInput= jQuery("input[name='reason_"+ selectedVal + "']");
                     var data = {
                        'action': 'rm_post_feedback',
                        'feedback': jQuery("input[name='rm_feedback_key']:checked").val(),
                        'msg': feedbackInput.val()
                        
                    };
                    jQuery(".rm-ajax-loader").show();
                    jQuery.post(ajaxurl, data, function (response) {
                         jQuery(".rm-ajax-loader").hide();
                         location.href= rmDeactivateLocation;  
                    });
                });
                
                jQuery("input[name='rm_feedback_key']").change(function(){
                  
                       var selectedVal= jQuery(this).val();
                       var reasonElement= jQuery("#reason_" + selectedVal);
                       jQuery(".rm-deactivate-feedback-dialog-input-wrapper .rminput").hide();
                       if(reasonElement!==undefined)
                       {
                         reasonElement.show();  
                       }
                });
                
                jQuery("#rm-feedback-cancel-btn").click(function(){
                    jQuery("#rm-deactivate-feedback-dialog-wrapper").hide();
                });
                
                jQuery(".rm-modal-close").click(function(){
                    jQuery(".rm-modal-view").hide();
                    
                });
                
                
                
            });
            
            
        </script>    
        <div class="rmagic rm-hide-version-number ">
            <div id="rm-deactivate-feedback-dialog-wrapper"  class="rm-modal-view" style="display:none; float:right">
                <div class="rm-modal-overlay"></div>
                <div  class="rm-modal-wrap rm-deactivate-feedback" >
                    
                     <div class="rm-modal-titlebar rm-new-form-popup-header">
                <div class="rm-modal-title">
                    RegistrationMagic Feedback
                </div>
                <span  class="rm-modal-close">&times;</span>
            </div>
                    <div class="rm-modal-container">
			<form id="rm-deactivate-feedback-dialog-form" method="post">
				<input type="hidden" name="action" value="rm_deactivate_feedback" />
                                <div class="rmrow">
				<div id="rm-deactivate-feedback-dialog-form-caption">If you have a moment, please share why you are deactivating RegistrationMagic:</div>
				<div id="rm-deactivate-feedback-dialog-form-body">
					<?php foreach ( $deactivate_reasons as $reason_key => $reason ) : ?>
						<div class="rm-deactivate-feedback-dialog-input-wrapper">
							<input id="rm-deactivate-feedback-<?php echo esc_attr( $reason_key ); ?>" class="rm-deactivate-feedback-dialog-input" type="radio" name="rm_feedback_key" value="<?php echo esc_attr( $reason_key ); ?>" />
							<label for="rm-deactivate-feedback-<?php echo esc_attr( $reason_key ); ?>" class="rm-deactivate-feedback-dialog-label"><?php echo $reason['title']; ?></label>
                                                        <?php if ( ! empty( $reason['input_placeholder'] ) ) : ?>
                                                                  <div class="rminput" id="reason_<?php echo esc_attr( $reason_key ); ?>" style="display:none" ><input class="rm-feedback-text" type="text" name="reason_<?php echo esc_attr( $reason_key ); ?>" placeholder="<?php echo esc_attr( $reason['input_placeholder'] ); ?>" /></div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
                                
                    </div>
                                <div class="rm-ajax-loader" style="display:none">
                              <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                <span class="sr-only">Loading...</span>
                                </div>
                                
                                <div class="rm-modal-footer rmrow">
                                <input type="button" id="rm-feedback-btn" value="Submit & Deactivate"/>
                                <input type="button" id="rm-feedback-cancel-btn" value="Cancel"/>
                                </div>
			</form>
                    </div>
		</div>
            </div>
        </div>