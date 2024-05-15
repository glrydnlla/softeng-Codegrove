<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    

    public function archivePost(Request $request)
    {
        $post = Post::find($request->post_id);
        if (Auth::user() && Auth::user()->role == "admin") {
            $post->status = "archived";
            $post->save();
        }
        return redirect('/admin');
    }
}
