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
          <div class="col-12">
            Faqs
            <span class="float-right">
              <a href="" class="mr-2" data-toggle="modal" data-target="#add-faqModal">Buat baru</a>
            </span>
          </div>
        </div>
        <hr>
        @foreach ($faqs as $faq)
        <div class="card mt-2">
          <div class="card-body">
            <b>
              {{ $faq->title }}
            </b>
            <span class="float-right">
              <a href="{{ route('admin.faqs.delete',['faq' => $faq->id]) }}"
                onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
              {{-- <a href="" class="mr-2" onclick="return confirm('Are you sure?')">Edit</a> --}}
              {{-- <a href="" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
              --}}
            </span>
          </div>
          <div class="mt-n4 card-body">
            {{ $faq->text }}
          </div>
        </div>
        @endforeach
        @if (count($faqs) == 0)
        <div class="text-center mt-2">
          No Faq
        </div>
        @endif
      </div>
    </div>

  </div>
</div>

<main class="py-4">
  @guest
  @else
  <x-faq />
  @endguest

  @yield('content')
</main>
@endsection