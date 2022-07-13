<section class="breadcrumbs-row">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="breadcrumbs-wrap">
                    <div class="breadcrumbs">
                        <?php echo apply_filters('mbl_breadcrumb_home', wpm_render_partial('breadcrumb-home', 'base', [], true)); ?>
                        <span class="separator"><span class="icon-angle-right"></span></span>
                        <?php if (is_cart()) : ?>
                            <a class="item" href="<?php echo wc_get_cart_url(); ?>" title="<?php echo wpm_get_option('mblp_texts.cart'); ?>">
                                <span class="iconmoon icon-shopping-cart"></span>
                                <?php echo wpm_get_option('mblp_texts.cart'); ?>
                            </a>
                        <?php elseif (is_checkout()) : ?>
                            <a class="item" href="<?php echo wc_get_cart_url(); ?>" title="<?php echo wpm_get_option('mblp_texts.cart'); ?>">
                                <span class="iconmoon icon-shopping-cart"></span>
                                <?php echo wpm_get_option('mblp_texts.cart'); ?>
                            </a>
                            <span class="separator"><span class="icon-angle-right"></span></span>
                            <span class="item" title="<?php echo wpm_get_option('mblp_texts.checkout', __('Оформление заказа', 'mbl_admin')); ?>">
                                <span class="iconmoon icon-credit-card"></span>
                                <?php echo wpm_get_option('mblp_texts.checkout'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>