<?php

use App\Models\Settings;

if (!function_exists('blogInfo')) {
    function blogInfo()
    {
        return Settings::find(1);
    }
}
