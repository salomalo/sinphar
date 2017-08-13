<?php
/**
 * The template for displaying pickup location pages.
 *
 * Template Name: Pickup Location
 *
 * @package storefront
 */

get_header(); ?>

<?php 
	$limit = 20;
	$offset = empty($_GET['pages']) ? 0 : ((int)$_GET['pages'] - 1) * $limit;
	$conditions = 'pl.city = "' . $_GET['country'] . '" AND pl.address_1 LIKE "%' . $_GET['district'] . '%"';
	$queryString = 'SELECT pl.*, pm.meta_value AS `phone`
		FROM `wp_woocommerce_pickup_locations_geodata` pl 
		INNER JOIN `wp_postmeta` pm ON pm.post_id = pl.post_id AND pm.meta_key = "_pickup_location_phone"
		WHERE ' . $conditions;
	$queryString .= ' LIMIT ' . $limit . ' OFFSET ' . $offset;
	$locations = empty($_GET) ? array() : $wpdb->get_results($queryString);

	$totalQuery = 'SELECT COUNT(pl.post_id) AS `count` FROM `wp_woocommerce_pickup_locations_geodata` pl WHERE ' . $conditions;
	$total = $wpdb->get_results($totalQuery);
 ?>

	<div id="primary" class="content-area no-sidebar-container">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );

			 ?>
			<form method="GET">
				<div class="tw-selector"></div>
			<?php if (empty($locations)): ?>
				<input type="hidden" name="pages" value="1">
			<?php endif ?>
				<input type="submit">
			</form>

		<?php if (!empty($locations)): ?>
			<table>
			<thead>
				<tr>
					<th>No</th>
					<th>藥局名稱</th>
					<th>藥局編號</th>
					<th>電話</th>
					<th>地址</th>
					<th>地圖</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($locations as $key => $local): ?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td><?php echo $local->title; ?></td>
					<td><?php echo '00'; ?></td>
					<td><?php echo $local->phone; ?></td>
					<td><?php echo $local->city . $local->address_1; ?></td>
					<td>lat: <?php echo $local->lat; ?> lon: <?php echo $local->lon; ?></td>
				</tr>
			<?php endforeach ?>
			</tbody>
			</table>

			<?php 
				$queryParams = array();
				foreach ($_GET as $field => $value) {
					if ($field != 'pages') {
						$queryParams[] = $field . '=' . $value;
					}
				}
				$queryParams = '?' . implode('&', $queryParams);
			 ?>

			<div id="page-selection" 
					data-currentPage="<?php echo $_GET['pages']; ?>"
					data-total="<?php echo $total[0]->count; ?>" 
					data-href="<?php echo $queryParams . '&pages='; ?>"></div>
		<?php endif ?>

			<?php
				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<script src="<?php echo get_template_directory_uri() . '/assets/js/jquery.bootpag.min.js'; ?>"></script>
<script src="<?php echo get_template_directory_uri() . '/assets/js/tw-city-selector.min.js'; ?>"></script>
<script type="text/javascript">
	// reference: http://botmonster.com/jquery-bootpag/#.WZBUu3cjF-U
	jQuery(document).ready(function($) {
		var total = $('#page-selection').data('total') / 20 + 1,
			href = $('#page-selection').data('href') + "{{number}}";
		$('#page-selection').bootpag({
			total: total,
			href: href
		}).on("page", function(event, /* page number here */ num){
			// $("#content").html("Insert content"); // some ajax content loading...
		});
	});

	// reference: https://github.com/dennykuo/tw-city-selector
	new TwCitySelector({
		el: ".tw-selector" // 同 DOM querySelector()
	});
</script>

<?php
get_footer();
