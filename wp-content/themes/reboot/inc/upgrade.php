<?php

class Wpshop_Upgrade {

    private $db_version;

    public function __construct() {

        $this->db_version = get_option( 'theme_' . THEME_SLUG . '_version', '' );

        if ( version_compare( $this->db_version, THEME_ORIGINAL_VERSION, '<' ) ) {
            if ( function_exists( 'opcache_reset' ) ) {
                @opcache_reset();
            }

            $this->upgrade();
            $this->finish_up();
        }
    }


    /**
     * Upgrade function
     */
    public function upgrade() {
        if ( version_compare( $this->db_version, '1.3.1', '<' ) ) {
//            $this->copy_views();
        }
        if ( version_compare( $this->db_version, '1.3.2', '<' ) ) {
            $this->restore_views();
        }
    }

    /**
     * @return void
     * @deprecated since 1.3.2
     */
    public function copy_views() {
        global $wpdb;

        $meta_field = 'wpshop_post_views';

        $sql = "INSERT INTO {$wpdb->postmeta} (post_id, meta_key, meta_value) " .
               "SELECT post_id, '{$meta_field}', meta_value FROM {$wpdb->postmeta} WHERE meta_key = 'views'";

        $wpdb->query( $sql );

//        $sql = "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = 'views'";
//        $rows = $wpdb->get_results($sql, ARRAY_A);
//        foreach ($rows as $row) {
//            update_post_meta($row['post_id'], \Wpshop\Core\ViewsCounter::META_FIELD, $row['meta_value']);
//        }
    }

    /**
     * @return void
     */
    public function restore_views() {
        global $wpdb;

        $sql  = "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = 'wpshop_post_views'";
        $rows = $wpdb->get_results( $sql, ARRAY_A );
        foreach ( $rows as $row ) {
            $count = max(
                absint( get_post_meta( $row['post_id'], 'views', true ) ),
                absint( $row['meta_value'] )
            );
            update_post_meta( $row['post_id'], 'views', $count );
        }
    }

    /**
     * Perform the 1.2 upgrade.
     *
     * @return void
     */
    private function upgrade_12() {

    }


    /**
     * Update version in db and flush rewrite rules
     */
    protected function finish_up() {
        update_option( 'theme_' . THEME_SLUG . '_version', THEME_ORIGINAL_VERSION );
        //add_action( 'shutdown', 'flush_rewrite_rules' );                     // Just flush rewrites, always, to at least make them work after an upgrade.
    }
}

new Wpshop_Upgrade();
