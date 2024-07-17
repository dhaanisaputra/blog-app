<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Community;
use App\Models\Foty;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function categoryPost(Request $request, $slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $subcategory = SubCategory::where('slug', $slug)->first();
            if (!$subcategory) {
                return abort(404);
            } else {
                $posts = Post::where('category_id', $subcategory->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

                $data = [
                    'pageTitle' => 'Category - ' . $subcategory->subcategory_name,
                    'category' => $subcategory,
                    'posts' => $posts
                ];

                return view('front.pages.ykfb-category_posts', $data);
            }
        }
    }

    public function searchBlog(Request $request)
    {
        $query = request()->query('query');
        if ($query && strlen($query) >= 2) {
            $searchValues = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
            $posts = Post::query();

            $posts->where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->orWhere('post_title', 'LIKE', '%' . $value . '%');
                    $q->orWhere('post_tags', 'LIKE', '%' . $value . '%');
                }
            });

            $posts = $posts->with('subcategory')
                ->with('author')
                ->orderBy('created_at', 'desc')
                ->paginate(6);

            $data = [
                'pageTitle' => 'Search for :: ' . $request->query('query') . ' - Yogyakarta Fingerboard Community',
                'posts' => $posts
            ];

            return view('front.pages.ykfb-search_posts', $data);
        } else {
            return abort(404);
        }
    }

    public function readPost($slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $post = Post::where('post_slug', $slug)
                ->with('subcategory')
                ->with('author')
                ->first();

            $post_tags = explode(',', $post->post_tags);
            $related_post = Post::where('id', '!=', $post->id)
                ->where(function ($query) use ($post_tags, $post) {
                    foreach ($post_tags as $item) {
                        $query->orWhere('post_tags', 'like', "$$item$");
                    }
                })
                ->inRandomOrder()
                ->take(3)
                ->get();

            $data = [
                'pageTitle' => Str::ucfirst($post->post_title) . ' - Yogyakarta Fingerboard Community',
                'posts' => $post,
                'related_posts' => $related_post
            ];
            // $post->increment('reads');
            // return view('front.pages.single_post', $data);
            return view('front.pages.ykfb-single_post', $data);
        }
    }

    public function tagPost(Request $request, $tag)
    {
        $posts = Post::where('post_tags', 'like', '%' . $tag . '%')
            ->with('subcategory')
            ->with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        if (!$posts) {
            return abort(404);
        }

        $data = [
            'pageTitle' => '#' . $tag . ' - Yogyakarta Fingerboard Community',
            'posts' => $posts,
        ];

        // return view('front.pages.tag_posts', $data);
        return view('front.pages.ykfb-tag_posts', $data);
    }

    public function readCommunity($slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $post = Community::where('post_slug', $slug)
                ->with('author')
                ->first();

            $post_tags = explode(',', $post->post_tags);
            $related_post = Community::where('id', '!=', $post->id)
                ->inRandomOrder()
                ->take(3)
                ->get();

            $data = [
                'pageTitle' => 'Community - ' . Str::ucfirst($post->communities_title),
                'posts' => $post,
                'related_posts' => $related_post
            ];
            // return $data;
            // return view('front.pages.single_post', $data);
            return view('front.pages.ykfb-community-single', $data);
        }
    }

    public function listCommunity(Request $request)
    {
        $perPage = 8; // Number of items per page
        $data = Community::where('status_community', 1)
            ->orderBy('communities_title', 'asc')
            ->paginate($perPage);

        // If you want to preserve query parameters, use appends
        $data->appends($request->all());
        // return $data;
        return view('front.pages.ykfb-community', compact('data'));
    }

    public function postPerCategory(Request $request, $id)
    {
        if (!$id) {
            return abort(404);
        } else {
            $getPostCateg = DB::table('posts as p')
                ->leftJoin('sub_categories as sc', 'sc.id', '=', 'p.category_id')
                ->leftJoin('categories as c', 'c.id', '=', 'sc.parent_category')
                ->where('c.id', $id)
                ->select('p.*', 'c.category_name')
                ->orderBy('p.created_at', 'desc')
                ->get();
            $getCategory = Category::where('id', $id)->first();
            if (!$getPostCateg) {
                return abort(404);
            } else {
                $data = [
                    'pageTitle' => 'Category - ' . $getCategory->category_name,
                    'category' => $id,
                    'posts' => $getPostCateg
                ];
                return view('front.pages.ykfb-all_posts_by_category', $data);
            }
        }
    }


    public function listFoty(Request $request)
    {
        $perPage = 8; // Number of items per page
        $data = Foty::where('status_foty', 1)
            ->orderBy('year_foty', 'desc')
            ->paginate($perPage);

        // If you want to preserve query parameters, use appends
        $data->appends($request->all());
        // return $data;
        return view('front.pages.ykfb-foty-idn', compact('data'));
    }
}
