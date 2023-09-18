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
              <a href="" class="mr-2" data-toggle="modal" data-target="#edit-faq{{ $loop->iteration }}Modal"><i
                  class="bi bi-pencil">Edit</i></a>
              <a href="{{ route('admin.faqs.delete',['faq' => $faq->id]) }}"
                onclick="return confirm('Apakah Anda yakin?')"><i class="bi bi-x-circle text-danger">Hapus</i></a>
            </span>
          </div>
          <div class="mt-n4 card-body">
            {{ $faq->text }}
          </div>
        </div>



        <!-- Modal Question-->
        <form action="{{ route('admin.faqs.update') }}" method="POST">
          @csrf
          <div class="modal fade" id="edit-faq{{ $loop->iteration }}Modal" aria-labelledby="edit-faqModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="edit-faqModalLabel"><b>Edit Faq</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <input type="hidden" name="faq" value="{{ $faq->id }}">
                      <input type="text" name="title" value="{{ $faq->title }}" class="form-control" autocomplete="off">
                      @include('layouts.error', ['name' => 'title'])
                      <input type="text" name="text" value="{{ $faq->text }}" class="mt-2 form-control"
                        autocomplete="off">
                      @include('layouts.error', ['name' => 'text'])
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-text rounded-pill" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary rounded-pill">Perbarui</button>
                </div>
              </div>
            </div>
          </div>
        </form>
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

<main class="py-4">
  @guest
  @else
  <x-faq />
  @endguest

  @yield('content')
</main>
@endsection