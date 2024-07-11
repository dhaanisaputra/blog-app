<?php

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Settings;
use App\Models\Community;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
 * Display Home 6 latest post article by category except that id
 */
if (!function_exists('latest_home_6_posts_with_except_id')) {
    function latest_home_6_posts_with_except_id($category, $id)
    {
        return Post::with('author')
            ->with('subcategory')
            ->where('category_id', $category)
            ->where('id', '!=', $id)
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

/**
 * Display top 5 most views article
 */
if (!function_exists('top_5_posts')) {
    function top_5_posts()
    {
        return Post::with('author')
            ->with('subcategory')
            ->limit(5)
            ->orderBy('reads', 'desc')
            ->get();
    }
}


/**
 * Display Home 6 latest post article by category
 */
if (!function_exists('latest_community_6_posts')) {
    function latest_community_6_posts($id, $limit)
    {
        return Community::with('author')
            ->where('status_community', 1)
            ->where('id', '!=', $id)
            ->skip(1)
            ->limit($limit)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

/**
 * Display all tags
 */
if (!function_exists('all_tags')) {
    function all_tags()
    {
        return Post::where('post_tags', '!=', null)->distinct()->pluck('post_tags')->join(',');
    }
}


/**
 * Display Home latest post each category article by limit and skip 1 post
 */
if (!function_exists('latest_home_posts_per_category_skip_1')) {
    function latest_home_posts_per_category_skip_1($category, $limit)
    {
        $getPost = DB::table('posts as p')
            ->leftJoin('sub_categories as sc', 'sc.id', '=', 'p.category_id')
            ->leftJoin('categories as c', 'c.id', '=', 'sc.parent_category')
            ->where('c.id', $category)
            ->select('p.*')
            ->orderBy('p.created_at', 'desc')
            ->limit($limit)
            ->skip(1)
            ->get();
        return $getPost;
        // return Post::with('author')
        //     ->with('subcategory')
        //     ->where('category_id', $category)
        //     ->skip(1)
        //     ->limit($limit)
        //     ->orderBy('created_at', 'desc')
        //     ->get();
    }
}


/**
 * Display Home latest post each category article by limit and skip 1 post
 */
if (!function_exists('all_latest_home_posts_per_category')) {
    function all_latest_home_posts_per_category($category, $limit)
    {
        $getPost = DB::table('posts as p')
            ->leftJoin('sub_categories as sc', 'sc.id', '=', 'p.category_id')
            ->leftJoin('categories as c', 'c.id', '=', 'sc.parent_category')
            ->where('c.id', $category)
            ->select('p.*')
            ->orderBy('p.created_at', 'desc')
            ->limit($limit)
            ->get();
        return $getPost;
    }
}


/**
 * Display Home latest post each category article by limit and skip 1 post
 */
if (!function_exists('random_home_posts_per_category')) {
    function random_home_posts_per_category($category, $limit)
    {
        $getPost = DB::table('posts as p')
            ->leftJoin('sub_categories as sc', 'sc.id', '=', 'p.category_id')
            ->leftJoin('categories as c', 'c.id', '=', 'sc.parent_category')
            ->where('c.id', $category)
            ->select('p.*')
            // ->orderBy('p.created_at', 'desc')
            ->limit($limit)
            ->inRandomOrder()
            ->skip(1)
            ->get();
        return $getPost;
    }
}

/**
 * update counter view article
 */
if (!function_exists('update_view_counter')) {
    function update_view_counter($post_slug)
    {
        $post = Post::where('post_slug', $post_slug)->first();
        Log::info('Incrementing count_view for post with slug: ' . $post_slug);
        $post->increment('reads');
        // $post->reads = $post->reads + 1;
        $post->save();
        // return 'function run ' . $post;
        // $posts = Post::where('id', $id)->increment('count_view', 1);
        // $posts = Post::where('id', $id)->update([
        //     'count_view' => DB::raw('count_view+1')
        // ]);
        // $update = Post::where('id', $id)->update([
        //     'count_view' => DB::raw('count_view + 1'),
        // ]);
        // $post->increment('count_view');
        // $post->save();
        // $counter = $post->count_view;
        // if (empty($counter)) {
        //     $counter = 0;
        // }
        // $updateCounter = ['count_view' => $counter + 1,];
        // $update = Post::where('id', $post->id)->update($updateCounter);
        // $post->count_view = $post->count_view + 1;
        // $post->save();
        // $countView = 0;
        // if ($update) {
        //     $post = Post::where('id', $id)->first();
        //     $countView = $post->count_view;
        // }
        // return $countView;
        return $post;
    }
}
