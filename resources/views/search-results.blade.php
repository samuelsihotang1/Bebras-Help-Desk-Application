@extends('layouts.app')

@section('title')
Hasil pencarian untuk "{{ $search }}"
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">

      @include('layouts.success')

      <div class="card-body">
        <div class="row">
          <div class="col-12" style="font-weight: bold;">
            <h5><b>Hasil pencarian untuk "{{ $search }}"</b></h5>
          </div>
        </div>
        <hr>
        @foreach ($questions as $question)
        <div class="card mt-2">
          <div class="card-body">
            <a href="/{{ $question->title_slug }}" style="color: black; text-decoration: none;">
              {{ $question->title }}
            </a>
          </div>
        </div>
        @endforeach
        @if (count($questions) == 0)
        <div class="text-center mt-2">
          Tidak ada hasil untuk pencarian "{{ $search }}"
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection