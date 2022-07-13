<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="shop-single-product">
        <div class="product-image-wrapper">
            <?php do_action('catalog_product_item_img', $_product); ?>
            <div class="image-ratio">
				<?php mblp_render_partial('cart/preview/' . $type, 'public',  compact('_product', 'cart_item_key', 'cart_item')) ?>
            </div>

			<?php
				$time_to = MKKProduct::getMaxProductAccessTime($_product);
				$text = __('Курс доступен', 'mbl');
			?>
            <?php if ($time_to && $time_to !== 'unlimited') : ?>
                <?php mkk_render_partial('single-product/countdown', 'public',  compact('_product', 'time_to', 'text')); ?>
            <?php elseif($time_to === 'unlimited') : ?>
                <?php mkk_render_partial('single-product/countdown-unlimited'); ?>
            <?php else : ?>
                <?php do_action('catalog_no_countdown', $_product); ?>
            <?php endif; ?>
            

        </div>

        <div class="product-info">
            <div class="col-45">
                <div>
                    <?php echo wpm_get_option('mblp_texts.cart_time'); ?>
                    <span class="value">
                    <?php echo is_callable(array($_product, 'getAccessTimeText')) ? $_product->getAccessTimeText() : ''; ?>
                </div>
            </div>
            <div  class="col-55">
                <div>
                    <?php echo wpm_get_option('mblp_texts.cart_price'); ?>
                    <span class="value">
                    <?php echo apply_filters( 'mbl_catalog_cart_item_price', WC()->cart->get_product_price( $_product ), $_product ); ?>
                </div>
            </div>
        </div>

		<?php
			$href = get_post_meta( get_the_ID() , 'mkk_cart_url_type' , true  ) == '1' ?
				get_post_meta( get_the_ID() , 'mkk_cart_url' , true  ) :
				$_product->get_add_to_cart_sample_url();
		?>
        <?php echo apply_filters('mkk_product_render_add_to_cart_btn', $_product, $href); ?>

		<?php
			if (get_post_meta( get_the_ID() , 'mkk_about_url_type' , true  ) == '1') {
				$href = get_post_meta( get_the_ID() , 'mkk_about_url' , true  );
			} else {
				$rubric_id = get_post_meta( get_the_ID() , 'mkk_about_level_id' , true  );
				$href = get_category_link($rubric_id);
			}
		?>

        <a href="<?php echo $href ?>" class="broduct-btn about-btn" target="<?php echo wpm_get_option('mkk.btn_about_course_target'); ?>">
			<?php echo wpm_get_option('mkk_texts.btn_about_course_name'); ?>
        </a>


		<?php
			//Go to lessons btn
			if (get_post_meta( get_the_ID() , 'mkk_lessons_url_type' , true  ) == '1') {
				$href = get_post_meta( get_the_ID() , 'mkk_lessons_url' , true  );
			} else {
				$rubric_id = get_post_meta( get_the_ID() , 'mkk_rubric_id' , true  );
				$href = get_category_link($rubric_id);
			}
		?>
        <a href="<?php echo $href ?>" class="broduct-btn to-lessons-btn" target="<?php echo wpm_get_option('mkk.btn_go_to_lessons_target'); ?>">
			<?php echo wpm_get_option('mkk_texts.btn_go_to_lessons_name'); ?>
        </a>
    </div>
</div>
