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
		FROM `' . $wpdb->base_prefix . 'woocommerce_pickup_locations_geodata` pl 
		INNER JOIN `' . $wpdb->base_prefix . 'postmeta` pm ON pm.post_id = pl.post_id AND pm.meta_key = "_pickup_location_phone"
		WHERE ' . $conditions;
	$queryString .= ' LIMIT ' . $limit . ' OFFSET ' . $offset;
	$locations = empty($_GET) ? array() : $wpdb->get_results($queryString);

	$totalQuery = 'SELECT COUNT(pl.post_id) AS `count` FROM `' . $wpdb->base_prefix . 'woocommerce_pickup_locations_geodata` pl WHERE ' . $conditions;
	$total = $wpdb->get_results($totalQuery);

	$google_map_api_key = 'AIzaSyAZeiklDV11AJeUgqzCYaNvqGMtCo7KlWQ';
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
					<td>
					<?php if (empty(wp_is_mobile())): ?>
						<button onclick="openMap('<?php echo $local->city . $local->address_1; ?>')">MAP</button>
					<?php else: ?>
						<div class="mobile-map">
							<button class="mobile-map-on">MAP</button>
							<div class="mobile-map-iframe" data-local="<?php echo $local->city . $local->address_1; ?>"></div>
							<button style="display: none;" class="mobile-map-off">返回</button>
						</div>
					<?php endif ?>
					</td>
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

			<div id="map-key" style="display: none;" data-key="<?php echo $google_map_api_key; ?>"></div>
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
<?php if (empty(wp_is_mobile())): ?>
<script type="text/javascript">
	var openMap = function(place) {
		window.open (
			'https://www.google.com/maps/embed/v1/place?key='
		  + document.getElementById('map-key').getAttribute('data-key')
		  + '&q=' + place, 
			'mywindow',
			'location=1,status=1,scrollbars=1, width=500,height=500'
		);
		return true;
	};
</script>
<?php else: ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.mobile-map-on').click(function() {
			$(this).hide();
			var iframeBlock = $(this).closest('div.mobile-map').find('.mobile-map-iframe');
			var src = 
				'https://www.google.com/maps/embed/v1/place?key='
			  + $('#map-key').data('key')
			  + '&q=' + iframeBlock.data('local');
			$('<iframe />', {
				src: src
			}).appendTo(iframeBlock);
			$(this).closest('div.mobile-map').find('.mobile-map-off').show();
		});
		$('.mobile-map-off').click(function() {
			$(this).hide();
			$('.mobile-map-iframe').find('iframe').remove();
			$(this).closest('div.mobile-map').find('.mobile-map-on').show();
		});
	});
</script>
<?php endif ?>

<?php
get_footer();
