@extends('layouts.app')

@section('title')
Faq
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">

      @include('layouts.success')

      <div class="card-body">
        <div class="row">
          <div class="col-12" style="font-weight: bold;">
            Faqs
          </div>
        </div>
        <hr>
        @foreach ($faqs as $faq)
        <div class="card mt-2">
          <div class="card-body">
            <b>
              {{ $faq->title }}
            </b>
          </div>
          <div class="mt-n4 card-body">
            {{ $faq->text }}
          </div>
        </div>
        @endforeach
        @if (count($faqs) == 0)
        <div class="text-center mt-2">
          Tidak ada Faq
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection