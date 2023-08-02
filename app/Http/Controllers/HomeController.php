<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index(Request $request)
    {
        //jika user belum login
        if (!auth()->check()) {
            $answers = Answer::with(['user', 'question'])->latest()->get();
            return view('index', compact('answers'));
        }


        $answers = Answer::with(['user', 'question'])->where('user_id', '!=', auth()->id())
            ->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
            ->latest()->get();
        return view('home', compact('answers'));
    }


    //api search



    public function search(Request $request)
    {
        $question = [];

        if ($request->has('q')) {
            $search = $request->q;
            $question = Question::select('title', 'title_slug')->where('title', 'LIKE', "%$search%")->get();
        }

        return response()->json($question);
    }

}