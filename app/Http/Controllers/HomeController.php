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
        $answers = Answer::with(['user','question'])->where('user_id','!=',auth()->id())
                   ->whereNull('status')->orWhere('status','viewed_by_admin')->orWhere('status','updated_by_user')
                   ->latest()->get();
        return view('home',compact('answers'));
    }

    //api search
    // public function search(Request $request){
        
    //     $users = [];

    //     if($request->has('q')){
    //         $search = $request->q;
    //         $users = User::select('id','name_slug','name')->where('name','LIKE', "%$search%")->get();
    //     }

    //     return response()->json($users);
    // }


    public function search(Request $request){
        $question = [];
    
        if($request->has('q')){
            $search = $request->q;
            $question = Question::select('title','title_slug')->where('title','LIKE', "%$search%")->get();
        }
    
        return response()->json($question);
    }
    
}
