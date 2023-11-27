<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiQuestionResource;
use App\Models\Question;

class ApiQuestionController extends Controller
{
  public function index()
  {
    $questions = Question::all();
    return ApiQuestionResource::collection($questions);
  }

  public function search(Request $request)
  {
    $searchQuery = $request->q;
    $questions = Question::where('title', 'LIKE', '%' . $searchQuery . '%')->get();
    return ApiQuestionResource::collection($questions);
  }
}
