<?php
include_once(MBLI3_DIR . '/src/MBLI3View.php');
include_once(MBLI3_DIR . '/src/MBLI3Admin.php');
include_once(MBLI3_DIR . '/src/MBLI3Public.php');
include_once(MBLI3_DIR . '/src/MBLI3Core.php');

include_once(MBLI3_DIR . '/app/functions.php');

add_action('init', 'mbli3_init', 1);

function mbli3_init()
{
    new MBLI3Core();
}
