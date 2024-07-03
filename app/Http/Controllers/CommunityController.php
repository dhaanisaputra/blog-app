<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CommunityController extends Controller
{
    public function createCommunity(Request $request)
    {
        $request->validate([
            'communities_title' => 'required|unique:communities,communities_title',
            'post_content' => 'required',
            'featured_image' => 'required|mimes:jpeg,jpg,png|max:1024',
            'url_social_media' => 'nullable|url',
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
            $thumbImg = $thumbImg->resize(200, 200);
            $thumbImg->save(public_path($path . 'thumbnails/' . 'thumb_' . $new_filename));

            $resizeImg = $imgManager->read($path . $new_filename);
            $resizeImg = $resizeImg->resize(500, 350);
            $resizeImg->save(public_path($path . 'thumbnails/' . 'resized_' . $new_filename));

            $postCommunity = new Community();
            $postCommunity->author_id = auth()->id();
            $postCommunity->communities_title = $request->communities_title;
            $postCommunity->post_content = $request->post_content;
            $postCommunity->featured_image = $new_filename;
            $postCommunity->url_social_media = $request->url_social_media;

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
                'pageTitle' => 'Edit Post',
            ];
            return view('back.pages.edit_communtity', $data);
        }
    }

    public function updateCommunity(Request $request)
    {
        if ($request->hasFile('featured_image')) {
            $request->validate([
                'communities_title' => 'required|unique:communities,communities_title,' . $request->community_id,
                'post_content' => 'required',
                'featured_image' => 'required|mimes:jpeg,jpg,png|max:1024',
                'url_social_media' => 'nullable|url',
            ]);

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
            $thumbImg = $thumbImg->resize(200, 200);
            $thumbImg->save(public_path($path . 'thumbnails/' . 'thumb_' . $new_filename));

            $resizeImg = $imgManager->read($path . $new_filename);
            $resizeImg = $resizeImg->resize(500, 350);
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
            ]);

            $post = Community::find($request->community_id);
            $post->post_slug = null;
            $post->post_content = $request->post_content;
            $post->communities_title = $request->communities_title;
            $saved = $post->save();
            if ($saved) {
                return redirect()->route('author.posts.all-community')->with('message', "Community updated successfully");
            } else {
                return redirect()->route('author.posts.all-community')->with('message', "Something went wrong");
            }
        }
    }
}
