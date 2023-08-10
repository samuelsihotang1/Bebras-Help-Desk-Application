@extends('layouts.app')

@section('title')
{{ $user->name }} - Bebras
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-8">
      @include('layouts.success')

      <div class="card-body">
        <div class="row mb-4">
          <div class="col-2">
            <img src="{{ (strpos($user->avatar, 'https') === 0) ? $user->avatar : asset('img/' . $user->avatar) }}"
              alt="avatar" class="rounded-circle mr-2" width="100px" height="100px">
          </div>
          <div class="col-10">
            <div class="row">
              <div class="col-12" id="name" data-attr="{{ $user->name_slug }}">
                <b style="font-size: 24px">{{ $user->name }} </b>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <span style="font-size: 17px" class="text-dark">
                  @if ($user->marker == 'biro')
                  Pengurus Bebras Biro
                  @elseif ($user->marker == 'pusat')
                  Pengurus Bebras Pusat
                  @elseif ($user->marker == 'guru')
                  Pengajar
                  @elseif ($user->marker == 'super-admin')
                  Pengurus Website
                  @endif
                </span>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <span class="text-secondary" style="font-size: 13px">{{ $user->followers()->count() ?? 0 }} Pengikut<i
                    class="bi bi-dot"></i>{{ $user->followings()->count() ?? 0 }} Mengikuti</span><br>
              </div>
            </div>
            <div class="row mb-2 mt-2">
              <div class="col-12">
                <div class="btn-group mr-2" role="group">
                  <a href="{{ route('follow',$user->name_slug) }}" class="btn btn-primary btn-sm rounded-pill">
                    @if (auth()->user()->isFollowing($user))
                    <i class="bi bi-person-check-fill mr-1"></i>
                    {{ ' Mengikuti ' . $user->followers()->count() ?? 0 }}
                    @else
                    <i class="bi bi-person-plus mr-1"></i>
                    {{ ' Ikuti ' . $user->followers()->count() ?? 0 }}
                    @endif
                  </a>
                </div>
                <div class="btn-group mr-2" role="group">
                  <a href="javascript:void(0)" class="btn btn-secondary btn-sm rounded-pill"><i
                      class="bi bi-bell mr-1"></i> Beritahu saya</a>
                </div>
                <div class="btn-group mr-2" role="group">
                  <a href="javascript:void(0)" class="btn btn-secondary btn-sm rounded-pill"><i
                      class="bi bi-question-circle mr-1"></i> Tanyakan Pertanyaan</a>
                </div>
                <a class="text-dark float-right dropdown-toogle" id="navbarDropdown" href="javascript:void(0)"
                  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i
                    class="bi bi-three-dots" style="font-size: 20px"> </i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item">
                    Bisukan {{ $user->name }}
                  </a>
                  <a class="dropdown-item">
                    Blokir
                  </a>
                  <a class="dropdown-item">
                    Laporkan
                  </a>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <span style="font-size: 15px" class="text-secondary">{{ $user->description ?? '' }}</span>
              </div>
            </div>

          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-3">
            <a href="javascript:void(0)" class="text-dark" id="showAnswers"
              data-href="{{ route('profile.answers.show',$user->name_slug) }}">{{ $user->answers->count() ?? 0}}
              Jawaban</a>
          </div>
          <div class="col-3">
            <a href="javascript:void(0)" class="text-dark" id="showQuestions"
              data-href="{{ route('profile.questions.show',$user->name_slug) }}">{{ $user->questions->count() ?? 0}}
              Pertanyaan</a>
          </div>
          <div class="col-3">
            0 Bagikan
          </div>
          <div class="col-3">
            <a href="javascript:void(0)" class="text-dark" id="showTopics"
              data-href="{{ route('profile.topics.show',$user->name_slug) }}">{{ $user->topics->count() ?? 0 }}
              Topik</a>
          </div>
        </div>
        <hr>
        <div class="row" id="showAnswersHtml"></div>
        <div class="row" id="showQuestionsHtml"></div>
        <div class="row" id="showTopicsHtml"></div>
        <span id="noData"><b>
            Tidak Ada Data</b></span>
        <div class="text-center">
          <div class="spinner-border ajax-loading-2 mt-2 text-danger" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          <div class="ajax-loading text mt-2"></div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="mb-2">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              Kredensial & Sorotan
            </div>
          </div>
          <hr>
          @if ($employment_credential ?? '')
          <div class="row">
            <div class="col-12">
              <i class="bi bi-briefcase mr-2" style="font-size: 15px"></i>
              <span class="text-dark"> {{ $employment_credential['credential'] }} <small class="text-secondary">{{
                  $employment_credential['year']}}</small></span>
            </div>
          </div>
          @endif

          @if ($user->education ?? '')
          <div class="row mt-2">
            <div class="col-12">
              <i class="bi bi-book mr-2" style="font-size: 15px"></i>
              <span class="text-dark"> {{ $education_credential['credential'] }} <small class="text-secondary">{{
                  $education_credential['year']}}</small></span>
            </div>
          </div>
          @endif

          @if ($user->location ?? '')
          <div class="row mt-2">
            <div class="col-12">
              <i class="bi bi-geo-alt mr-2" style="font-size: 15px"></i>
              <span class="text-dark"> {{ $location_credential['credential'] }} <small class="text-secondary">{{
                  $location_credential['year']}}</small></span>
            </div>
          </div>
          @endif

          <div class="row mt-2">
            <div class="col-12">
              <i class="bi bi-calendar mr-2" style="font-size: 15px"></i> Bergabung {{ $user->created_at->format('d M
              Y')
              }}
            </div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-12">
            Tahu tentang
          </div>
        </div>
        <hr>
        <div class="container">
          <div class="row">
            @forelse ($user->topics as $topic)
            <div class="col-sm-6">
              <li><b><a href="{{ route('topic.show',$topic->name_slug) }}" class="text-dark">{{ $topic->name }}</a></b>
              </li>
            </div>
            @empty
            <div class="row">
              <div class="col-sm-12">
                Pengguna ini belum menambahkan topik apapun.
              </div>
            </div>
            @endforelse
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/profile.js') }}"></script>
@endsection