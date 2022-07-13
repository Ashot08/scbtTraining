<?php
include_once(MBL_TESTS_DIR . '/src/MBL_TESTS_Admin.php');
include_once(MBL_TESTS_DIR . '/src/MBL_TESTS_Public.php');
include_once(MBL_TESTS_DIR . '/src/MBL_TESTS_Core.php');

add_action('init', 'mbl_tests_init', 1);

function mbl_tests_init()
{
   new MBL_TESTS_Core();
}
