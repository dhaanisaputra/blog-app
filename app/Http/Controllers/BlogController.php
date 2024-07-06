<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
                'pageTitle' => 'Search for :: ' . $request->query('query'),
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
                'pageTitle' => Str::ucfirst($post->post_title),
                'posts' => $post,
                'related_posts' => $related_post
            ];

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
            'pageTitle' => '#' . $tag,
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
                'pageTitle' => Str::ucfirst($post->post_title),
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
        $data = Community::paginate($perPage);

        // If you want to preserve query parameters, use appends
        $data->appends($request->all());
        // return $data;
        return view('front.pages.ykfb-community', compact('data'));
    }
}
