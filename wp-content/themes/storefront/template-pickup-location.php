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
	$conditions = 'pl.city = "' . $_GET['county'] . '"';
	$conditions .= empty($_GET['district']) ? '' : ' AND pl.address_1 LIKE "%' . $_GET['district'] . '%"';
	$queryString = 'SELECT pl.*, pm.meta_value AS `phone`, pt.post_content AS `description`
		FROM `' . $wpdb->base_prefix . 'woocommerce_pickup_locations_geodata` pl 
		INNER JOIN `' . $wpdb->base_prefix . 'postmeta` pm ON pm.post_id = pl.post_id AND pm.meta_key = "_pickup_location_phone" 
		INNER JOIN `' . $wpdb->base_prefix . 'posts` pt ON pt.id = pl.post_id 
		WHERE ' . $conditions;
	$queryString .= ' LIMIT ' . $limit . ' OFFSET ' . $offset;
	$locations = empty($_GET) ? array() : $wpdb->get_results($queryString);

	$totalQuery = 'SELECT COUNT(pl.post_id) AS `count` FROM `' . $wpdb->base_prefix . 'woocommerce_pickup_locations_geodata` pl WHERE ' . $conditions;
	$total = $wpdb->get_results($totalQuery);

	$google_map_api_key = 'AIzaSyCQYajdTcUkA69UT6MJ1tCRwHY4VJQcPz0';

	$isMobile = wp_is_mobile() ? true : false;
 ?>

	<div id="primary" class="content-area no-sidebar-container store-locator-container">
		<main id="main" class="site-main" role="main">
			<h3 class="subtitle">請輸入您希望查詢的杏輝專櫃門市區域：</h3>

			<?php while ( have_posts() ) : the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );

			 ?>
			<form method="GET">
				<?php
					$county = $_GET['county'];
					$district = $_GET['district'];
				?>
				<div
					role="tw-city-selector"
					class="tw-selector"
					data-selected-county="<?php echo $county; ?>"
					data-selected-district="<?php echo $district; ?>"
				>
				</div>
			<?php if (empty($locations)): ?>
				<input type="hidden" name="pages" value="1">
			<?php endif ?>
				<input type="submit" value="查詢">
			</form>

		<?php if (!empty($locations)): ?>
			<div class="store-table-title">
				<ul>
					<li>藥局名稱</li>
					<li>藥局編號</li>
					<li>電話</li>
					<li>地址</li>
					<li>地圖</li>
				</ul>
			</div>
			<div class="store-table-content">
				<?php foreach ($locations as $key => $local): ?>
				<ul>
					<li class="store-title"><?php echo $local->title; ?></li>
					<li class="store-number"><?php echo $local->description; ?></li>
					<li class="store-phone"><?php echo $local->phone; ?></li>
					<li class="store-address"><?php echo $local->address_1; ?></li>
					<li class="store-map">
					<?php if (empty($isMobile)): ?>
						<button onclick="openMap('<?php echo $local->city . $local->address_1; ?>')">MAP</button>
					<?php else: ?>
						<div class="mobile-map">
							<button class="mobile-map-on">MAP</button>
							<div class="mobile-map-iframe" data-local="<?php echo $local->city . $local->address_1; ?>"></div>
							<button style="display: none;" class="mobile-map-off">返回</button>
						</div>
					<?php endif ?>
					</li>
				</ul>
			<?php endforeach ?>
			</div>

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
	new TwCitySelector();

</script>
<?php if (empty($isMobile)): ?>
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
			$('.store-map').addClass('center');
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
			$('.store-map').removeClass('center');
			$(this).hide();
			$('.mobile-map-iframe').find('iframe').remove();
			$(this).closest('div.mobile-map').find('.mobile-map-on').show();
		});
	});
</script>
<?php endif ?>

<?php
get_footer();
