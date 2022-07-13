<?php
include_once(MBLA_DIR . '/src/MBLAView.php');
include_once(MBLA_DIR . '/src/MBLAAdmin.php');
include_once(MBLA_DIR . '/src/MBLAPublic.php');
include_once(MBLA_DIR . '/src/MBLACore.php');

include_once(MBLA_DIR . '/app/functions.php');

add_action('init', 'mbla_init', 1);

function mbla_init()
{
    new MBLACore();
}
