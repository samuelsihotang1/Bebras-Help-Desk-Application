<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiQuestionResource;
use App\Models\Question;
use Illuminate\Http\JsonResponse;


class ApiQuestionController extends Controller
{
  // public function index()
  // {
  //   $questions = Question::all();
  //   return response()->json([
  //     'questions' => $questions,
  //     'links' => $questions->getLinks(),
  //   ]);
  // }

  public function index(): JsonResponse
  {
    $questions = Question::all();
    $formattedQuestions = $questions->map(function ($questions) {
      return [
        'question' => $questions,
        'links' => $questions->getLinks(),
      ];
    });
    return response()->json([
      'questions' => $formattedQuestions,
    ]);
  }




  public function search($id): JsonResponse
  {
    $questions = Question::findOrFail($id);
    return response()->json([
      'product' => $questions,
      'links' => $questions->getLinks(),
    ]);
  }
}
