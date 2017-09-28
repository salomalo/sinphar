<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<!-- theme-update.css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/assets/theme-update.css?v='.rand(); ?>">

<!-- GATC -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-107155896-1', 'auto');
  ga('send', 'pageview');
</script>

</head>

<body <?php body_class(); ?>>

<?php do_action( 'storefront_before_site' ); ?>

<script>
	// mobile menu
	jQuery(document).ready(function($){
		$('.menu-item-has-children').click(function(){
			$(this).find('.sub-menu').slideToggle('slow');
			$(this).toggleClass('active');
		});
	});
</script>

<div id="page" class="hfeed site <?php echo $post->post_name; ?>">
	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
		<div class="col-full">
			<div class="user-btns-group">
				<?php 
					if ( is_user_logged_in() ) {
				?>
					<a href="<?php echo esc_url( home_url( '/my-account' ) ); ?>">我的帳戶</a>
					<span> | </span>
					<a href="<?php echo wp_logout_url(); ?>">登出</a>
				<?php } else{ ?>
					<a href="<?php echo esc_url( home_url( '/my-account' ) ); ?>">會員登入</a>
					<span> | </span>	
					<a href="<?php echo esc_url( home_url( '/signup' ) ); ?>">註冊</a>
				<?php } ?>
			</div>
			<?php
			/**
			 * Functions hooked into storefront_header action
			 *
			 * @hooked storefront_skip_links                       - 0
			 * @hooked storefront_social_icons                     - 10
			 * @hooked storefront_site_branding                    - 20
			 * @hooked storefront_secondary_navigation             - 30
			 * @hooked storefront_product_search                   - 40
			 * @hooked storefront_primary_navigation_wrapper       - 42
			 * @hooked storefront_primary_navigation               - 50
			 * @hooked storefront_header_cart                      - 60
			 * @hooked storefront_primary_navigation_wrapper_close - 68
			 */
			do_action( 'storefront_header' ); ?>
		</div>
	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

		<?php
		/**
		 * Functions hooked in to storefront_content_top
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_content_top' );
