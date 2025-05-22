<?php

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return \Modules\Core\Models\Setting::get($key, $default);
    }
}
