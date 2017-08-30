<?php 



?>

 <div class="dbfl" id="rmwc-pu-cart-panel">
     <?php
    $i=1; //print_r($data->cart_items);
    foreach($data->cart_items as $item_id => $item)
    {
        ?>
        <div class="rmwc-cart-item" id="rmwc-cart-item-<?php echo $i;?>">
            <div class="rmwc-cart-item-detail-row">
                Product Name: <a href='<?php get_permalink($item['product_id']); ?>'>
                    <?php echo $item['data']->post->post_title; ?></a>
            </div>
            <div class="rmwc-cart-item-detail-row">
                Price: <?php echo $item['data']->price; ?>
            </div>
            <div class="rmwc-cart-item-detail-row">
                Quantity: <?php echo $item['quantity']; ?>
            </div>
            <div class="rmwc-cart-item-detail-row">
                Subtotal: <?php echo $item['line_subtotal']; ?>
            </div>
        <?php 
        /*echo "<a onclick=\"rmwc_remove_item($i,'{$item['remove_url']}')\" href='javascript:void(0)'>[X]</a> | ".
             "Product Id: ".$item['product_id']." | ".
             "Product Name: <a href='". get_permalink($item['product_id'])."'>".$item['data']->post->post_title."</a> | ".
             "Qty: ".$item['quantity']." | ".
             "Subtotal: ".$item['line_subtotal'].
             "<br/><br/>";
         */
        ?>
        </div>
        <?php   
        $i++;
    }
    
    if(count($data->cart_items)>0){
    echo "<br/>Total (excludes Final shipping and tax if any): ".$data->cart_total;
    echo "<br/><a href='$data->cart_url'> Checkout </a>";
    //echo "<br/>Checkout URL: ".wc_get_checkout_url() ;
    }
    
    ?>
                   
</div>


<?php

if(property_exists($data, 'ajax_request'))
        return;
?>
<script>
jQuery(document).ready(function(){
    
}); 

function rmwc_remove_item(index, url){
    var data = {url: url, complete: function(x,st){
            if(st == 'success')
             jQuery().remove();
        }, 
    }
    jQuery.post(data);
    
    
}

</script>