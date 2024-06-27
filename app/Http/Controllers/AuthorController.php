<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        return view('back.pages.home');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function changeProfilePicture(Request $request)
    {
        $user = User::find(auth('web')->id());
        $path = '/back/dist/img/authors/';
        $file = $request->file('file');
        $old_picture = $user->getAttributes()['picture'];
        $file_path = $path . $old_picture;
        $new_picture_name = 'AIMG' . $user->id . time() . rand(1, 100000) . '.jpg';

        if ($old_picture != null && File::exists(public_path($file_path))) {
            File::delete(public_path($file_path));
        }
        $upload = $file->move(public_path($path), $new_picture_name);
        if ($upload) {
            $user->update([
                'picture' => $new_picture_name
            ]);
            return response()->json(['status' => 1, 'msg' => 'Your Profile Picture has been updated']);
        } else {
            return response()->json(['status' => 0, 'Something went wrong']);
        }
    }

    public function updateLogo(Request $request)
    {
        $settings = Settings::find(1);
        // return var_dump($request->file());
        // Log::info($settings);
        if (!empty($request->file('blog_logo'))) {
            if (!empty($settings->blog_logo) && File::exists(public_path('back/dist/img/logo-favicon/' . $settings->blog_logo))) {
                File::delete(public_path('back/dist/img/logo-favicon/' . $settings->blog_logo));
            }

            $ext = $request->file('blog_logo')->getClientOriginalExtension();
            $file =  $request->file('blog_logo');
            $randomStr = date('Ymdhis') . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('back/dist/img/logo-favicon', $filename);

            $settings->blog_logo = $filename;
        }
        $settings->save();
        return redirect()->route('author.settings')->with('success', "Blog Logo Updated");
    }

    public function updateFavicon(Request $request)
    {
        $settings = Settings::find(1);
        // return var_dump($request->file());
        // Log::info($settings);
        if (!empty($request->file('blog_favicon'))) {
            if (!empty($settings->blog_favicon) && File::exists(public_path('back/dist/img/logo-favicon/' . $settings->blog_favicon))) {
                File::delete(public_path('back/dist/img/logo-favicon/' . $settings->blog_favicon));
            }

            $ext = $request->file('blog_favicon')->getClientOriginalExtension();
            $file =  $request->file('blog_favicon');
            $randomStr = date('Ymdhis') . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('back/dist/img/logo-favicon', $filename);

            $settings->blog_favicon = $filename;
        }
        $settings->save();
        return redirect()->route('author.settings')->with('success', "Favicon Logo Updated");
    }

    public function createPost(Request $request)
    {
        // dd($request);
        $request->validate([
            'post_title' => 'required|unique:posts,post_title',
            'post_content' => 'required',
            'post_category' => 'required|exists:sub_categories,id',
            'featured_image' => 'required|mimes:jpeg,jpg,png|max:1024',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = 'back/dist/img/posts-upload/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;
            $upload = $file->move($path, $new_filename);

            $post_thumbnail_path = $path . 'thumbnails';
            if (!File::exists(public_path($post_thumbnail_path))) {
                File::makeDirectory($post_thumbnail_path, $mode = 0755, true, true);
            }
            $imgManager = new ImageManager(new Driver());
            $thumbImg = $imgManager->read($path . $new_filename);
            $thumbImg = $thumbImg->resize(200, 200);
            $thumbImg->save(public_path($path . 'thumbnails/' . 'thumb_' . $new_filename));

            $resizeImg = $imgManager->read($path . $new_filename);
            $resizeImg = $resizeImg->resize(500, 350);
            $resizeImg->save(public_path($path . 'thumbnails/' . 'resized_' . $new_filename));

            // $path = 'images/post_images/';
            // $file = $request->file('featured_image');
            // $filename = $file->getClientOriginalName();
            // $new_filename = time() . '_' . $filename;
            // $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            // $post_thumbnail_path = $path . 'thumbnails';
            // if (!Storage::disk('public')->exists($post_thumbnail_path)) {
            //     Storage::disk('public')->makeDirectory($post_thumbnail_path, 0755, true, true);
            // }

            // create new manager instance with desired driver and default configuration
            // $imgManager = new ImageManager(new Driver());

            // reading uploaded image for thumbnail
            // dd($imgManager);
            // $thumbImg = $imgManager->read(storage_path('app/public/' . $path . $new_filename));
            // $thumbImg = $thumbImg->resize(200, 200);
            // $thumbImg->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));
            // reading uploaded image for resized
            // $resizeImg = $imgManager->read(storage_path('app/public/' . $path . $new_filename));
            // $resizeImg = $resizeImg->resize(500, 350);
            // $resizeImg->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            // // create thumbnails
            // Image::make(storage_path('app/public/' . $path . $new_filename))
            //     ->fit(200, 200)
            //     ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));
            // // create resize
            // Image::make(storage_path('app/public/' . $path . $new_filename))
            //     ->fit(500, 350)
            //     ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));
            // if ($upload) {
            $post = new Post();
            $post->author_id = auth()->id();
            $post->category_id = $request->post_category;
            $post->post_title = $request->post_title;
            // $post->post_slug = Str::slug($request->post_title);
            $post->post_tags = $request->post_tags;
            $post->post_content = $request->post_content;
            $post->featured_image = $new_filename;
            $saved = $post->save();

            if ($saved) {
                return redirect()->route('author.posts.all-post')->with('message', "New Post created successfully");
            } else {
                return redirect()->route('author.posts.add-post')->with('message', "Something went wrong");
            }
            // } else {
            //     return redirect()->route('author.home')->with('failed', "Something went wrong");
            // }
        }
    }

    public function editPost(Request $request)
    {
        if (!request()->post_id) {
            return abort(404);
        } else {
            $post = Post::find(request()->post_id);
            $data = [
                'post' => $post,
                'pageTitle' => 'Edit Post',
            ];
            return view('back.pages.edit_post', $data);
        }
    }

    public function updatePost(Request $request)
    {
        if ($request->hasFile('featured_image')) {
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,' . $request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:sub_categories,id',
                'featured_image' => 'required|mimes:jpeg,jpg,png|max:1024',
            ]);

            $path = 'back/dist/img/posts-upload/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;
            $upload = $file->move($path, $new_filename);

            $post_thumbnail_path = $path . 'thumbnails';
            if (!File::exists(public_path($post_thumbnail_path))) {
                File::makeDirectory($post_thumbnail_path, $mode = 0755, true, true);
            }
            $imgManager = new ImageManager(new Driver());
            $thumbImg = $imgManager->read($path . $new_filename);
            $thumbImg = $thumbImg->resize(200, 200);
            $thumbImg->save(public_path($path . 'thumbnails/' . 'thumb_' . $new_filename));

            $resizeImg = $imgManager->read($path . $new_filename);
            $resizeImg = $resizeImg->resize(500, 350);
            $resizeImg->save(public_path($path . 'thumbnails/' . 'resized_' . $new_filename));

            $old_post_image = Post::find($request->post_id)->featured_image;

            // -- delete image --
            if ($old_post_image != null && File::exists(public_path($path . $old_post_image))) {
                File::delete($path . $old_post_image);

                // -- delete image thumbnails --
                if (File::exists(public_path($path . 'thumbnails/thumb_' . $old_post_image))) {
                    File::delete($path . 'thumbnails/thumb_' . $old_post_image);
                }

                // -- delete image resized --
                if (File::exists(public_path($path . 'thumbnails/resized_' . $old_post_image))) {
                    File::delete($path . 'thumbnails/resized_' . $old_post_image);
                }
            }

            $post = Post::find($request->post_id);
            $post->category_id = $request->post_category;
            $post->post_slug = null;
            $post->post_content = $request->post_content;
            $post->post_title = $request->post_title;
            $post->featured_image = $new_filename;
            $post->post_tags = $request->post_tags;
            $saved = $post->save();

            if ($saved) {
                return redirect()->route('author.posts.all-post')->with('message', "Post updated successfully");
            } else {
                return redirect()->route('author.posts.all-post')->with('message', "Something went wrong");
            }
        } else {
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,' . $request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:sub_categories,id',
            ]);

            $post = Post::find($request->post_id);
            $post->category_id = $request->post_category;
            $post->post_slug = null;
            $post->post_content = $request->post_content;
            $post->post_title = $request->post_title;
            $post->post_tags = $request->post_tags;
            $saved = $post->save();
            if ($saved) {
                return redirect()->route('author.posts.all-post')->with('message', "Post updated successfully");
            } else {
                return redirect()->route('author.posts.all-post')->with('message', "Something went wrong");
            }
        }
    }
}
