<div>
  <div id="answersHome" class="">
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
    $link = route('question.show', $answer->question);

    //set credential
    if ($answer->user->credential) {
    $credential = $answer->user->credential;
    } else {
    $credential = \App\Http\Controllers\User\ProfileController::set_credential($answer->user);
    }

    if (auth()->check()) {

    //set vote status
    if (
    auth()
    ->user()
    ->hasUpVoted($answer)
    ) {
    $upvoted = '-fill';
    } else {
    $upvoted = '';
    }

    if (
    auth()
    ->user()
    ->hasDownVoted($answer)
    ) {
    $downvoted = '-fill';
    } else {
    $downvoted = '';
    }

    //set follow status
    if (
    auth()
    ->user()
    ->isFollowing($answer->user)
    ) {
    $status = 'Following';
    } else {
    $status = 'Follow';
    }
    }

    @endphp
    <div class="card mt-3" id="{{ $answer->user->name_slug }}">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="row mb-3">
              <div class="col-1">
                <img
                  src="{{ (strpos($answer->user->avatar, 'https') === 0) ? $answer->user->avatar : asset('img/' . $answer->user->avatar) }}"
                  alt="avatar" class="rounded-circle" width="45px" height="45px">
              </div>

              <div class="col-11 ">
                <a href="{{ route('profile.show', $answer->user->name_slug) }}" class="text-dark"><b>{{
                    $answer->user->name }} </b></a> &#183;
                @if (auth()->check())
                <a href="{{ route('follow', $answer->user->name_slug) }}">{{ $status }}</a>
                @endif
                <div class="text-secondary">
                  {{ $credential }} &#183; {{ $answer->created_at->format('M d Y') }}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <a href="{{ route('question.show', $answer->question->title_slug) }}" class="text-dark">
                  <h5><b>{{ $answer->question->title }}</b></h5>
                </a>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                {{ $answer->text }}<br>
                @if ($answer->image)
                <img src="{{ asset('img/' . $answer->image) }}" class="img-fluid mt-2 mb-2"
                  style="height: 300px;" alt="image not found!">
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
                  @if (auth()->check())
                  <a href="{{ route('answer.vote', ['question' => $answer->question->title_slug, 'answer' => $answer->id, 'vote' => 'upvote']) }}"
                    class="text-success mr-2"><i class="bi bi-arrow-up-circle{{ $upvoted }}"></i>
                    {{ $answer->upVoters()->count() }}</a>
                  <a href="{{ route('answer.vote', ['question' => $answer->question->title_slug, 'answer' => $answer->id, 'vote' => 'downvote']) }}"
                    class="text-danger mr-4"><i class="bi bi-arrow-down-circle{{ $downvoted }}"></i>
                    {{ $answer->downVoters()->count() }}</a>
                  @endif
                  <a href="{{ $answer->question->title_slug . ' #' . $answer->user->name_slug }}"
                    class="text-secondary"><i class="bi bi-chat"></i>
                    {{ $answer->comments->count() }}</a>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="btn-group float-right" role="group">
                  <a href="" class="text-dark" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-share"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="javascript: void(0)" onclick="copy()" id="copyLink"
                      data-attr="{{ $answer->question->title_slug . ' #' . $answer->user->name_slug }}">Salin tautan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @php
    $page = $loop->iteration;
    @endphp
    @endforeach
  </div>
  @if ($page != $count)
  <div class="text-center" wire:click="morePage">
    <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">Lebih lanjut</button>
  </div>
  @endif
</div>