<style type="text/css">
    .top-nav-row .navbar-cart-inner a.cart-contents {
        color: #<?php echo wpm_get_option('mblp_design.cart.color', '868686'); ?>;
    }

    .top-nav-row .navbar-cart-inner.active a.cart-contents {
        color: #<?php echo wpm_get_option('mblp_design.cart.active_color', '2E2E2E'); ?>;
    }

    .top-nav-row .navbar-cart-inner a.cart-contents:hover {
        color: #<?php echo wpm_get_option('mblp_design.cart.hover_color', '2E2E2E'); ?>;
    }

    .top-nav-row .navbar-cart-inner .cart-item-number {
        background: #<?php echo wpm_get_option('mblp_design.cart.numbers_bg', 'DD3D31'); ?>;
        color: #<?php echo wpm_get_option('mblp_design.cart.numbers_color', 'FFFFFF'); ?>;
    }

    .mblp-site-content .checkout-tab.order-details-tab [type="submit"],
    .mblp-site-content [name="woocommerce_checkout_place_order"],
    .mblp-site-content .mbr-btn.btn-solid.btn-green.cart-proceed-button {
        background: #<?php echo wpm_get_option('mblp_design.buttons.order_btn_bg', 'A0B0A1'); ?>;
        color: #<?php echo wpm_get_option('mblp_design.buttons.order_btn_color', 'FFFFFF'); ?>;
    }

    .mblp-site-content .checkout-tab.order-details-tab [type="submit"]:hover,
    .mblp-site-content [name="woocommerce_checkout_place_order"]:hover,
    .mblp-site-content .mbr-btn.btn-solid.btn-green.cart-proceed-button:hover {
        background: #<?php echo wpm_get_option('mblp_design.buttons.order_btn_hover_bg', 'ADBEAD'); ?>;
        color: #<?php echo wpm_get_option('mblp_design.buttons.order_btn_hover_color', 'FFFFFF'); ?>;
    }

    .mblp-site-content .checkout-tab.order-details-tab [type="submit"]:active,
    .mblp-site-content [name="woocommerce_checkout_place_order"]:active,
    .mblp-site-content .mbr-btn.btn-solid.btn-green.cart-proceed-button:active {
        background: #<?php echo wpm_get_option('mblp_design.buttons.order_btn_active_bg', '8E9F8F'); ?>;
        color: #<?php echo wpm_get_option('mblp_design.buttons.order_btn_active_color', 'FFFFFF'); ?>;
    }

    .mblp-site-content .mblp-cart-total .mblp-cart-total-label {
        color: #<?php echo wpm_get_option('mblp_design.buttons.order_total_color', '868686'); ?>;
    }

    .mblp-site-content .mblp-cart-total .amount {
        color: #<?php echo wpm_get_option('mblp_design.buttons.order_total_sum_color', '4A4A4A'); ?>;
    }

    .mblp-site-content .mbr-btn.btn-solid.btn-green.cart-return-button {
        background: #<?php echo wpm_get_option('mblp_design.buttons.back_btn_bg', 'C28D8D'); ?>;
        color: #<?php echo wpm_get_option('mblp_design.buttons.back_btn_color', 'FFFFFF'); ?>;
    }

    .mblp-site-content .mbr-btn.btn-solid.btn-green.cart-return-button:hover {
        background: #<?php echo wpm_get_option('mblp_design.buttons.back_btn_hover_bg', 'A17575'); ?>;
        color: #<?php echo wpm_get_option('mblp_design.buttons.back_btn_hover_color', 'FFFFFF'); ?>;
    }

    .mblp-site-content .mbr-btn.btn-solid.btn-green.cart-return-button:active {
        background: #<?php echo wpm_get_option('mblp_design.buttons.back_btn_active_bg', '864747'); ?>;
        color: #<?php echo wpm_get_option('mblp_design.buttons.back_btn_active_color', 'FFFFFF'); ?>;
    }

    .mblp-site-content .woocommerce-cart-form .tab-content .cart-row .cart-th-value.cart-th-desc {
        color: #<?php echo wpm_get_option('mblp_design.product_titles.desc_color', '868686'); ?>;
    }

    .mblp-site-content .woocommerce-cart-form .tab-content .cart-row .cart-th-value.cart-th-price {
        color: #<?php echo wpm_get_option('mblp_design.product_titles.price_color', '868686'); ?>;
    }

    .mblp-site-content .woocommerce-cart-form .tab-content .cart-row .cart-th-value.cart-th-time {
        color: #<?php echo wpm_get_option('mblp_design.product_titles.time_color', '868686'); ?>;
    }

    .mblp-site-content .folder-wrap .folder-content .title {
        color: #<?php echo wpm_get_option('mblp_design.product_content.title_color', 'FFFFFF'); ?> !important;
    }

    .mblp-site-content .woocommerce-cart-form .tab-content .cart-row .cart-td-value.cart-td-desc {
        color: #<?php echo wpm_get_option('mblp_design.product_content.desc_color', '000000'); ?>;
    }

    .mblp-site-content .woocommerce-cart-form .tab-content .cart-row .cart-td-value.cart-td-price {
        color: #<?php echo wpm_get_option('mblp_design.product_content.price_color', '000000'); ?>;
    }

    .mblp-site-content .woocommerce-cart-form .tab-content .cart-row .cart-td-value.cart-td-time {
        color: #<?php echo wpm_get_option('mblp_design.product_content.time_color', '000000'); ?>;
    }

    .mblp-site-content .woocommerce-cart-form .tab-content .remove-cart-item {
        background: #<?php echo wpm_get_option('mblp_design.product_content.delete_bg', 'e1e1e1'); ?>;
        color: #<?php echo wpm_get_option('mblp_design.product_content.delete_color', '444'); ?>;
    }

    .mblp-site-content .upsells-holder h4 {
        color: #<?php echo wpm_get_option('mblp_design.upsells.header_color', '868686'); ?>;
    }

    .mblp-site-content .upsells-holder .upsell-row .mblp-add-to-cart {
        color: #<?php echo wpm_get_option('mblp_design.upsells.titles_color', '444'); ?>;
    }

    .mblp-site-content .upsells-holder .upsell-row .mblp-add-to-cart .iconmoon.mbr-btn {
        background: #<?php echo wpm_get_option('mblp_design.upsells.button_bg', 'A0B0A1'); ?>;
        color: #<?php echo wpm_get_option('mblp_design.upsells.button_color', 'FFFFFF'); ?>;
    }

    .mblp-site-content .upsells-holder .upsell-row .mblp-add-to-cart .iconmoon.mbr-btn:hover {
        background: #<?php echo wpm_get_option('mblp_design.upsells.button_hover_bg', 'ADBEAD'); ?> !important;
        color: #<?php echo wpm_get_option('mblp_design.upsells.button_hover_color', 'FFFFFF'); ?> !important;
    }
</style>
