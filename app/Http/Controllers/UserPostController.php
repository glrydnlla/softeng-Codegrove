<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ProgrammingLanguage;
use App\Models\UserLike;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserPostController extends Controller
{
    public function view()
    {
        $userId = -1;
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        $languages = ProgrammingLanguage::all();
        return view('add_question', ['languages' => $languages, 'userId' => Auth::user()->id, 'archiveCount' => $archiveCount]);
    }


    public function addQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|min:1',
            'language' => 'required|not_in:""'
        ], [
            'question.required' => 'Question must be filled.',
            'language.required' => 'Please select a programming language.',
            'language.not_in' => 'Please select a programming language.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'programming_language_id' => intval($request->language),
            'post_id' => null,
            'post_content' => $request->question,
            'status' => 'active',
            'created_at' => Carbon::now()
        ]);

        $postId = $post->id;

        return redirect('/post/'.$postId);
    }

    public function detail(Request $request) {
        $userId = -1;
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        $postId = $request->route('postId');
        $post = Post::find($postId);
        $replies = Post::where('post_id', $postId)->get();
        $userLike = UserLike::where('user_id', $userId)->where('post_id', $postId)->exists();
        $likes = UserLike::where('post_id', $postId)->count();
        return view('post_detail', ['post' => $post, 'replies' => $replies, 'userLike' => $userLike, 'likes' => $likes, 'archiveCount' => $archiveCount]);
    }


    public function addReply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reply' => 'required|string|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'programming_language_id' => $request->programming_language_id,
            'post_id' => $request->post_id,
            'post_content' => $request->reply
        ]);

        $postId = $post->post_id;

        return redirect('/post/'.$postId);

    }

    public function likePost(Request $request)
    {
        $postId = $request->post_id;
        $userId = Auth::user()->id;
        $userLike = UserLike::where('user_id', $userId)->where('post_id', $postId)->first();
        if ($userLike) {
            $userLike->delete();
        }
        else {
            UserLike::create([
                'user_id' => $userId,
                'post_id' => $postId
            ]);
        }
        return redirect('/post/'.$postId);
    }

    public function viewEditPost(Request $request) {
        $userId = -1;
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        $postId = $request->route('postId');
        $post = Post::find($postId);
        $languages = ProgrammingLanguage::all();
        return view('edit_question', ['languages' => $languages, 'question' => $post, 'archiveCount' => $archiveCount]);
    }

    public function editPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|min:1',
            'language' => 'required|not_in:""'
        ], [
            'question.required' => 'Question must be filled.',
            'language.required' => 'Please select a programming language.',
            'language.not_in' => 'Please select a programming language.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $postId = $request->route('postId');

        $post = Post::find($postId);

        $post->post_content = $request->question;
        $post->programming_language_id = $request->language;
        $post->status = "active";
        $post->save();

        return redirect('/post/'.$postId);
    }

    public function deletePost(Request $request)
    {
        $post = Post::find($request->post_id);
        if (Auth::user() && $post->user_id == Auth::user()->id) {
            $post->delete();
        }
        return redirect('/');
    }
}
