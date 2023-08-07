@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8 ">
      @include('layouts.success')
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              @if (auth()->check())
              <img
                src="{{ (strpos(Auth::user()->avatar, 'https') === 0) ? Auth::user()->avatar : asset('img/' . Auth::user()->avatar) }}"
                alt="avatar" class="rounded-circle mr-3" width="45px" height="45px">
              <b>{{ Auth::user()->name }}</b>
              @endif
            </div>
            <div class="col-sm-12 mt-3">
              <a href="" class="form-control text-dark" data-toggle="modal" data-target="#add-questionModal">What is
                your question ?</a>
            </div>
          </div>
        </div>
      </div>
      @livewire('homepage')

      {{-- data-page="2" data-link="/home?page=" data-div="#answersHome" --}}
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