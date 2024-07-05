<?php

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Settings;
use App\Models\SubCategory;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;

if (!function_exists('blogInfo')) {
    function blogInfo()
    {
        return Settings::find(1);
    }
}


/**
 * Date format, ex: January 12, 2024
 */
if (!function_exists('date_formatter')) {
    function date_formatter($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->isoFormat('LL');
    }
}

/**
 * Strip words
 */
if (!function_exists('words')) {
    function words($value, $words = 15, $end = '...')
    {
        return Str::words(strip_tags($value), $words, $end);
    }
}

/**
 * Check if user is online/not connected
 */
if (!function_exists('isOnline')) {
    function isOnline($site = 'https://www.youtube.com/')
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Reading article duration
 */
if (!function_exists('readDuration')) {
    if (!Str::hasMacro('timeCounter')) {
        Str::macro('timeCounter', function ($text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);
            return (int) max(1, $minutesToRead);
        });
    }

    function readDuration(...$text)
    {
        return Str::timeCounter($text);
    }
    // function readDuration(...$text)
    // {
    //     Str::macro('timeCounter', function ($text) {
    //         $totalWords = str_word_count(implode(" ", $text));
    //         $minutesToRead = round($totalWords / 200);
    //         return (int) max(1, $minutesToRead);
    //     });
    //     return Str::timeCounter($text);
    // }
}

/**
 * Display Home latest post article
 */
if (!function_exists('single_latest_post')) {
    function single_latest_post()
    {
        return Post::with('author')
            ->with('subcategory')
            ->limit(1)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}

/**
 * Display Home 6 latest post article
 */
if (!function_exists('latest_home_6posts')) {
    function latest_home_6posts()
    {
        return Post::with('author')
            ->with('subcategory')
            ->skip(1)
            ->limit(6)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

/**
 * Display random recomended post article
 */
if (!function_exists('recomended_posts')) {
    function recomended_posts()
    {
        return Post::with('author')
            ->with('subcategory')
            ->limit(4)
            ->inRandomOrder()
            ->get();
    }
}

/**
 * Post with number of posts
 */
if (!function_exists('categories')) {
    function categories()
    {
        return SubCategory::whereHas('posts')
            ->with('posts')
            ->orderBy('subcategory_name', 'asc')
            ->get();
    }
}


/**
 * Sidebar Latest Post
 */
if (!function_exists('latest_sidebar_posts')) {
    function latest_sidebar_posts($except = null, $limit = 3)
    {
        return Post::where('id', '!=', $except)
            ->limit($limit)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

/**
 * Display Home 4 latest post article
 */
if (!function_exists('latest_home_4posts')) {
    function latest_home_4posts()
    {
        return Post::with('author')
            ->with('subcategory')
            ->skip(1)
            ->limit(4)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}


/**
 * Display Home latest post article by param
 */
if (!function_exists('latest_home_of_posts')) {
    function latest_home_of_posts($limit)
    {
        return Post::with('author')
            ->with('subcategory')
            ->skip(1)
            ->limit($limit)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

/**
 * Display random recomended post article  by param
 */
if (!function_exists('recomended_of_posts')) {
    function recomended_of_posts($limit)
    {
        return Post::with('author')
            ->with('subcategory')
            ->limit($limit)
            ->inRandomOrder()
            ->get();
    }
}

/**
 * Display Home 6 latest post article by category
 */
if (!function_exists('latest_home_6_posts')) {
    function latest_home_6_posts($category)
    {
        return Post::with('author')
            ->with('subcategory')
            ->where('category_id', $category)
            ->skip(1)
            ->limit(6)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

/**
 * Display Home latest post article by param
 */
if (!function_exists('latest_all_of_posts')) {
    function latest_all_of_posts($limit)
    {
        return Post::with('author')
            ->with('subcategory')
            ->limit($limit)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
