@extends('layouts.app')

@section('title')
Write Answers
@endsection

@section('content')
@include('layouts.answer')
<div class="container">
    <div class="row">
        <div class="col-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12" style="font-weight: bold; font-size: 15px;">
                        Pertanyaan
                    </div>                    
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <a href="javascript:void(0)" class="text-danger font-weight-bold" style="background-color: rgba(255, 0, 0, 0.1); padding: 5px 10px; border-radius: 5px; display: inline-block; width: 100%;" onclick="makeRedBox(event)">
                            <small style="font-size: 13px; font-weight: bold;">Pertanyaan untuk Anda</small>
                        </a>
                    </div>
                </div>                                                
            </div>
        </div>
        <div class="col-6">
            @include('layouts.success')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12" style="font-size: 15px;">
                            <i class="bi bi-star-fill text-danger"></i> Pertanyaan untuk Anda
                            <hr>
                        </div>
                    </div>
                    <div id="questionsAnswer">
                        @foreach ($questions as $question)
                            <div class="question-row" id="question-{{ $question->id }}">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('question.show',$question->title_slug) }}" class="text-dark"><h5><b>{{ $question->title }}</b></h5></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12"> 
                                        <a href="{{ route('question.show',$question->title_slug) }}"><b class="text-secondary">{{ $question->answers->count() ? $question->answers->count() . ' Answer' : 'No answer yet'}} </b></a> &#183; 
                                        <small>{{ 'last updated ' . $question->updated_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                    
                                <div class="row mt-2">
                                    <div class="col-sm-6">
                                        <a href="" data-toggle="modal" data-target="#answerModal" data-attr="{{ route('answer.store',$question->title_slug) }}" id="answer"><i class="bi bi-pencil-square"></i> Answer</a>
                                        <a href="#" class="text-danger ml-2" onclick="hideQuestion({{ $question->id }})">Hide</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header" >
                    Topik yang Anda Tahu
                </div>
                <div class="card-body">
                    @foreach (auth()->user()->topics as $topic)
                        <a href="{{ route('topic.show',$topic->name_slug) }}" class="text-dark">{{ $topic->name }} 
                        <div class="btn btn-secondary float-right btn-sm rounded-pill">
                        {{ $topic->follower }} Followers</div></a><hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    //script for answer modal
    $(document).on('click', '#answer', function () {
        let href = $(this).attr('data-attr');

        $(document).on('click', '.store', function () {
            $('#answerForm').attr('action', href);
        });
    });

    $(".moreAnswer").click(function () {
        $div = $($(this).data('div')); //div to append
        $link = $(this).data('link'); //current URL

        $page = $(this).data('page'); //get the next page #
        $href = $link + $page; //complete URL
        $.get($href, function (response) { //append data
            $html = $(response).find("#questionsAnswer").html();
            $div.append($html);
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });

    function makeRedBox(event) {
        event.preventDefault();
        $(event.target).toggleClass('red-box');
    }

    function hideQuestion(questionId) {
        $("#question-" + questionId).hide();
    }
</script>
@endsection
