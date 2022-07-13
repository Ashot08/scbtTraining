<section class="breadcrumbs-row">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="breadcrumbs-wrap">
                    <div class="breadcrumbs">
                        <?php echo apply_filters('mbl_breadcrumb_home', wpm_render_partial('breadcrumb-home', 'base', [], true)); ?>
                        
                        <?php if (is_cart()) : ?>
                            <span class="separator"><span class="icon-angle-right"></span></span>
                            <a class="item" href="<?php echo wc_get_cart_url(); ?>" title="<?php echo wpm_get_option('mblp_texts.cart'); ?>">
                                <span class="iconmoon icon-shopping-cart"></span>
                                <?php echo wpm_get_option('mblp_texts.cart'); ?>
                            </a>
                        <?php elseif (is_checkout()) : ?>
                            <span class="separator"><span class="icon-angle-right"></span></span>
                            <a class="item" href="<?php echo wc_get_cart_url(); ?>" title="<?php echo wpm_get_option('mblp_texts.cart'); ?>">
                                <span class="iconmoon icon-shopping-cart"></span>
                                <?php echo wpm_get_option('mblp_texts.cart'); ?>
                            </a>
                            <span class="separator"><span class="icon-angle-right"></span></span>
                            <span class="item" title="<?php echo wpm_get_option('mblp_texts.checkout', __('Оформление заказа', 'mbl_admin')); ?>">
                                <span class="iconmoon icon-credit-card"></span>
                                <?php echo wpm_get_option('mblp_texts.checkout'); ?>
                            </span>
						<?php elseif ( is_shop() && wpm_get_option('home_id') != get_option( 'woocommerce_shop_page_id' ) ) : ?>
                            <span class="separator"><span class="icon-angle-right"></span></span>
                            <a class="item" href="<?php echo wc_get_page_permalink( 'shop' ); ?>" title="<?php echo wpm_get_option('mkk_texts.menu_name'); ?>">
                                <span class="iconmoon icon-star"></span>
								<?php echo wpm_get_option('mkk_texts.menu_name'); ?>
                            </a>
						<?php elseif ( is_product_category() ) : ?>
                            <span class="separator"><span class="icon-angle-right"></span></span>
                            <?php if( wpm_get_option('home_id') != get_option( 'woocommerce_shop_page_id' ) ) {?>
                                <a class="item" href="<?php echo wc_get_page_permalink( 'shop' ); ?>" title="<?php echo wpm_get_option('mkk_texts.menu_name'); ?>">
                                    <span class="iconmoon icon-star"></span>
                                    <?php echo wpm_get_option('mkk_texts.menu_name'); ?>
                                </a>
                                <span class="separator"><span class="icon-angle-right"></span></span>
                            <?php } ?>
                            <span class="item" title="<?php echo get_queried_object()->name; ?>">
								<?php echo get_queried_object()->name; ?>
                            </span>
						<?php elseif (is_tax('wpm-levels')) : ?>
                            <span class="separator"><span class="icon-angle-right"></span></span>
                            <span class="item" title="<?php echo get_queried_object()->name; ?>">
								<?php echo get_queried_object()->name; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>