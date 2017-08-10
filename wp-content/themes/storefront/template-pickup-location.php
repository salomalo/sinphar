<?php
/**
 * The template for displaying pickup location pages.
 *
 * Template Name: Pickup Location
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area no-sidebar-container">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );

				// id, status, name, country, postcode, state, city, address_1, address_2, phone, latitude, longitude
				$locations = $wpdb->get_results('
					SELECT * FROM wp_woocommerce_pickup_locations_geodata WHERE 1
				');
				echo '<pre>';
				print_r($locations);
				echo '</pre>';

				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
