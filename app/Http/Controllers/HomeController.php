<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ProgrammingLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function view(Request $request)
    {
        $sort = $request->sort;
        $selectedLanguage = $request->language;
        if ($sort || $selectedLanguage) {
            if ($sort == "oldToNew") {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'active')
                    ->orderBy('created_at', 'asc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'active')
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('created_at', 'asc')
                    ->get();
                }
            }
            else if ($sort == "AZ") {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'active')
                    ->orderBy('post_content', 'asc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'active')
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('post_content', 'asc')
                    ->get();
                }
            }
            else if ($sort == "ZA") {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'active')
                    ->orderBy('post_content', 'desc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'active')
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('post_content', 'desc')
                    ->get();
                }
            }
            else {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'active')
                    ->orderBy('created_at', 'desc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'active')
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('created_at', 'desc')
                    ->get();
                }
            }
        }
        else {
            $posts = Post::where('status', 'active')->get();
        }
        $languages = ProgrammingLanguage::all();
        return view('home', ['posts' => $posts, 'languages' => $languages, 'sort' => $sort, 'selectedLanguage' => $selectedLanguage]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $posts = Post::where('post_content', 'LIKE', '%' . $searchTerm . '%')->where('status', 'active')->get();
        return view('home', ['posts' => $posts, 'search' => $searchTerm]);
    }

    public function viewAdmin()
    {
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    }

    public function viewMyQuestions()
    {
        $posts = Post::where('user_id', Auth::user()->id)->get();
        return view('home', ['posts' => $posts]);
    }

    public function viewArchivedQuestions()
    {
        $posts = Post::where('user_id', Auth::user()->id)->where('status', 'archived')->get();
        return view('home', ['posts' => $posts]);
    }

}
