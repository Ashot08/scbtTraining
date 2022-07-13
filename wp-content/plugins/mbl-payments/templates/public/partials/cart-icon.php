<?php if ( function_exists( 'WC' ) ) { ?>
    <?php $count = WC()->cart ? trim(WC()->cart->get_cart_contents_count()) : 0 ?>
    <?php $isActive = is_cart() || is_checkout(); ?>
    <div class="navbar-cart-inner <?php echo $isActive ? 'active' : ''; ?>">
        <a href="<?php echo wc_get_cart_url(); ?>" title="<?php echo wpm_get_option('mblp_texts.cart'); ?>" class="cart-contents">
            <span class="fa fa-shopping-cart"></span>
            <?php if ($count && !$isActive) : ?>
                <span class="cart-item-number"><?php echo $count; ?></span>
            <?php endif; ?>
        </a>
    </div>
<?php } ?>