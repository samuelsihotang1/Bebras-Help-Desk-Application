@extends('layouts.app')

@section('title')
Write Answers
@endsection

@section('content')
@include('layouts.answer')
<div class="container">
    <div class="row">
        <div class="col-8">
            @include('layouts.success')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12" style="font-size: 15px;">
                            <i class=""></i> Pertanyaan untuk Anda
                            <hr>
                        </div>
                    </div>
                    @livewire('question-to-answer')
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

</script>
@endsection
