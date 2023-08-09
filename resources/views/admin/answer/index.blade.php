@extends('layouts.app')

@section('title')
Answers
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-2">
      <div class="card-body">
        <div class="row">
          <div class="col-12" style="font-weight: bold;">
            Diurutkan berdasarkan
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <a href="{{ route('admin.answers.latest') }}"
              class="{{ request()->route()->named('admin.answers.latest') ? 'text-danger font-weight-bold bg-red-trans' : 'text-dark' }}"
              style="{{ request()->route()->named('admin.answers.latest') ? 'background-color: rgba(255, 0, 0, 0.1); display: inline-block; width: 100%; padding: 5px 10px; border-radius: 5px; font-size: 13px;' : 'display: inline-block; padding: 5px 10px; border-radius: 5px; font-size: 13px;' }}">
              Terbaru</a>
          </div>
          <div class="col-12 mt-2">
            <a href="{{ route('admin.answers.most-reported') }}"
              class="{{ request()->route()->named('admin.answers.most-reported') ? 'text-danger font-weight-bold bg-red-trans' : 'text-dark' }}"
              style="{{ request()->route()->named('admin.answers.most-reported') ? 'background-color: rgba(255, 0, 0, 0.1); display: inline-block; width: 100%; padding: 5px 10px; border-radius: 5px; font-size: 13px;' : 'display: inline-block; padding: 5px 10px; border-radius: 5px; font-size: 13px;' }}">
              Yang Paling
              Dilaporkan</a>
          </div>
        </div>

      </div>
    </div>
    <div class="col-10">

      @include('layouts.success')

      @livewire('answer-admin', ['type' => $type])
    </div>

  </div>
</div>
@endsection