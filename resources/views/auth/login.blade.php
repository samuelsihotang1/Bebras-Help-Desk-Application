@extends('auth.layouts.navbar')
@section('content')
    <div class="bg-white ">
        <div class="flex justify-center h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/3 "
                style="background-image: url(https://github.com/Estomihi100103/forimg/assets/89466828/58f838c9-a873-4585-8373-b99c288023e4)">
                <div class="flex items-center h-full px-20 ">
                    <div class="p-10 rounded-xl border border-white border-opacity-20 bg-white bg-opacity-50 ">
                        <h2 class="text-2xl font-bold text-red-600  sm:text-3xl">Bebras Help Desk Application</h2>

                        <p class="text-xl font-bold text-gray-700 mt-3 ">
                            Sudah merindukan diskusi ? Kami juga! Silakan masuk dan berbagi pemikiran Anda di Bebras Help Desk.
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

                        <p class="mt-3 font-bold italic leading-9 tracking-tight text-gray-900 ">Masuk ke Aplikasi Help Desk Bebras</p>
                    </div>

                    <div class="mb-4 sm:mx-auto sm:w-full sm:max-w-[480px]">

                        @if (session()->has('message'))
                            <strong>{{ session('message')['text'] }}</strong>
                        @endif
                        <form class="space-y-6" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div>
                                <label for="email"
                                    class="block text-sm font-medium leading-6 text-gray-900 italic">Email</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" required autocomplete="email"
                                        autofocus
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
                                    <input id="email" name="email" type="email" required autocomplete="email"
                                        autofocus
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
