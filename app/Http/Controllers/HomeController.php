<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ProgrammingLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class HomeController extends Controller
{
    public function view(Request $request)
    {
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        
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
        return view('home', ['posts' => $posts, 'languages' => $languages, 'sort' => $sort, 'selectedLanguage' => $selectedLanguage, 'archiveCount' => $archiveCount]);
    }

    public function search(Request $request)
    {
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        $searchTerm = $request->input('search');
        $posts = Post::where('post_content', 'LIKE', '%' . $searchTerm . '%')->where('status', 'active')->get();
        $languages = ProgrammingLanguage::all();
        $sort = $request->sort;
        $selectedLanguage = $request->language;
        return view('home', ['posts' => $posts, 'languages' => $languages, 'sort' => $sort, 'selectedLanguage' => $selectedLanguage, 'search' => $searchTerm, 'archiveCount' => $archiveCount]);
    }

    public function viewAdmin(Request $request)
    {
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        
        $sort = $request->sort;
        $selectedLanguage = $request->language;
        if ($sort || $selectedLanguage) {
            if ($sort == "oldToNew") {
                if ($selectedLanguage == -1) {
                    $posts = Post::orderBy('created_at', 'asc')
                    ->get();
                }
                else {
                    $posts = Post::where('programming_language_id', $selectedLanguage)
                    ->orderBy('created_at', 'asc')
                    ->get();
                }
            }
            else if ($sort == "AZ") {
                if ($selectedLanguage == -1) {
                    $posts = Post::orderBy('post_content', 'asc')
                    ->get();
                }
                else {
                    $posts = Post::where('programming_language_id', $selectedLanguage)
                    ->orderBy('post_content', 'asc')
                    ->get();
                }
            }
            else if ($sort == "ZA") {
                if ($selectedLanguage == -1) {
                    $posts = Post::orderBy('post_content', 'desc')
                    ->get();
                }
                else {
                    $posts = Post::where('programming_language_id', $selectedLanguage)
                    ->orderBy('post_content', 'desc')
                    ->get();
                }
            }
            else {
                if ($selectedLanguage == -1) {
                    $posts = Post::orderBy('created_at', 'desc')
                    ->get();
                }
                else {
                    $posts = Post::where('programming_language_id', $selectedLanguage)
                    ->orderBy('created_at', 'desc')
                    ->get();
                }
            }
        }
        else {
            $posts = Post::all();
        }
        $languages = ProgrammingLanguage::all();
        return view('admin', ['posts' => $posts, 'languages' => $languages, 'sort' => $sort, 'selectedLanguage' => $selectedLanguage, 'archiveCount' => $archiveCount, 'sourceUrl' => 'admin']);
    }

    public function searchAdmin(Request $request)
    {
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        
        $searchTerm = $request->input('search');
        $posts = Post::where('post_content', 'LIKE', '%' . $searchTerm . '%')->get();
        $languages = ProgrammingLanguage::all();
        $sort = $request->sort;
        $selectedLanguage = $request->language;
        return view('home', ['posts' => $posts, 'languages' => $languages, 'sort' => $sort, 'selectedLanguage' => $selectedLanguage, 'search' => $searchTerm, 'archiveCount' => $archiveCount, 'sourceUrl' => 'admin']);
    }

    public function viewMyQuestions(Request $request)
    {
        $userId = -1;
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        
        $sort = $request->sort;
        $selectedLanguage = $request->language;
        if ($sort || $selectedLanguage) {
            if ($sort == "oldToNew") {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'active')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'asc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'active')
                    ->where('user_id', $userId)
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('created_at', 'asc')
                    ->get();
                }
            }
            else if ($sort == "AZ") {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'active')
                    ->where('user_id', $userId)
                    ->orderBy('post_content', 'asc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'active')
                    ->where('user_id', $userId)
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('post_content', 'asc')
                    ->get();
                }
            }
            else if ($sort == "ZA") {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'active')
                    ->where('user_id', $userId)
                    ->orderBy('post_content', 'desc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'active')
                    ->where('user_id', $userId)
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('post_content', 'desc')
                    ->get();
                }
            }
            else {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'active')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'active')
                    ->where('user_id', $userId)
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('created_at', 'desc')
                    ->get();
                }
            }
        }
        else {
            $posts = Post::where('status', 'active')
                    ->where('user_id', $userId)->get();
        }
        $languages = ProgrammingLanguage::all();
        return view('my_questions', ['posts' => $posts, 'languages' => $languages, 'sort' => $sort, 'selectedLanguage' => $selectedLanguage, 'archiveCount' => $archiveCount, 'sourceUrl' => 'my-questions']);
    }

    public function searchMyQuestions(Request $request)
    {
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        
        $searchTerm = $request->input('search');
        $posts = Post::where('post_content', 'LIKE', '%' . $searchTerm . '%')->where('status', 'active')
                    ->where('user_id', $userId)->get();
        $languages = ProgrammingLanguage::all();
        $sort = $request->sort;
        $selectedLanguage = $request->language;
        return view('home', ['posts' => $posts, 'languages' => $languages, 'sort' => $sort, 'selectedLanguage' => $selectedLanguage, 'search' => $searchTerm, 'archiveCount' => $archiveCount, 'sourceUrl' => 'my-questions']);
    }

    public function viewArchivedQuestions(Request $request)
    {
        $userId = -1;
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        
        $sort = $request->sort;
        $selectedLanguage = $request->language;
        if ($sort || $selectedLanguage) {
            if ($sort == "oldToNew") {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'archived')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'asc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'archived')
                    ->where('user_id', $userId)
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('created_at', 'asc')
                    ->get();
                }
            }
            else if ($sort == "AZ") {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'archived')
                    ->where('user_id', $userId)
                    ->orderBy('post_content', 'asc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'archived')
                    ->where('user_id', $userId)
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('post_content', 'asc')
                    ->get();
                }
            }
            else if ($sort == "ZA") {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'archived')
                    ->where('user_id', $userId)
                    ->orderBy('post_content', 'desc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'archived')
                    ->where('user_id', $userId)
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('post_content', 'desc')
                    ->get();
                }
            }
            else {
                if ($selectedLanguage == -1) {
                    $posts = Post::where('status', 'archived')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();
                }
                else {
                    $posts = Post::where('status', 'archived')
                    ->where('user_id', $userId)
                    ->where('programming_language_id', $selectedLanguage)
                    ->orderBy('created_at', 'desc')
                    ->get();
                }
            }
        }
        else {
            $posts = Post::where('status', 'archived')
                    ->where('user_id', $userId)->get();
        }
        $languages = ProgrammingLanguage::all();
        return view('archived_questions', ['posts' => $posts, 'languages' => $languages, 'sort' => $sort, 'selectedLanguage' => $selectedLanguage, 'archiveCount' => $archiveCount, 'sourceUrl' => 'archived-questions']);
    }

    public function searchArchived(Request $request)
    {
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        
        $searchTerm = $request->input('search');
        $posts = Post::where('post_content', 'LIKE', '%' . $searchTerm . '%')
                    ->where('user_id', $userId)->where('status', 'archived')->get();
        $languages = ProgrammingLanguage::all();
        $sort = $request->sort;
        $selectedLanguage = $request->language;
        return view('home', ['posts' => $posts, 'languages'=> $languages,'sort' => $sort, 'selectedLanguage' => $selectedLanguage, 'search' => $searchTerm, 'archiveCount' => $archiveCount, 'sourceUrl' => 'archived-questions']);
    }

    // public function viewArchivedQuestions()
    // {
    //     $archiveCount = Post::where('user_id', -1)->count();
    //     if (Auth::user()) {
    //         $userId = Auth::user()->id;
    //         $archiveCount = Post::where('status', 'archived')
    //                     ->where('user_id', $userId)
    //                     ->count();
    //     }
        
    //     $posts = Post::where('user_id', Auth::user()->id)->where('status', 'archived')->get();
    //     return view('home', ['posts' => $posts, 'archiveCount' => $archiveCount]);
    // }

}
