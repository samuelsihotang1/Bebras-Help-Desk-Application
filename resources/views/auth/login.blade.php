@extends('auth.layouts.navbar')
@section('content')
<div class="bg-white ">
    <div class="flex justify-center h-screen">
        <div class="hidden bg-cover lg:block lg:w-2/3 " style="background-image: url({{ asset('reglog.png') }})">
            <div class="flex items-center h-full px-20 ">
                <div class="p-10 rounded-xl border border-white border-opacity-20 bg-white bg-opacity-50 ">
                    <h2 class="text-2xl font-bold text-red-600  sm:text-3xl">Bebras Help Desk Application</h2>

                    <p class="text-xl font-bold text-gray-700 mt-3 ">
                        Sudah merindukan diskusi ? Kami juga! Silakan masuk dan berbagi pemikiran Anda di Bebras Help
                        Desk.
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

                    <p class="mt-3 font-bold italic leading-9 tracking-tight text-gray-900 ">Masuk ke Aplikasi Help Desk
                        Bebras</p>
                </div>

                <div class="mb-4 sm:mx-auto sm:w-full sm:max-w-[480px]">

                    @if (session()->has('message'))
                    <strong>{{ session('message')['text'] }}</strong>
                    @endif
                    <form class="space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 italic">
                                Email
                            </label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" required autocomplete="email" autofocus
                                    class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset {{ $errors->has('email') ? 'focus:ring-red-600' : 'focus:ring-blue-600' }} sm:text-sm sm:leading-6 @error('email') is-invalid @enderror"
                                    value="{{ old('email') ? old('email') : 'admin@gmail.com' }}">

                                @error('email')
                                <span class="invalid-feedback block mt-1 text-xs text-red-600 " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900 italic">Kata
                                Sandi</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" required
                                    autocomplete="current-password"
                                    class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('password') is-invalid @enderror"
                                    value="{{ 'admin@gmail.com' }}">
                            </div>
                        </div>

                        {{-- <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 {{ old('remember') ? 'checked' : '' }}">
                                <label for="remember" class="ml-3 block text-sm leading-6 text-gray-900 italic">Remember
                                    me</label>
                            </div>

                            <div class="text-sm leading-6">
                                @if (Route::has('password.request')) --}}
                                {{-- <a href="{{ route('password.request') }}"
                                    class="font-semibold text-blue-600 hover:text-indigo-500 italic">Forgot
                                    password?</a> --}}
                                {{-- @endif
                            </div>
                        </div> --}}

                        <div>
                            <button type="submit"
                                class="italic flex w-full justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Masuk
                            </button>

                        </div>
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel"
                            aria-labelledby="tab-login">

                            <div class="text-center mb-3">

                                <p class="mb-4 text-center text-sm text-gray-500">
                                    Atau Masuk Dengan
                                </p>

                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <style>
                                        .btn-floating svg:hover {
                                            transform: scale(1.2);
                                            transition: transform 0.2s;
                                        }
                                    </style>
                                </head>

                                <a href="auth/redirect/google" type="button" class="btn btn-link btn-floating mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-google"
                                        viewBox="0 0 16 16">
                                        <defs>
                                            <linearGradient id="googleGradient" x1="100%" y1="100%">
                                                <stop offset="0%" stop-color="#fbbc05" /> <!-- yellow -->
                                                <stop offset="25%" stop-color="#ea4335" /> <!-- red -->
                                                <stop offset="50%" stop-color="#34a853" /> <!-- green -->
                                                <stop offset="75%" stop-color="#4285f4" /> <!-- blue -->
                                            </linearGradient>
                                        </defs>
                                        <path fill="url(#googleGradient)"
                                            d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                                    </svg>
                                </a>

                                <a href="auth/redirect/github" type="button" class="btn btn-link btn-floating mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-github" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                    </svg>
                                </a>
                            </div>

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






    {{--
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
                    @if (session()->has('message'))
                    <strong>{{ session('message')['text'] }}</strong>
                    @endif
                    <form class="space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email"
                                class="block text-sm font-medium leading-6 text-gray-900 italic">Email</label>
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
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900 italic">Kata
                                Sandi</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" required
                                    autocomplete="current-password"
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
    @endsection --}}