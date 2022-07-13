<?php

function mbli3_include_partial($view, $domain = 'public')
{
    MBLI3View::includePartial($view, $domain);
}

function mbli3_render_partial($view, $domain = 'public', $variables = array(), $return = false)
{
    $result = MBLI3View::getPartial($view, $domain, $variables);

    if ($return) {
        return $result;
    } else {
        echo $result;
    }
}

function mbli3_update_option($key, $value)
{
    $main_options = get_option('wpm_main_options');

    if(!isset($main_options) || !is_array($main_options)) {
        $main_options = array();
    }

    update_option('wpm_main_options', wpm_array_set($main_options, $key, $value));
}


