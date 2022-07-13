<?php

class MKKProduct
{
	const MBL_PRODUCT_TYPE = 'mbl_key';
	const IPR_PRODUCT_TYPE = 'ipr_key';
	
	private static $_mblLevels = null;
	
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
		add_filter('woocommerce_product_data_tabs', [$this, 'addMKKroductTypeTab']);
	
		add_action('woocommerce_product_data_panels', [$this, 'renderCatalogOptionsPanel']);
	
		add_action('woocommerce_process_product_meta_' . self::MBL_PRODUCT_TYPE, [$this, 'saveProductMeta']);
    }

    public function addMKKroductTypeTab($tabs)
    {
        $showClass = sprintf('show_if_%s show_if_%s', self::MBL_PRODUCT_TYPE, self::IPR_PRODUCT_TYPE);

		$tabs['catalog'] = [
			'label'  => __('Каталог курсов', 'mbl_admin'),
			'target' => (self::MBL_PRODUCT_TYPE . '_course_catalog'),
			'class'  => $showClass,
		];

        return $tabs;
    }

	public function renderCatalogOptionsPanel()
	{
		global $post, $thepostid, $product_object;
		
		//уровни доступа
		$this->_initMBLLevels();
		$levels_options = [];
		
		foreach (self::$_mblLevels as $level) {
			$levels_options[$level->term_id] = $level->name;
		}
		
		//рубрики
		$categories = get_categories( [
			'taxonomy'     => 'wpm-category',
			'hide_empty'   => 0,
			'hierarchical' => 0,
			'number'       => 0,
			'pad_counts'   => false,
		] );
		
		$categories_options = [];
		
		foreach ($categories as $option) {
			$categories_options[$option->term_id] = $option->name;
		}
		
		mkk_render_partial('product/catalog_tab', 'admin', compact('post', 'thepostid', 'product_object', 'levels_options', 'categories_options'));
	}



    private function _initMBLLevels()
    {
        if (self::$_mblLevels === null) {
            self::$_mblLevels = wpm_get_all_levels();
        }
    }

    public function saveProductMeta($post_id)
    {
        $product = new WC_Product_MBL($post_id);
        
		//Save catalog
		update_post_meta( $post_id, 'mkk_cart_url_type', esc_attr( $_POST['mkk_cart_url_type'] ) );
		update_post_meta( $post_id, 'mkk_cart_url', esc_attr( $_POST['mkk_cart_url'] ) );
		update_post_meta( $post_id, 'mkk_about_url_type', esc_attr( $_POST['mkk_about_url_type'] ) );
		update_post_meta( $post_id, 'mkk_about_url', esc_attr( $_POST['mkk_about_url'] ) );
		update_post_meta( $post_id, 'mkk_about_level_id', esc_attr( $_POST['mkk_about_level_id'] ) );
		update_post_meta( $post_id, 'mkk_lessons_url_type', esc_attr( $_POST['mkk_lessons_url_type'] ) );
		update_post_meta( $post_id, 'mkk_rubric_id', esc_attr( $_POST['mkk_rubric_id'] ) );
		update_post_meta( $post_id, 'mkk_lessons_url', esc_attr( $_POST['mkk_lessons_url'] ) );

        $product->save();
    }

    public function saveIPRProductMeta($post_id)
    {
        $product = new WC_Product_IPR($post_id);
        
		//Save catalog
		update_post_meta( $post_id, 'mkk_cart_url_type', esc_attr( $_POST['mkk_cart_url_type'] ) );
		update_post_meta( $post_id, 'mkk_cart_url', esc_attr( $_POST['mkk_cart_url'] ) );
		update_post_meta( $post_id, 'mkk_about_url_type', esc_attr( $_POST['mkk_about_url_type'] ) );
		update_post_meta( $post_id, 'mkk_about_url', esc_attr( $_POST['mkk_about_url'] ) );
		update_post_meta( $post_id, 'mkk_about_level_id', esc_attr( $_POST['mkk_about_level_id'] ) );
		update_post_meta( $post_id, 'mkk_lessons_url_type', esc_attr( $_POST['mkk_lessons_url_type'] ) );
		update_post_meta( $post_id, 'mkk_rubric_id', esc_attr( $_POST['mkk_rubric_id'] ) );
		update_post_meta( $post_id, 'mkk_lessons_url', esc_attr( $_POST['mkk_lessons_url'] ) );

        $product->save();
    }
	
	public static function getMaxProductAccessTime($_product)
	{
		global $wpdb;
		$term_id = $_product->get_mbl_key_pin_code_level_id('view');
		$user_id = get_current_user_id();
		$table = MBLTermKeysQuery::getTable();
		
		$key = $wpdb->get_results(
			"
			        SELECT date_end, is_unlimited
			        FROM $table
			        WHERE term_id = $term_id AND user_id = $user_id
			        ORDER BY is_unlimited DESC, date_end DESC LIMIT 0,1
			        "
		);
		
		if(!count($key)) {
		    return null;
        }
		
		if($key[0]->is_unlimited) {
		    return 'unlimited';
        }
		
		$date = date_create_from_format('Y-m-d', $key[0]->date_end);
		
		if($date === false) {
		    return null;
        }
		
		if($date->format('U') < time()) {
		    return null;
        }
		
		return $date->format('Y-m-d');
	}
}