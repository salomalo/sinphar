<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storefront_footer' ); ?>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 	'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

<?php if( is_page( array( 'signup') )){ ?>
	<!-- if page is signup -->
	<script src="<?php echo get_template_directory_uri() . '/assets/js/tw-city-selector.min.js'; ?>"></script>
	<script type="text/javascript">
		// reference: https://github.com/dennykuo/tw-city-selector
		new TwCitySelector({
			el: ".tw-city-selector" // 同 DOM querySelector()
	  });

	  jQuery('.address-main-selector').parent().prepend( jQuery('.normal-select') );

	  jQuery('.normal-select select').prop('required',true);

	  jQuery('select').on('change', function (e) {
		    var countySelected = jQuery('select.county').find(":selected").val();
		    var districtSelected = jQuery('select.district').find(":selected").val();

				jQuery('input.address-main-selector').val( countySelected + districtSelected );
		});

		// 註冊頁面送出GA
    jQuery('#rm_next_form_page_button_4_1').click(function() {
        ga('send', 'event', 'signup', 'button');
    });

    // username 加上補充文字
		jQuery('.rmagic-form input[name="username"]').closest('.rminput').append('<span>請以英文或數字為主，如sinphar6</span>');
		jQuery('.rmagic-form input[name="username"]').attr('pattern', '[A-Za-z0-9\w]{4,20}');

    // phone 加上補充文字
		jQuery('.rmagic-form input[name="Phone_33"]').closest('.rminput').append('<span>請留手機或市話，市話請加區碼如：0227603688</span>');
	</script>
<?php } ?>

</body>
</html>
