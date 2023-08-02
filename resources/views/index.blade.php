@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8 ">
      @include('layouts.success')
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12 mt-3">
                <a href="{{ route('login') }}" class="form-control text-dark">What is your question?</a>
            </div>
        </div>
        
        </div>
      </div>
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
                      style="width: 300px; height: 300px;" alt="image not found!">
                    @else
                    <div class="mb-2"></div>
                    @endif
                    <small class="text-secondary">{{ views($answer)->count() }} views</small>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="btn-group" role="group">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="btn-group float-right" role="group">
                      <a href="" class="text-dark" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-share"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="javascript: void(0)" onclick="copy()" id="copyLink"
                          data-attr="{{ $answer->question->title_slug . ' #' . $answer->user->name_slug }}">Copy
                          link</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>

    <div class="col-4">
      <x-popular-topic />
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  let env_url = "{{ env('APP_URL') }}";

        $(".moreHome").click(function() {
            $div = $($(this).data('div')); //div to append
            $link = $(this).data('link'); //current URL

            $page = $(this).data('page'); //get the next page #
            $href = $link + $page; //complete URL
            $.get($href, function(response) { //append data
                $html = $(response).find("#answersHome").html();
                $div.append($html);
            });

            $(this).data('page', (parseInt($page) + 1)); //update page #
        });

        //script for copy link to clipboard
        function copy() {
            let dummy = document.createElement('input');
            let href = $('#copyLink').attr('data-attr');
            let text = env_url + href;

            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);

            alert('Link copied to clipboard');
        }
</script>
@endsection