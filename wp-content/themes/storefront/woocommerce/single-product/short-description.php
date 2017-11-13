<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

?>

<div class="product-detail">
	<?php if ( get_post_type() == 'product' && !is_single() ){ ?>
	<?php
		global $woocommerce;
		$currency = get_woocommerce_currency_symbol();
		$price = get_post_meta( get_the_ID(), '_regular_price', true);
		$sale = get_post_meta( get_the_ID(), '_sale_price', true);
		$link = get_permalink( get_the_ID());
		
		$product_obj = wc_get_product( get_the_ID() );
    $stock_quantity = $product_obj->get_stock_quantity();

		get_post_type();
	?>
	
	<a href="<?php echo $link; ?>">
		<h2 class="woocommerce-loop-product__title"><?php echo $post->post_title ?></h2>
	</a>
	
	<?php if($sale) : ?>
		<p class="product-price-tickr"><del><?php echo $currency; echo $price; ?></del> <?php echo $currency; echo $sale; ?></p>    
	<?php elseif($price) : ?>
		<p class="product-price-tickr"><?php echo $currency; echo $price; ?></p>    
	<?php endif; ?>

	<div class="woocommerce-product-details__short-description">
	    <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
	</div>

<?php }else{?>
		<div class="woocommerce-product-details__short-description">
		    <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
		</div>
	</div>
<?php } ?>

<?php  if ( is_single() ){ ?>
	<a class="btn-blue" href="<?php echo get_site_url().'/store-locator/?country=臺北市&district=&zipcode=undefined&pages=1'?>">
		查詢杏輝專櫃門市
	</a>
<?php }else{ ?>
	<a class="btn-blue" href="<?php echo $link; ?>">
		閱讀更多
	</a>
<?php } ?>