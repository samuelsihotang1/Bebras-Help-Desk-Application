@extends('layouts.app')

@section('title')
Stats
@endsection

@section('content')

{{-- User and Question--}}
<div class="container mx-auto">
  {{-- User --}}
  <div class="card" style="width: 48% !important; float: left !important;">
    <div class="card-header">
      <a href="{{ route('admin.users.latest') }}">
        User
      </a>
    </div>
    <div class="card-body">
      {!! $chartUser->container() !!}
    </div>
  </div>
  <script src="{{ $chartUser->cdn() }}"></script>
  {{ $chartUser->script() }}

  {{-- Question --}}
  <div class="card" style="width: 48% !important; float: right !important;">
    <div class="card-header">
      <a href="{{ route('admin.questions.latest') }}">
        Question
      </a>
    </div>
    <div class="card-body">
      {!! $chartQuestion->container() !!}
    </div>
  </div>
  <script src="{{ $chartQuestion->cdn() }}"></script>
  {{ $chartQuestion->script() }}
</div>

{{-- Answer and Comment--}}
<div class="container mx-auto" style="margin-top: 25rem !important;">
  {{-- Answer --}}
  <div class="card" style="width: 48% !important; float: left !important;">
    <div class="card-header">
      <a href="{{ route('admin.answers.latest') }}">
        Answer
      </a>
    </div>
    <div class="card-body">
      {!! $chartAnswer->container() !!}
    </div>
  </div>
  <script src="{{ $chartAnswer->cdn() }}"></script>
  {{ $chartAnswer->script() }}

  {{-- Comment --}}
  <div class="card" style="width: 48% !important; float: right !important;">
    <div class="card-header">
      <a href="{{ route('admin.comments.latest') }}">
        Comment
      </a>
    </div>
    <div class="card-body">
      {!! $chartComment->container() !!}
    </div>
  </div>
  <script src="{{ $chartComment->cdn() }}"></script>
  {{ $chartComment->script() }}
</div>

{{-- Topic and Report--}}
<div class="container mx-auto" style="margin-top: 50rem !important;">
  {{-- Topic --}}
  <div class="card" style="width: 48% !important; float: left !important;">
    <div class="card-header">
      <a href="{{ route('admin.topics.latest') }}">
        Topic
      </a>
    </div>
    <div class="card-body">
      {!! $chartTopic->container() !!}
    </div>
  </div>
  <script src="{{ $chartTopic->cdn() }}"></script>
  {{ $chartTopic->script() }}

  {{-- Report --}}
  <div class="card" style="width: 48% !important; float: right !important;">
    <div class="card-header">All Report</div>
    <div class="card-body">
      {!! $chartReport->container() !!}
    </div>
  </div>
  <script src="{{ $chartReport->cdn() }}"></script>
  {{ $chartReport->script() }}
</div>

@endsection