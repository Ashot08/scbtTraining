<?php if (function_exists('WC') && wpm_get_option('mkk.show_in_menu') == 'on') { ?>
	
	<?php if (wpm_get_option('mkk.use_product_category') == 'off') { ?>

        <a class="nav-item shop-menu user-registration-button" href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" title="<?php echo wpm_get_option('mkk_texts.menu_name'); ?>"
           class="">
            <span class="iconmoon icon-star"></span>
			<?php echo wpm_get_option('mkk_texts.menu_name'); ?>
        </a>
	
	<?php } else { ?>
        
        <?php
            $categories = get_categories( [
                'taxonomy'     => 'product_cat',
                'orderby'      => 'menu_order',
                'order'        => 'ASC',
                'hide_empty'   => 1,
                'hierarchical' => 1,
                'number'       => 0,
                'pad_counts'   => false,
                // полный список параметров смотрите в описании функции http://wp-kama.ru/function/get_terms
            ] );
        ?>

        <div class="dropdown nav-item navbar-right shop-menu-dropdown user-registration-button" data-dropdown-backdrop>
            <a id="shop-dropdown" class="dropdown-button dropdown-toggle shop-menu"
               aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                <span class="iconmoon icon-star"></span>
                <?php echo wpm_get_option('mkk_texts.menu_name'); ?>
                <span class="caret"></span>
            </a>
            
            <ul class="dropdown-menu" aria-labelledby="shop-dropdown">
                
                <?php
					if( $categories ){
						foreach( $categories as $cat ){
                            ?>
                            <li>
                                <a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>">
                                    <?php echo $cat->name; ?>
                                </a>
                            </li>
                            <?php
						}
					}
                ?>
                
            </ul>
        </div>
	
	<?php } ?>

<?php } ?>