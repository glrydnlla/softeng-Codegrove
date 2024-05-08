<?php

namespace App\Http\Controllers;

use App\Models\ProgrammingLanguage;
use App\Models\UserProgrammingLanguage;
use Illuminate\Http\Request;

class ProgrammingLanguageController extends Controller
{
    public function view(Request $request) {
        $userId = $request->route('userId');
        $languages = ProgrammingLanguage::all();
        return view('choose_programming_language', ['languages' => $languages, 'userId' => $userId]);
    }

    public function selectLanguage(Request $request, $userId)
    {
        $selectedLanguages = $request->input('selected_languages');
        foreach ($selectedLanguages as $lang) {
            UserProgrammingLanguage::create([
                'user_id' => $userId,
                'programming_language_id' => intval($lang)
            ]);
        };
        return redirect()->route('home');
    }

}
