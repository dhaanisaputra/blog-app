<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
            return response()->json(['status=>0', 'Something went wrong']);
        }
    }

    public function updateLogo(Request $request)
    {
        $settings = Settings::find(1);
        // return var_dump($request->file());
        // Log::info($settings);
        if (!empty($request->file('blog_logo'))) {
            // dd($settings->blog_logo);
            if (!empty($this->$settings->blog_logo) && file_exists('../back/dist/img/logo-favicon/' . $settings->blog_logo)) {
                unlink('/back/dist/img/logo-favicon/' . $settings->blog_logo);
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
            if (!empty($settings->blog_favicon) && file_exists('/back/dist/img/logo-favicon/' . $settings->blog_favicon)) {
                unlink('/back/dist/img/logo-favicon/' . $settings->blog_favicon);
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
}
