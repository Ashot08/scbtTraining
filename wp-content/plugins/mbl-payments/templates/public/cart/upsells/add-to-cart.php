<?php /** @var $product WC_Product_MBL */ ?>
<?php $args = $product->getAddToCartLinkAttrs() ?>

<?php
echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf( '<a href="%s" data-quantity="%s" class="mblp-add-to-cart %s" %s title="%s"><i class="iconmoon icon-plus mbr-btn btn-default btn-solid btn-green"></i> %s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $product->add_to_cart_text() ),
		esc_html( $product->getProductName() )
	),
$product, $args );