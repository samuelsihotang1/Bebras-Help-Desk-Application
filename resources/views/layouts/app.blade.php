<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Bebras">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Bebras')</title>

  <!-- Icon -->
  <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
  <link rel="manifest" href="/icon/site.webmanifest">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{ asset('js/share.js') }}"></script>
  <script src="//unpkg.com/alpinejs" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  @yield('link')
  <style>
    @media (max-width: 767px) {
      .custom-navbar {
        background-image: none !important;
        background-color: white !important;
      }
    }

    .dmenu a {
      width: 250px;
    }

    /* Sembunyikan scrollbar di browser WebKit */
    .dropdown-menu::-webkit-scrollbar {
      width: 0.5em;
    }

    .dropdown-menu::-webkit-scrollbar-thumb {
      background-color: transparent;
      /* Warna thumb scrollbar */
    }
  </style>

  @livewireStyles
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top custom-navbar pt-4"
      style="background-image: url('https://github.com/Estomihi100103/forimg/assets/89466828/72f9ee8c-6a46-4c28-af9b-886354c6c89c'); background-size: cover; background-repeat: no-repeat; background-position: center center;">

      <div class="container d-flex justify-content-center" style="height: 70px;">
        <a href="{{ route('home') }}">
          <img class="mx-auto d-block mb-0"
            src="https://github.com/Estomihi100103/forimg/assets/89466828/7e45cf25-d755-4191-81b6-ebc0739042e6"
            alt="Bebras" height="60"></a>

        <a class="navbar-brand mr-5" href="{{ route('home') }}">
          <b class="px-3 text-danger" style="font-weight: bold;">Bebras Help Desk</b>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a href="{{ route('home') }}"
                class="{{ request()->route()->named('home')? 'text-danger': 'text-dark' }} "><i class="bi bi-house-door"
                  style="font-size: 1.5rem;"></i></a>
            </li>
            <li class="nav-item ml-4 mr-4">
              <a href="{{ route('answer.index') }}"
                class="{{ request()->route()->named('answer.index') ||request()->route()->named('question.show')? 'text-danger': 'text-dark' }}"><i
                  class="bi bi-pencil-square" style="font-size: 1.5rem;"></i></a>
            </li>
            <li class="nav-item">

              @livewire('search-question')

              {{-- <input type="text" name="livesearch" class="form-control livesearch" style="width: 450px;"></input>
              --}}
            </li>
            <li class="nav-item ml-4 show">
              <a id="notification" href="javascript: void(0)" class="text-dark" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
              </a>

              <div class="dropdown-menu dropdown-menu-right dmenu" aria-labelledby="notification"
                style="right: 340px;top: 85px;max-height: 75vh; overflow-y: auto;">

                <span class="dropdown-item font-weight-bold mb-n1" style="pointer-events: none;">
                  Pemberitahuan
                </span>

                <div class="dropdown-divider"></div>

                <a href="http://127.0.0.1:8000/admin/answers/latest" class="dropdown-item" style="white-space:unset">
                  <i class="bi bi-pencil-square mr-2 text-dark"></i>
                  <span>
                    List Jawaban List Jawaban List Jawaban List Jawaban List Jawaban List Jawaban List Jawaban
                  </span>
                </a>

                <a href="http://127.0.0.1:8000/admin/questions/latest" class="dropdown-item" style="white-space:unset">
                  <i class="bi bi-newspaper mr-2 text-dark"></i>
                  List Pertanyaan List Pertanyaan List Pertanyaan List Pertanyaan List Pertanyaan List Pertanyaan List
                  Pertanyaan
                </a>

                <a href="http://127.0.0.1:8000/admin/comments/latest" class="dropdown-item" style="white-space:unset">
                  <i class="bi bi-chat mr-2 text-dark"></i>
                  List Komentar List Komentar List Komentar List Komentar List Komentar List Komentar List Komentar
                </a>

                <a href="http://127.0.0.1:8000/admin/users/unapproved" class="dropdown-item" style="white-space:unset">
                  <i class="bi bi-people mr-2 text-dark"></i>
                  List Pengguna List Pengguna List Pengguna List Pengguna List
                </a>

                <div class="dropdown-divider"></div>

                <a href="http://127.0.0.1:8000/admin/users/unapproved" class="dropdown-item" style="white-space:unset">
                  <i class="bi bi-question-circle mr-2 text-dark"></i>
                  Others
                </a>
                <div class="dropdown-divider"></div>
              </div>
            </li>

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown pr-4">
              <a id="navbarDropdown" class="nav-link ml-4" href="javascript: void(0)" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <img
                  src="{{ strpos(Auth::user()->avatar, 'https') === 0 ? Auth::user()->avatar : asset('img/' . Auth::user()->avatar) }}"
                  alt="avatar" class="rounded-circle" width="35px" height="35px">
              </a>

              <div class="dropdown-menu dropdown-menu-right dmenu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('profile.index', Auth::user()->name_slug) }}" class="text-dark">
                  <img
                    src="{{ strpos(Auth::user()->avatar, 'https') === 0 ? Auth::user()->avatar : asset('img/' . Auth::user()->avatar) }}"
                    alt="Profile Image" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 8px;">
                  <b style="font-size: 15px">{{ Auth::user()->name }} <i class="bi bi-chevron-right ml-2"></i></b>
                </a>
                @can('isAdmin')
                <div class="dropdown-divider"></div>
                @php
                $answers =
                App\Models\Answer::whereNull('status')->orWhere('status','updated_by_user')->orWhereHas('report_users')->count();

                $questions =
                App\Models\Question::whereNull('status')->orWhere('status','updated_by_user')->orWhereHas('report_users')->count();

                $comments =
                App\Models\Comment::whereNull('status')->orWhere('status','updated_by_user')->orWhereHas('report_users')->count();

                $topics = App\Models\Topic::whereNull('status')->count();

                $users = App\Models\User::where('approved', '=', 'false')->count();
                @endphp
                @if (request()->route()->named('admin.stats.admin'))
                <a class="dropdown-item" href="{{ route('admin.stats.admin') }}"><i
                    class="bi bi-bar-chart mr-2 text-danger"></i>Statistik</a>
                @else
                <a class="dropdown-item" href="{{ route('admin.stats.admin') }}"><i
                    class="bi bi-bar-chart mr-2"></i>Statistik</a>
                @endif
                @if (request()->route()->named('admin.answers.latest') ||
                request()->route()->named('admin.answers.most-reported'))
                <a href="{{ route('admin.answers.latest') }}" class="dropdown-item">
                  <i class="bi bi-pencil-square mr-2 text-danger"></i>
                  @else
                  <a href="{{ route('admin.answers.latest') }}" class="dropdown-item">
                    <i class="bi bi-pencil-square mr-2 text-dark"></i>
                    @endif
                    List Jawaban
                    @if (!$answers == 0)
                    <span class="badge badge-danger badge-pill">
                      @if ($answers)
                      @if ($answers > 9)
                      9+
                      @else
                      {{ $answers }}
                      @endif
                      @else
                      0
                      @endif
                    </span>
                    @endif
                  </a>

                  @if (request()->route()->named('admin.questions.latest') ||
                  request()->route()->named('admin.questions.most-reported'))
                  <a href="{{ route('admin.questions.latest') }}" class="dropdown-item">
                    <i class="bi bi-newspaper mr-2 text-danger"></i>
                    @else
                    <a href="{{ route('admin.questions.latest') }}" class="dropdown-item">
                      <i class="bi bi-newspaper mr-2 text-dark"></i>
                      @endif
                      List Pertanyaan
                      @if (!$questions == 0)
                      <span class="badge badge-danger badge-pill">
                        @if ($questions)
                        @if ($questions > 9)
                        9+
                        @else
                        {{ $questions }}
                        @endif
                        @else
                        0
                        @endif
                      </span>
                      @endif
                    </a>

                    @if (request()->route()->named('admin.comments.latest') ||
                    request()->route()->named('admin.comments.most-reported'))
                    <a href="{{ route('admin.comments.latest') }}" class="dropdown-item">
                      <i class="bi bi-chat mr-2 text-danger"></i>
                      @else
                      <a href="{{ route('admin.comments.latest') }}" class="dropdown-item">
                        <i class="bi bi-chat mr-2 text-dark"></i>
                        @endif
                        List Komentar
                        @if (!$comments == 0)
                        <span class="badge badge-danger badge-pill">
                          @if ($comments)
                          @if ($comments > 9)
                          9+
                          @else
                          {{ $comments }}
                          @endif
                          @else
                          0
                          @endif
                        </span>
                        @endif
                      </a>

                      @if (request()->route()->named('admin.topics.latest'))
                      <a href="{{ route('admin.topics.latest') }}" class="dropdown-item">
                        <i class="bi bi-journal mr-2 text-danger"></i>
                        @else
                        <a href="{{ route('admin.topics.latest') }}" class="dropdown-item">
                          <i class="bi bi-journal mr-2 text-dark"></i>
                          @endif
                          List Topik
                          @if (!$topics == 0)
                          <span class="badge badge-danger badge-pill">
                            @if ($topics)
                            @if ($topics > 9)
                            9+
                            @else
                            {{ $topics }}
                            @endif
                            @else
                            0
                            @endif
                          </span>
                          @endif
                        </a>

                        @if (request()->route()->named('admin.users.latest') ||
                        request()->route()->named('admin.users.unapproved'))
                        <a href="{{ route('admin.users.unapproved') }}" class="dropdown-item">
                          <i class="bi bi-people mr-2 text-danger"></i>
                          @else
                          <a href="{{ route('admin.users.unapproved') }}" class="dropdown-item">
                            <i class="bi bi-people mr-2 text-dark"></i>
                            @endif
                            List Pengguna
                            @if (!$users == 0)
                            <span class="badge badge-danger badge-pill">
                              @if ($users)
                              @if ($users > 9)
                              9+
                              @else
                              {{ $users }}
                              @endif
                              @else
                              0
                              @endif
                            </span>
                            @endif
                          </a>

                          @if (request()->route()->named('admin.faqs'))
                          <a href="{{ route('admin.faqs') }}" class="dropdown-item">
                            <i class="bi bi-question-circle mr-2 text-danger"></i>
                            @else
                            <a href="{{ route('admin.faqs') }}" class="dropdown-item">
                              <i class="bi bi-question-circle mr-2 text-dark"></i>
                              @endif
                              List FAQ
                            </a>
                            @endcan
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('content.index') }}"><i
                                class="bi bi-journals mr-2"></i>Konten
                              Anda</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('settings.index') }}">Pengaturan</a>
                            @if (Auth::user()->role != 'admin')
                            <a class="dropdown-item" href="{{ route('faq.index') }}">FAQ</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('about') }}">Tentang Kami</a>
                            <a class="dropdown-item font-weight-bold" href="{{ route('logout') }}"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              {{ __('Keluar') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                            </form>
              </div>
            </li>

            <button class="btn btn-sm btn-danger mt-2 " data-toggle="modal" data-target="#add-questionModal"
              style="height: 36px; width:140px">Tambah
              Pertanyaan</button>

            @endguest
          </ul>
        </div>
      </div>
    </nav>


    <main class="py-4">
      @guest
      @else
      <x-question />
      @endguest

      @yield('content')
    </main>
  </div>



  <script>
    let $q = $('.livesearch');

        $q.select2({
            placeholder: 'Pertanyaan Pencarian',
            ajax: {
                url: "/search",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.title_slug, // Gunakan title_slug sebagai nilai value
                                text: item.title // Gunakan title sebagai teks pilihan
                            }
                        })
                    };
                },
                cache: false
            }
        });

        $q.on('select2:select', function(e) {
            // Cek apakah ada nilai yang dipilih sebelum melakukan redirect
            if (e.params.data.id) {
                //Route::get('/{question:title_slug}', [QuestionController::class, 'show'])->name('question.show');
                window.location.href = "/" + e.params.data.id
            }
        });

        $('#formTopic').hide();
        $("#btnTopic").click(function() {
            $('#formTopic').toggle();
        });

        // Menghilangkan tanda panah dropdown setelah inisialisasi Select2
        $('.select2-container .select2-selection--single .select2-selection__arrow').hide();

        $q.on('select2:select', function(e) {
            if (e.params.data.id) {
                window.location.href = "/" + e.params.data.id
            }
        });
  </script>

  {{-- <script>
    let $q = $('.livesearch');

  $q.select2({
      placeholder: 'Pertanyaan Pencarian',
      ajax: {
          url: "/search",
          dataType: 'json',
          delay: 250,
          processResults: function(data) {
              return {
                  results: $.map(data, function(item) {
                      return {
                          id: item.title_slug, // Gunakan title_slug sebagai nilai value
                          text: item.title // Gunakan title sebagai teks pilihan
                      }
                  })
              };
          },
          cache: true
      }
  });

  $q.on('select2:select', function(e) {
      if (e.params.data.id) {
          window.location.href = "/" + e.params.data.id;
      }
  });

  $q.on('select2:selecting', function(e) {
      e.preventDefault(); 
      const searchTerm = $q.val();
      window.location.href = "/search-results?q=" + encodeURIComponent(searchTerm);
  });

  $('#formTopic').hide();
  $("#btnTopic").click(function() {
      $('#formTopic').toggle();
  });

  // Menghilangkan tanda panah dropdown setelah inisialisasi Select2
  $('.select2-container .select2-selection--single .select2-selection__arrow').hide();
  </script> --}}




  @yield('script')
  @livewireScripts

</body>

</html>