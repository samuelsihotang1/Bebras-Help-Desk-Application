@extends('layouts.app')

@section('title')
Pengikut {{ $profile }}
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">

      @include('layouts.success')

      <div class="card-body">
        <div class="row">
          <div class="col-12" style="font-weight: bold;">
            Pengikut {{ $profile }}
          </div>
        </div>
        <hr>
        @foreach ($users as $user)
        <div class="card mt-2">
          <div class="card-body">
            <a href="/profile/{{ $user->name_slug }}" style="color: black; text-decoration: none;">
              <b>
                {{ $user->name }} -
              </b>
              @if ($user->marker == 'biro')
              Pengurus Bebras Biro
              @elseif ($user->marker == 'pusat')
              Pengurus Bebras Pusat
              @elseif ($user->marker == 'guru')
              Pengajar
              @elseif ($user->marker == 'super-admin')
              Pengurus Website
              @endif
            </a>
          </div>
        </div>
        @endforeach
        @if (count($users) == 0)
        <div class="text-center mt-2">
          Tidak ada Pengikut
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection