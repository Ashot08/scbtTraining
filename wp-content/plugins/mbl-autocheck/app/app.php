<?php
include_once(MBL_AUTOCHECK_DIR . '/src/MBL_AUTOCHECK_Admin.php');
include_once(MBL_AUTOCHECK_DIR . '/src/MBL_AUTOCHECK_Public.php');
include_once(MBL_AUTOCHECK_DIR . '/src/MBL_AUTOCHECK_Core.php');

add_action('init', 'mbl_autocheck_init', 1);

function mbl_autocheck_init()
{
   new MBL_AUTOCHECK_Core();
}
