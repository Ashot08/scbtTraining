<?php
defined( 'ABSPATH' ) || exit;
?>

<section class="clearfix mblp-row">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="lesson-tabs bordered-tabs white-tabs tabs-count-1">
                    <div class="tab-content empty-tab-content">
                        <p class="cart-empty"><?php esc_html_e( 'There are some issues with the items in your cart. Please go back to the cart page and resolve these issues before checking out.', 'woocommerce' ); ?></p>
                        <?php do_action( 'woocommerce_cart_has_errors' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<p class="return-to-shop">
    <a class="mbr-btn btn-default btn-solid btn-green text-uppercase cart-return-button" href="<?php echo esc_url( wc_get_page_permalink( 'cart' ) ); ?>">
        <?php esc_html_e( 'Return to cart', 'woocommerce' ); ?>
    </a>
</p>