{{-- @extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <div class="col-md-6 offset-md-3">
                                    <a href="auth/redirect/google" class="btn btn-sm btn-block btn-danger">Login with
                                        Google</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}



@extends('auth.layouts.navbar')
@section('content')
<div class="flex min-h-[700px] flex-col bg-gray-50">
    <div class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-20 w-auto"
                src="https://github.com/Estomihi100103/HelpDesk-Applicaion/assets/89466828/e1c6b6d5-33a6-4f84-86f0-058f812c3e32"
                alt="Your Company">
            <h2 class="mt-3 mb-4 text-center text-xl font-bold italic leading-9 tracking-tight text-gray-900">
                Masuk ke Aplikasi Help Desk Bebras
            </h2>


        </div>

        <div class="mb-4 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900 italic">Email</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" required autocomplete="email" autofocus
                                class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset {{ $errors->has('email') ? 'focus:ring-red-600' : 'focus:ring-blue-600' }} sm:text-sm sm:leading-6 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}">

                            @error('email')
                                <span class="invalid-feedback block mt-1 text-xs text-red-600 " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password"
                            class="block text-sm font-medium leading-6 text-gray-900 italic">Kata Sandi</label>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" required autocomplete="current-password"
                                class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('password') is-invalid @enderror">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 {{ old('remember') ? 'checked' : '' }}">
                            <label for="remember" class="ml-3 block text-sm leading-6 text-gray-900 italic">Remember
                                me</label>
                        </div>

                        <div class="text-sm leading-6">
                            @if (Route::has('password.request'))
                                {{-- <a href="{{ route('password.request') }}"
                                    class="font-semibold text-blue-600 hover:text-indigo-500 italic">Forgot
                                    password?</a> --}}
                            @endif
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="italic flex w-full justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Masuk
                        </button>

                    </div>
                </form>
                <p class="mt-10 text-center text-sm text-gray-500">
                    Belum memiliki akun?
                    <!-- space -->
                    <a href="{{ route('register') }}"
                        class="font-semibold leading-6 text-blue-600 hover:text-indigo-500 italic">Daftar</a>
                </p>

                <div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
