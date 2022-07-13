<?php /** @var WC_Product_MBL $_product */ ?>
<?php $thumbnail = wpm_remove_protocol(wp_get_attachment_image_url($_product->get_image_id(), 'full')); ?>
<?php $name = (!wpm_option_is('mblp_design.product_content.disable_title', 'on') && is_callable(array($_product, 'getProductName'))) ? $_product->getProductName(true) : ''; ?>

<span class="folder-wrap folder-with-subfolders folder-unlock folder-image" style="background: url('<?php echo $thumbnail; ?>') center; background-size: cover;">
    <?php if ($name) : ?>
        <div class="folder-content">
            <h1 class="title"><?php echo $name; ?></h1>
            <div class="bottom-icons">
                <span class="bottom-icons-clearfix"></span>
            </div>
        </div>
    <?php endif; ?>
</span>