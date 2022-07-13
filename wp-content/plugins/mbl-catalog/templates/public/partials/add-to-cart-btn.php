<?php if ($free) : ?>
    <a href="<?php echo $href ?>" class="broduct-btn add-to-cart-free-btn" target="<?php echo wpm_get_option('mkk.btn_add_to_cart_free_target'); ?>">
        <?php echo wpm_get_option('mkk_texts.btn_add_to_cart_free_name')
            ? wpm_get_option('mkk_texts.btn_add_to_cart_free_name')
            : wpm_get_option('mkk_texts.btn_add_to_cart_name');
        ?>
    </a>
<?php else : ?>
    <a href="<?php echo $href ?>" class="broduct-btn add-to-cart-btn" target="<?php echo wpm_get_option('mkk.btn_add_to_cart_target'); ?>">
        <?php echo wpm_get_option('mkk_texts.btn_add_to_cart_name'); ?>
    </a>
<?php endif; ?>
