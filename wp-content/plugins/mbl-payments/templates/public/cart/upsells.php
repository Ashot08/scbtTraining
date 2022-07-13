<?php /** @var $_product WC_Product_MBL */ ?>
<?php $upsells = $_product->getUpsells() ?>
<?php if (count($upsells)) : ?>
    <div class="upsells-holder">
        <h4><?php echo wpm_get_option('mblp_texts.upsells'); ?></h4>
        <?php foreach ($upsells as $upsell) : ?>
            <div class="upsell-row">
                <?php mblp_render_partial('cart/upsells/add-to-cart', 'public', array('product' => $upsell)) ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>