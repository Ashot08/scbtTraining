<?php wpm_render_partial('head', 'base', array('post' => null)) ?>
<?php mblp_render_partial('partials/js'); ?>
<?php wpm_render_partial('navbar') ?>

<div class="site-content mblp-site-content">
    
    <?php wpm_render_partial('header-cover'); ?>
    <?php mkk_render_partial('partials/breadcrumbs'); ?>
    
    <?php if (wpm_get_option('mkk.show_section_name') != 'off') { ?>
        <section class="page-title-row">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1 class="page-title">
                            <?php echo wpm_get_option('mkk_texts.menu_name'); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <section class="clearfix">
        <div class="container">
            <div class="row shop-row">
                <?php
                    if (is_product_category()) {
                        $term = get_queried_object();
                        $term = $term->slug;
                    } else {
                        $term = get_terms('product_cat');
                        $term = wp_list_pluck($term, 'slug');
                    }
                    
                    $args = array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_visibility',
                                'field' => 'name',
                                'terms' => 'featured',
                            ),
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => $term
                            )
                        ),
                        'orderby' => 'menu_order',
                        'order' => 'ASC'
                    );
                    
                    $featured = new WP_Query($args);
                    
                    // Цикл
                    if ($featured->have_posts()) {
                        while ($featured->have_posts()) {
                            $featured->the_post();
                            $product_id = get_the_ID();
                            $_product = wc_get_product($product_id);
                            //echo '<pre>'; print_r($post); echo '</pre>';
                            $type = is_callable(array($_product, 'get_mbl_preview_type')) ? $_product->get_mbl_preview_type() : 'folder-with-files';
                            $cart_item_key = $product_id;
                            $name = (!wpm_option_is('mkk_design.product_content.disable_title', 'on') && is_callable(array($_product, 'getProductName'))) ? $_product->getProductName(true) : '';
                            
                            if($_product->has_access()) {
                                mkk_render_partial('single-product/product', 'public', ['_product' => $_product, 'type' => $type, 'cart_item_key' => $cart_item_key]);
                            }
                        }
                    } else {
                        ?>
                        <h3><?php _e('Нет рекомендуемых товаров', 'mbl_admin'); ?></h3>
                        <?php
                    }
                    
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

</div>


<?php wpm_render_partial('footer') ?>
<?php wpm_render_partial('footer-scripts') ?>