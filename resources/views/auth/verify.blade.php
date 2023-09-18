@extends('auth.layouts.navbar')
@section('content')
<div class="bg-white ">
  <div class="flex justify-center h-screen">
    <div class="hidden bg-cover lg:block lg:w-2/3 " style="background-image: url({{ asset('reglog.png') }})">
      <div class="flex items-center h-full px-20 ">
        <div class="p-10 rounded-xl border border-white border-opacity-20 bg-white bg-opacity-50 ">
          <h2 class="text-2xl font-bold text-red-600  sm:text-3xl">Bebras Help Desk Application</h2>

          <p class="text-xl font-bold text-gray-700 mt-3 ">
            {{ __('Verifikasi Alamat Email Anda') }}
          </p>
        </div>
      </div>
    </div>

    <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
      <div class="flex-1">
        <div class="text-center">
          <div class="flex justify-center mx-auto">
            <img class="w-auto h-18 sm:h-20"
              src="https://github.com/Estomihi100103/forimg/assets/89466828/263f2e09-97c8-4e06-a01e-5699398d2a6e"
              alt="">
          </div>

          <p class="mt-3 font-bold italic leading-9 tracking-tight text-gray-900 ">
            {{ __('Verifikasi Alamat Email Anda') }}
          </p>
        </div>

        <div class="mb-4 sm:mx-auto sm:w-full sm:max-w-[480px]">
          <br>
          @if (session('resent'))
          <strong>
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda') }}
          </strong>
          <br>
          <br>
          @endif
          {{ __('Sebelum melanjutkan, harap periksa email Anda untuk tautan verifikasi.') }}
          <br>
          <br>
          {{ __('Jika Anda tidak menerima email tersebut') }},
          <form class="space-y-6" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit"
              class="italic flex w-full justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">{{
              __('Klik di sini untuk meminta yang
              lain') }}</button>.
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection