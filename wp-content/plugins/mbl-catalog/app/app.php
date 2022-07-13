<?php

include_once(MKK_DIR . '/src/MKKCore.php');
include_once(MKK_DIR . '/src/MKKAdmin.php');
include_once(MKK_DIR . '/src/MKKView.php');
include_once(MKK_DIR . '/src/MKKProduct.php');
include_once(MKK_DIR . '/src/MKKPublic.php');

include_once(MKK_DIR . '/app/functions.php');

add_action('init', 'mkk_init', 1);

function mkk_init()
{
	new MKKCore();
}