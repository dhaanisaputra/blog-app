<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Foty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CommunityController extends Controller
{
    public function createCommunity(Request $request)
    {
        // return $request;
        $request->validate([
            'communities_title' => 'required|unique:communities,communities_title',
            'post_content' => 'required',
            'featured_image' => 'required|mimes:jpeg,jpg,png|max:3072',
            'url_social_media' => 'nullable|url',
            'status_community' => 'nullable|boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = 'back/dist/img/community-upload/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;
            $upload = $file->move($path, $new_filename);

            $community_thumbnail_path = $path . 'thumbnails';
            if (!File::exists(public_path($community_thumbnail_path))) {
                File::makeDirectory($community_thumbnail_path, $mode = 0755, true, true);
            }
            $imgManager = new ImageManager(new Driver());
            $thumbImg = $imgManager->read($path . $new_filename);
            $thumbImg = $thumbImg->resize(200, 200, function ($constraint) {
                $constraint->aspectRation();
            });
            $thumbImg->save(public_path($path . 'thumbnails/' . 'thumb_' . $new_filename));

            $resizeImg = $imgManager->read($path . $new_filename);
            $resizeImg = $resizeImg->resize(100, 100, function ($constraint) {
                $constraint->aspectRation();
            });
            $resizeImg->save(public_path($path . 'thumbnails/' . 'resized_' . $new_filename));

            $postCommunity = new Community();
            $postCommunity->author_id = auth()->id();
            $postCommunity->communities_title = $request->communities_title;
            $postCommunity->post_content = $request->post_content;
            $postCommunity->featured_image = $new_filename;
            $postCommunity->url_social_media = $request->url_social_media;
            $postCommunity->status_community = $request->has('status_community') ? 1 : 0;
            $saved = $postCommunity->save();

            if ($saved) {
                return redirect()->route('author.posts.all-community')->with('message', "New Post created successfully");
            } else {
                return redirect()->route('author.posts.add-community')->with('message', "Something went wrong");
            }
        }
    }

    public function editCommunity(Request $request)
    {
        if (!request()->community_id) {
            return abort(404);
        } else {
            $community = Community::find(request()->community_id);
            $data = [
                'post' => $community,
                'pageTitle' => 'Edit Community',
            ];
            return view('back.pages.edit_community', $data);
        }
    }

    public function updateCommunity(Request $request)
    {
        if ($request->hasFile('featured_image')) {
            $request->validate([
                'communities_title' => 'required|unique:communities,communities_title,' . $request->community_id,
                'post_content' => 'required',
                'featured_image' => 'required|mimes:jpeg,jpg,png|max:3072',
                'url_social_media' => 'nullable|url',
                // 'status_community' => 'required',
                'status_community' => 'nullable|boolean',
            ]);
            // , [
            //     'status_community.required' => 'Specify status publication'
            // ]);

            $path = 'back/dist/img/community-upload/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;
            $upload = $file->move($path, $new_filename);

            $community_thumbnail_path = $path . 'thumbnails';
            if (!File::exists(public_path($community_thumbnail_path))) {
                File::makeDirectory($community_thumbnail_path, $mode = 0755, true, true);
            }
            $imgManager = new ImageManager(new Driver());
            $thumbImg = $imgManager->read($path . $new_filename);
            $thumbImg = $thumbImg->resize(200, 200, function ($constraint) {
                $constraint->aspectRation();
            });
            $thumbImg->save(public_path($path . 'thumbnails/' . 'thumb_' . $new_filename));

            $resizeImg = $imgManager->read($path . $new_filename);
            $resizeImg = $resizeImg->resize(100, 100, function ($constraint) {
                $constraint->aspectRation();
            });
            $resizeImg->save(public_path($path . 'thumbnails/' . 'resized_' . $new_filename));

            $old_post_image = Community::find($request->community_id)->featured_image;

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

            $communityPost = Community::find($request->community_id);
            $communityPost->post_slug = null;
            $communityPost->post_content = $request->post_content;
            $communityPost->communities_title = $request->communities_title;
            $communityPost->url_social_media = $request->url_social_media;
            // $communityPost->status_community = $request->status_community;
            $communityPost->status_community = $request->has('status_community') ? 1 : 0;
            $communityPost->featured_image = $new_filename;
            $saved = $communityPost->save();

            if ($saved) {
                return redirect()->route('author.posts.all-community')->with('message', "Community updated successfully");
            } else {
                return redirect()->route('author.posts.all-community')->with('message', "Something went wrong");
            }
        } else {
            $request->validate([
                'communities_title' => 'required|unique:communities,communities_title,' . $request->community_id,
                'post_content' => 'required',
                'url_social_media' => 'nullable|url',
            ]);

            $post = Community::find($request->community_id);
            $post->post_slug = null;
            $post->post_content = $request->post_content;
            $post->communities_title = $request->communities_title;
            $post->url_social_media = $request->url_social_media;
            // $post->status_community = $request->status_community;
            $post->status_community = $request->has('status_community') ? 1 : 0;
            $saved = $post->save();
            if ($saved) {
                return redirect()->route('author.posts.all-community')->with('message', "Community updated successfully");
            } else {
                return redirect()->route('author.posts.all-community')->with('message', "Something went wrong");
            }
        }
    }

    public function createFoty(Request $request)
    {
        // return $request;
        $request->validate([
            'name_foty' => 'required|unique:foties,name_foty',
            'post_content' => 'nullable',
            'featured_image' => 'required|mimes:jpeg,jpg,png|max:3072',
            'url_social_media' => 'nullable|url',
            'status_foty' => 'nullable|boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = 'back/dist/img/foty-upload/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;
            $upload = $file->move($path, $new_filename);

            $foty_thumbnail_path = $path . 'thumbnails';
            if (!File::exists(public_path($foty_thumbnail_path))) {
                File::makeDirectory($foty_thumbnail_path, $mode = 0755, true, true);
            }
            $imgManager = new ImageManager(new Driver());
            $thumbImg = $imgManager->read($path . $new_filename);
            $thumbImg = $thumbImg->resize(300, 300, function ($constraint) {
                $constraint->aspectRation();
            });
            $thumbImg->save(public_path($path . 'thumbnails/' . 'thumb_' . $new_filename));

            $resizeImg = $imgManager->read($path . $new_filename);
            $resizeImg = $resizeImg->resize(100, 100, function ($constraint) {
                $constraint->aspectRation();
            });
            $resizeImg->save(public_path($path . 'thumbnails/' . 'resized_' . $new_filename));

            $postFoty = new Foty();
            $postFoty->author_id = auth()->id();
            $postFoty->name_foty = $request->name_foty;
            $postFoty->post_content = $request->post_content;
            $postFoty->featured_image = $new_filename;
            $postFoty->year_foty = $request->year_foty;
            $postFoty->url_social_media = $request->url_social_media;
            $postFoty->status_foty = $request->has('status_foty') ? 1 : 0;
            $saved = $postFoty->save();

            if ($saved) {
                // return 'created successfully';
                return redirect()->route('author.posts.all-foty')->with('message', "New FoTY created successfully");
            } else {
                // return 'Something went wrong';
                return redirect()->route('author.posts.add-foty')->with('message', "Something went wrong");
            }
        }
    }

    public function editFoty(Request $request)
    {
        if (!request()->foty_id) {
            return abort(404);
        } else {
            $foty = Foty::find(request()->foty_id);
            $data = [
                'post' => $foty,
                'pageTitle' => 'Edit Foty',
            ];
            return view('back.pages.edit_foty', $data);
        }
    }

    public function updateFoty(Request $request)
    {
        if ($request->hasFile('featured_image')) {

            $request->validate([
                'name_foty' => 'required|unique:foties,name_foty,' . $request->foty_id,
                'post_content' => 'nullable',
                'featured_image' => 'required|mimes:jpeg,jpg,png|max:3072',
                'url_social_media' => 'nullable|url',
                'status_foty' => 'nullable|boolean',
            ]);
            $path = 'back/dist/img/foty-upload/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;
            $upload = $file->move($path, $new_filename);

            $foty_thumbnail_path = $path . 'thumbnails';
            if (!File::exists(public_path($foty_thumbnail_path))) {
                File::makeDirectory($foty_thumbnail_path, $mode = 0755, true, true);
            }
            $imgManager = new ImageManager(new Driver());
            $thumbImg = $imgManager->read($path . $new_filename);
            $thumbImg = $thumbImg->resize(300, 300, function ($constraint) {
                $constraint->aspectRation();
            });
            $thumbImg->save(public_path($path . 'thumbnails/' . 'thumb_' . $new_filename));

            $resizeImg = $imgManager->read($path . $new_filename);
            $resizeImg = $resizeImg->resize(100, 100, function ($constraint) {
                $constraint->aspectRation();
            });
            $resizeImg->save(public_path($path . 'thumbnails/' . 'resized_' . $new_filename));

            $old_post_image = Foty::find($request->foty_id)->featured_image;

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

            $fotyPost = Foty::find($request->foty_id);
            $fotyPost->post_slug = null;
            $fotyPost->post_content = $request->post_content;
            $fotyPost->name_foty = $request->name_foty;
            $fotyPost->url_social_media = $request->url_social_media;
            $fotyPost->year_foty = $request->year_foty;
            $fotyPost->status_foty = $request->has('status_foty') ? 1 : 0;
            $fotyPost->featured_image = $new_filename;
            $saved = $fotyPost->save();

            if ($saved) {
                return redirect()->route('author.posts.all-foty')->with('message', "FoTY updated successfully");
            } else {
                return redirect()->route('author.posts.all-foty')->with('message', "Something went wrong");
            }
        } else {
            $request->validate([
                'name_foty' => 'required|unique:foties,name_foty,' . $request->foty_id,
                'post_content' => 'nullable',
                'url_social_media' => 'nullable|url',
            ]);

            $post = Foty::find($request->foty_id);
            $post->post_slug = null;
            $post->post_content = $request->post_content;
            $post->name_foty = $request->name_foty;
            $post->url_social_media = $request->url_social_media;
            $post->year_foty = $request->year_foty;
            $post->status_foty = $request->has('status_foty') ? 1 : 0;
            $saved = $post->save();
            if ($saved) {
                return redirect()->route('author.posts.all-foty')->with('message', "FoTY updated successfully");
            } else {
                return redirect()->route('author.posts.all-foty')->with('message', "Something went wrong");
            }
        }
    }
}
