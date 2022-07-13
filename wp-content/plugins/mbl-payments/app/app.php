<?php
include_once(MBLP_DIR . '/src/MBLPView.php');
include_once(MBLP_DIR . '/src/MBLPMail.php');
include_once(MBLP_DIR . '/src/MBLPProduct.php');
include_once(MBLP_DIR . '/src/MBLPOrder.php');
include_once(MBLP_DIR . '/src/MBLPUser.php');
include_once(MBLP_DIR . '/src/MBLPCart.php');
include_once(MBLP_DIR . '/src/MBLPCheckout.php');
include_once(MBLP_DIR . '/src/MBLPAdmin.php');
include_once(MBLP_DIR . '/src/MBLPPublic.php');
include_once(MBLP_DIR . '/src/MBLPCore.php');

include_once(MBLP_DIR . '/app/functions.php');

add_action('init', 'mblp_init', 2);

function mblp_init()
{
    new MBLPCore();
}
