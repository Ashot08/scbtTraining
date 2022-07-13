<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
?>

<section class="clearfix mblp-row">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="lesson-tabs bordered-tabs white-tabs tabs-count-1">
                    <div class="tab-content empty-tab-content">
                        <p class="cart-empty"><?php echo wpm_get_option('mblp_texts.cart_empty'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<p class="return-to-shop">
		<?php mblp_render_partial('partials/return-button'); ?>
	</p>
<?php endif; ?>
