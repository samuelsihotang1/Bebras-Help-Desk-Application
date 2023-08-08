@extends('layouts.app')

@section('title')
Topics
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-2">
      <div class="card-body">
        <div class="row">
          <div class="col-12" style="font-weight: bold;">
            Sorted by
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <div class="q-text qu-color--red qu-medium" style="box-sizing: border-box;">
              <a href="{{ route('admin.topics.latest') }}"
                class="{{ request()->route()->named('admin.topics.latest') ? 'text-danger font-weight-bold bg-red-trans' : 'text-dark' }}"
                style="{{ request()->route()->named('admin.topics.latest') ? 'background-color: rgba(255, 0, 0, 0.1); display: inline-block; width: 100%; padding: 5px 10px; border-radius: 5px; font-size: 13px;' : 'display: inline-block; padding: 5px 10px; border-radius: 5px; font-size: 13px;' }}">Latest</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-10">

      @include('layouts.success')

      @livewire('topic-admin', ['type' => $type])
    </div>

  </div>
</div>
@endsection