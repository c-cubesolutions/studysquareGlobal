<?php
global $wgl_products_atts;

// Default settings for products item
if ( !(bool)$wgl_products_atts ) {

    global $wp_query;
    $wgl_products_atts = array(
        'query' => $wp_query,
        // General
        'products_layout' => 'grid',
        // Content
        'products_columns' => '4',
        'heading_tag' => 'h3',

    );
}

extract($wgl_products_atts);

$image_size = 'wgl-540-660';

if($products_columns === '12' || $products_layout === 'masonry'){
    $image_size = 'full';
}

global $wgl_query_vars;
if(!empty($wgl_query_vars)){
    $query = $wgl_query_vars;
}

// Allowed HTML render
$allowed_html = array(
    'a' => array(
        'href' => true,
        'title' => true,
    ),
    'br' => array(),
    'b' => array(),
    'em' => array(),
    'strong' => array()
); 

$products_styles = '';

$products_attr = !empty($products_styles) ? ' style="'.esc_attr($products_styles).'"' : '';
while ($query->have_posts()) : $query->the_post();          

    ob_start();
        wc_product_class('wgl_col-'.esc_attr($products_columns).' item');
    $product_class = ob_get_clean();
    
    echo '<li '.$product_class.'>';
    $single = new iGuru_Woocoommerce();
    ?>

    <div class="products-post"<?php echo iGuru_Theme_Helper::render_html($products_attr);?>>
        <div class="products-post_wrapper">

            <?php
                $single->woocommerce_template_loop_product_thumbnail($image_size, $aq_image = true );            
                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action( 'woocommerce_shop_loop_item_title', $image_size, $aq_image = true);

                /**
                 * Hook: woocommerce_after_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        </div>
    </div>
    <?php

    echo '</li>';

endwhile;
wp_reset_postdata();
