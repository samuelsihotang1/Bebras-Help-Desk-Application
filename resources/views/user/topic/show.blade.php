@extends('layouts.app')

@section('title')
{{ $topic->name }}
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8">
      @include('layouts.success')
      <div class="card">
        <div class="card-body">
          <div>
            <b class="d-inline-block">{{ $topic->name }}</b>

            <form class="d-inline-block" action="{{ route('profile.topics.update',auth()->user()->name_slug) }}" method="POST">
              @csrf
              @method('PUT')
              <input type="hidden" name="{{ ($status=='Ikuti' ? 'topic_id[]' : '' ) }}" value="{{ $topic->id }}">
              <button type="submit" class="btn btn-link text-primary">{{ $status }}</button>
            </form>

            <span class="btn btn-secondary float-right btn-sm rounded-pill d-inline-block">
              {{ $topic->follower }} Pengikut</span>
          </div>
        </div>
      </div>
      <div id="answersTopic">
        @foreach ($answers as $answer)

        @php
        //count view
        views($answer)
        ->cooldown(86400)
        ->record();
        //count question
        views($answer->question)
        ->cooldown(86400)
        ->record();

        //set share
        $link = route('question.show',$answer->question);

        //set credential
        if($answer->user->credential){
        $credential = $answer->user->credential;
        }else{
        $credential = \App\Http\Controllers\User\ProfileController::set_credential($answer->user);
        }

        //set vote status
        if(auth()->user()->hasUpVoted($answer)){
        $upvoted = "-fill";
        }else{
        $upvoted = "";
        }

        if(auth()->user()->hasDownVoted($answer)){
        $downvoted = "-fill";
        }else{
        $downvoted = "";
        }

        //set follow status
        if(auth()->user()->isFollowing($answer->user)){
        $status = "Mengikuti";
        }else{
        $status = "Ikuti";
        }

        @endphp
        <div class="card mt-3" id="{{ $answer->user->name_slug }}">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="row mb-3">
                  <div class="col-sm-1">
                    <img
                      src="{{ (strpos($answer->user->avatar, 'https') === 0) ? $answer->user->avatar : asset('img/' . $answer->user->avatar) }}"
                      alt="avatar" class="rounded-circle" width="45px" height="45px">
                  </div>

                  <div class="col-sm-11">
                    <a href="{{ route('profile.show',$answer->user->name_slug) }}" class="text-dark"><b>{{
                        $answer->user->name }} </b></a> &#183;
                    <a href="{{ route('follow',$answer->user->name_slug) }}">{{ $status }}</a>
                    <div class="text-secondary">
                      {{ $credential }} &#183; {{ $answer->created_at->format('M d Y') }}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <a href="{{ route('question.show',$answer->question->title_slug) }}" class="text-dark">
                      <h5><b>{{ $answer->question->title }}</b></h5>
                    </a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    {{ $answer->text }}<br>
                    @if ($answer->image)
                    <img src="{{ asset('img/' . $answer->image) }}" class="img-fluid mt-2 mb-2"
                      style="height: 300px;">
                    @else
                    <div class="mb-2"></div>
                    @endif
                  </div>
                  <small class="col-12 text-secondary">{{ views($answer)->count() }} Tampilan</small>
                </div>

                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="btn-group" role="group">
                      <a href="{{ route('answer.vote',['question' => $answer->question->title_slug,'answer' => $answer->id, 'vote' => 'upvote'])}}"
                        class="text-success mr-2"><i class="bi bi-arrow-up-circle{{ $upvoted }}"></i> {{
                        $answer->upVoters()->count() }}</a>
                      <a href="{{ route('answer.vote',['question' => $answer->question->title_slug,'answer' => $answer->id, 'vote' => 'downvote'])}}"
                        class="text-danger mr-4"><i class="bi bi-arrow-down-circle{{ $downvoted }}"></i> {{
                        $answer->downVoters()->count() }}</a>
                      <a href="/{{ $answer->question->title_slug ." #". $answer->user->name_slug }}"
                        class="text-secondary"><i class="bi bi-chat"></i> {{ $answer->comments->count() }}</a>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    {{-- <div class="btn-group float-right" role="group">
                      <a href="" class="text-dark" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-share"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="javascript: void(0)" onclick="copy()" id="copyLink"
                          data-attr="{{ $answer->question->title_slug ." #". $answer->user->name_slug }}">Salin tautan</a>
                      </div>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      @if ($answers->isEmpty())
      <div class="text-center mt-4"><b>Tidak ada pertanyaan terkait topik ini</b></div>
      @endif

    </div>

    <div class="col-4">
      <x-popular-topic />
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(".moreTopic").click(function () {
        $div = $($(this).data('div')); //div to append
        $link = $(this).data('link'); //current URL

        $page = $(this).data('page'); //get the next page #
        $href = $link + $page; //complete URL
        $.get($href, function (response) { //append data
            $html = $(response).find("#answersTopic").html();
            $div.append($html);
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });
    
</script>
@endsection