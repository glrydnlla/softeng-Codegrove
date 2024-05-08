<?php

namespace App\Http\Controllers;

use App\Models\ProgrammingLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPostController extends Controller
{
    public function view()
    {
        $languages = ProgrammingLanguage::all();
        return view('add_question', ['languages' => $languages, 'userId' => Auth::user()->id]);
    }

}
