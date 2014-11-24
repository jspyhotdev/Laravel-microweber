<?php

function event_trigger($api_function, $data = false)
{
    mw()->event->trigger($api_function, $data);
}


/**
 * Adds event callback
 *
 * @param $function_name
 * @param bool|mixed|callable $callback
 * @return array|mixed|false
 */
function event_bind($function_name, $callback = false)
{

    mw()->event->on($function_name, $callback);
}