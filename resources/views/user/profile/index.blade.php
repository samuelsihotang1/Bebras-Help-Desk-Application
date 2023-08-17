@extends('layouts.app')

@section('title')
{{ $user->name }} - Bebras
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-8">
      @include('layouts.success')
      @include('layouts.profile-error', ['name' => 'image'])

      <div class="card-body">
        <div class="row mb-4">
          <div class="col-2" id="picture">
            <div
              class="q-box qu-borderRadius--circle qu-borderAll qu-borderColor--darken Photo___StyledBox-sc-1x7c6d3-0"
              style="box-sizing: border-box; position: relative; width: 100px; height: 100px; overflow: hidden;">
              <img src="{{ (strpos($user->avatar, 'https') === 0) ? $user->avatar : asset('img/' . $user->avatar) }}"
                alt="avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
            </div>
            <small id="btneditPicture">
              <a href="" class="pl-3 text-secondary" data-toggle="modal" data-target="#pictureModal">Edit Gambar</a>
            </small>
          </div>
          <div class="col-10">
            <div class="row">
              <div class="col-12" id="name" data-attr="{{ $user->name_slug }}">
                <b style="font-size: 24px">{{ $user->name }} </b><small id="btneditName"><a href=""
                    class="text-secondary" data-toggle="modal" data-target="#nameModal">Edit</a></small>
              </div>
            </div>
            <div class="row">
              <div class="col-12" id="credential">
                <span style="font-size: 17px">
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
            <div class="row mt-2 mb-2">
              <div class="col-12">
                <span class="text-secondary" style="font-size: 13px">{{ $user->followers()->count() ?? 0 }} Pengikut<i
                    class="bi bi-dot"></i>{{ $user->followings()->count() ?? 0 }} Mengikuti</span><br>
              </div>
            </div>
            <div class="row">
              <div class="col-12" id="desc">
                <span>{{ $user->description ?? 'Tulis deskripsi tentang dirimu' }}</span><br>
                <small id="btneditDesc"><a href="" class="text-secondary" data-toggle="modal"
                    data-target="#descModal">Edit</a></small>
              </div>
            </div>
          </div>

          <!-- Picture Edit Profile -->
          <form action="{{ route('profile.update',['user' => $user->name_slug,'profile' => 'picture']) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="modal fade" id="pictureModal" aria-labelledby="pictureModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="pictureModalLabel">Edit foto profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <div id="img2">
                          <img id="output2" class="img-fluid mt-2 rounded">
                        </div>
                        <input type="file" name="image" accept="image/*" class="form-control mt-2"
                          onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])"
                          id="image2">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <!-- Modal Edit Profile Name -->
          <form action="{{ route('profile.update',['user' => $user->name_slug,'profile' => 'name']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal fade" id="nameModal" aria-labelledby="nameModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="nameModalLabel">Edit nama profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                          autocomplete="off">
                        @include('layouts.error', ['name' => 'name'])
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <!-- Modal Edit Profile Credential-->
          <form action="{{ route('profile.update',['user' => $user->name_slug,'profile' => 'credential']) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="modal fade" id="profileModal" aria-labelledby="profileModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Edit kredensial profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <input type="text" name="credential" class="form-control"
                          placeholder="librarian in New York, reads constanty (60)" value="{{ $user->credential }}"
                          autocomplete="off">
                        @include('layouts.error', ['name' => 'credential'])
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </div>

        <!-- Modal Edit Profile Description -->
        <form action="{{ route('profile.update',['user' => $user->name_slug,'profile' => 'description']) }}"
          method="POST">
          @csrf
          @method('PUT')
          <div class="modal fade" id="descModal" aria-labelledby="descModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="descModalLabel">Edit deskripsi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <textarea name="description" cols="10" rows="10" class="form-control"
                        autocomplete="off">{{ $user->description }}</textarea>
                      @include('layouts.error', ['name' => 'description'])
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <hr>
        <div class="row">
          <div class="col-3">
            <a href="" class="text-dark" id="showAnswers"
              data-href="{{ route('profile.answers.show',$user->name_slug) }}">{{ $user->answers->count() ?? 0}}
              Jawaban</a>
          </div>
          <div class="col-3">
            <a href="" class="text-dark" id="showQuestions"
              data-href="{{ route('profile.questions.show',$user->name_slug) }}">{{ $user->questions->count() ?? 0}}
              Pertanyaan</a>
          </div>
          <div class="col-3">
            0 Bagikan
          </div>
          <div class="col-3">
            <a href="" class="text-dark" id="showTopics"
              data-href="{{ route('profile.topics.show',$user->name_slug) }}">{{ $user->topics->count() ?? 0 }}
              Topik</a>
          </div>
        </div>
        <hr>
        <div class="row" id="showAnswersHtml"></div>
        <div class="row" id="showQuestionsHtml"></div>
        <div class="row" id="showTopicsHtml"></div>
        <span id="noData"><b>Tidak Ada Data</b></span>
        <div class="text-center">
          <div class="spinner-border ajax-loading-2 mt-2 text-danger" role="status">
            <span class="sr-only">Loading...</span>
          </div>
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
          {{-- <div class="row">
            <div class="col-12">
              <i class="bi bi-briefcase mr-2"></i>
              @if ($employment_credential)
              <a href="" class="text-dark" data-toggle="modal" data-target="#employmentModal"> {{
                $employment_credential['credential'] }} <small class="text-secondary">{{ $employment_credential['year']
                  }}</small></a>
              @else
              <a href="" data-toggle="modal" data-target="#employmentModal" id="btnEmployment"> Tambahkan kredensial
                pekerjaan</a>
              @endif
            </div>
          </div>

          <!-- Modal Edit Employment Credential-->
          <form
            action="{{ route('profile.credentials.update', ['user' => $user->name_slug,'credentials' => 'employment']) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="modal fade" id="employmentModal" aria-labelledby="employmentModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="employmentModalLabel">Edit kredensial pekerjaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-body">
                            @if ($user->employment)
                            <div class="row">
                              <div class="col-12">
                                <a href="{{ route('profile.credentials.destroy',['user' => $user->name_slug,'credentials' => 'employment']) }}"
                                  class="btn btn-sm btn-outline-secondary float-right">Hapus</a>
                              </div>
                            </div>
                            @endif

                            <div class="row">
                              <div class="col-12">
                                <label for="">Posisi</label>
                                <input type="text" name="position" class="form-control"
                                  value="{{ $user->employment->position ?? '' }}" autocomplete="off">
                                @include('layouts.error', ['name' => 'position'])
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-12">
                                <label for="">Perusahaan / Organisasi</label>
                                <input type="text" name="company" class="form-control"
                                  value="{{ $user->employment->company ?? '' }}" autocomplete="off">
                                @include('layouts.error', ['name' => 'company'])
                              </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col-12">
                                <label for="">Tahun Mulai</label>
                                <select name="start_year" id="startyear-dropdown" class="form-control">
                                  @if ($user->employment->start_year ?? '')
                                  <option value="{{ $user->employment->start_year }}" selected>
                                    {{ $user->employment->start_year }}</option>
                                  <option value="">----</option>
                                  @endif

                                </select>
                              </div>
                            </div>
                            <div class="row mt-2" id="endyear">
                              <div class="col-12">
                                <label for="">Tahun Berakhir</label>
                                <select name="end_year" id="endyear-dropdown" class="form-control">
                                  @if($user->employment->end_year ?? '')
                                  <option value="{{ $user->employment->end_year }}" selected>
                                    {{ $user->employment->end_year}}</option>
                                  <option value="">----</option>
                                  @else
                                  <option value="" selected>----</option>
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="row mt-4">
                              <div class="col-12">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="1" name="currently"
                                    id="currently" @if ($user->employment->currently ?? '')
                                  @if ($user->employment->currently == true)
                                  {{ 'checked' }}
                                  @else

                                  @endif>
                                  @endif

                                  <label class="form-check-label">
                                    Saya saat ini bekerja di sini
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </form> --}}

          <div class="row mt-2">
            <div class="col-12">
              <i class="bi bi-book mr-2"></i>
              @if ($education_credential)
              <a class="text-dark" href="" data-toggle="modal" data-target="#educationModal"> {{
                $education_credential['credential'] }} <small class="text-secondary">{{
                  $education_credential['year']}}</small></a>
              @else
              <a href="" data-toggle="modal" data-target="#educationModal"> Tambahkan kredensial pendidikan</a>
              @endif
            </div>

            <!-- Modal Edit Education Credential -->
            <form
              action="{{ route('profile.credentials.update',['user' => $user->name_slug, 'credentials' => 'education']) }}"
              method="POST">
              @csrf
              @method('PUT')
              <div class="modal fade" id="educationModal" aria-labelledby="educationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="educationModalLabel">
                        Edit kredensial pendidikan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card">
                        <div class="card-body">
                          @if ($user->education)
                          <div class="row">
                            <div class="col-12">
                              <a href="{{ route('profile.credentials.destroy',['user' => $user->name_slug,'credentials' => 'education']) }}"
                                class="btn btn-sm btn-outline-secondary float-right">Hapus</a>
                            </div>
                          </div>
                          @endif
                          <div class="row">
                            <div class="col-12">
                              <label for="">Perguruan Tinggi</label>
                              <input type="text" name="school" value="{{ $user->education->school ?? '' }}"
                                class="form-control" autocomplete="off">
                              @include('layouts.error', ['name' => 'school'])
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col-12">
                              <label for="">Jurusan</label>
                              <input type="text" name="primary" value="{{ $user->education->primary ?? '' }}"
                                class="form-control" autocomplete="off">
                              @include('layouts.error', ['name' => 'primary'])
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col-12">
                              <label for="">Jenis Gelar</label>
                              <input type="text" name="degree_type" value="{{ $user->education->degree_type ?? '' }}"
                                class="form-control" autocomplete="off">
                              @include('layouts.error', ['name' => 'degree_type'])
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col-12">
                              <label for="">Tahun Kelulusan</label>
                              <select name="graduation_year" id="gradyear-dropdown" class="form-control">
                                @if($user->education->graduation_year ?? '')
                                <option value="{{ $user->education->graduation_year }}" selected>
                                  {{ $user->education->graduation_year}}</option>
                                <option value="" disabled>----</option>
                                @else
                                <option value="" selected>----</option>
                                @for ($i = 2023; $i >= 2000; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                @endif
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

          </div>
          <div class="row mt-2">
            <div class="col-12">
              <i class="bi bi-geo-alt mr-2"></i>
              @if ($location_credential)
              <a class="text-dark" href="" data-toggle="modal" data-target="#locationModal"> {{
                $location_credential['credential'] }} <small class="text-secondary">{{
                  $location_credential['year']}}</small></a>
              @else
              <a href="" data-toggle="modal" data-target="#locationModal">
                Tambahkan kredensial lokasi</a>
              @endif
            </div>

            <!-- Modal Edit Location Credential -->
            <form
              action="{{ route('profile.credentials.update',['user' => $user->name_slug,'credentials' => 'location']) }}"
              method="POST">
              @csrf
              @method('PUT')
              <div class="modal fade" id="locationModal" aria-labelledby="locationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="locationModalLabel">Edit kredensial lokasi </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card">
                        <div class="card-body">
                          @if ($user->location)
                          <div class="row">
                            <div class="col-12">
                              <a href="{{ route('profile.credentials.destroy',['user' => $user->name_slug,'credentials' => 'location']) }}"
                                class="btn btn-sm btn-outline-secondary float-right">Hapus</a>
                            </div>
                          </div>
                          @endif
                          <div class="row">
                            <div class="col-12">
                              <label for="">Lokasi</label>
                              <input type="text" name="location" class="form-control"
                                value="{{ $user->location->location ?? '' }}" autocomplete="off">
                              @include('layouts.error', ['name' => 'location'])
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col-12">
                              <label for="">Tahun Mulai</label>
                              <select name="start_year" id="startyear-dropdown2" class="form-control">
                                @if ($user->location->start_year ?? '')
                                <option value="{{ $user->location->start_year }}" selected>
                                  {{ $user->location->start_year }}</option>
                                <option value="" disabled>----</option>
                                @else
                                <option value="" selected>----</option>
                                @for ($i = 2023; $i >= 2000; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                @endif
                              </select>
                            </div>
                          </div>
                          <div class="row mt-2" id="endyear2">
                            <div class="col-12">
                              <label for="">Tahun Berakhir</label>
                              <select name="end_year" id="endyear-dropdown2" class="form-control">
                                @if($user->location->end_year ?? '')
                                <option value="{{ $user->location->end_year }}" selected>
                                  {{ $user->location->end_year}}</option>
                                <option value="" disabled>----</option>
                                @else
                                <option value="" selected>----</option>
                                @for ($i = 2023; $i >= 2000; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                @endif
                              </select>
                            </div>
                          </div>
                          <div class="row mt-4">
                            <div class="col-12">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="currently"
                                  id="currently2" @if ($user->location->currently ?? '')
                                @if ($user->location->currently == true)
                                {{ 'checked' }}
                                @endif>
                                @endif

                                <label class="form-check-label">
                                  Saya saat ini tinggal di sini
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="row mt-2">
            <div class="col-12">
              <i class="bi bi-calendar mr-2"></i> Bergabung {{ $user->created_at->format('d M Y') }}
            </div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-12">
            Tahu tentang
            <a href="" class="text-dark float-right" data-toggle="modal" data-target="#topicModal"><i
                class="bi bi-pencil-square"></i></a>
            <!-- Modal Add Topics-->
            <form action="{{ route('profile.topics.update',$user->name_slug) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="modal fade" id="topicModal" aria-labelledby="topicModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="topicModalLabel">Tambah Topik</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Topik :
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-body">
                              <div class="row">
                                @foreach ($topics as $topic)
                                <div class="col-sm-3">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $topic->id }}"
                                      name="topic_id[]" @php $checked="" ; foreach($user->topics as $utopic){
                                    if($utopic->name == $topic->name){
                                    $checked = "checked";
                                    }
                                    }
                                    @endphp
                                    {{ $checked }} id="{{ $topic->name }}">
                                    <label class="form-check-label" for="{{ $topic->name }}">
                                      {{ $topic->name }}
                                    </label>
                                  </div>
                                </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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
                Anda belum menambahkan topik apapun.
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
<script>
  //script for hide & show button edit profile name
    $("#btneditName").hide();
    // $("#btneditCredential").hide();
    $("#btneditDesc").hide();
    $("#btneditPicture").hide();

    $('#image2').on('click',function(){
        $('#img2').append("<img id='output2' class='img-fluid mt-2 rounded'>");
    });

    $(document).on('click', '#close2', function () {
        $('#output2').remove();
        $('#image2').val("");
    });

    $("#name").mouseenter(function () {
        $("#btneditName").show();
    });
    $("#name").mouseleave(function () {
        $("#btneditName").hide();
    });
    // $("#credential").mouseenter(function () {
    //     $("#btneditCredential").show();
    // });
    // $("#credential").mouseleave(function () {
    //     $("#btneditCredential").hide();
    // });
    $("#desc").mouseenter(function () {
        $("#btneditDesc").show();
    });
    $("#desc").mouseleave(function () {
        $("#btneditDesc").hide();
    });
    $("#picture").mouseenter(function () {
        $("#btneditPicture").show();
    });
    $("#picture").mouseleave(function () {
        $("#btneditPicture").hide();
    });

    //script for currently checkbox
    if ($("#currently").prop("checked") == true) {
        $("#endyear").hide();
    }
    if ($("#currently2").prop("checked") == true) {
        $("#endyear2").hide();
    }
    $("#currently").on('click', function () {
        if ($(this).prop("checked") == true) {
            $("#endyear").hide();
        } else if ($(this).prop("checked") == false) {
            $("#endyear").show();
        }
    });
    $("#currently2").on('click', function () {
        if ($(this).prop("checked") == true) {
            $("#endyear2").hide();
        } else if ($(this).prop("checked") == false) {
            $("#endyear2").show();
        }
    });

    //script for show years in dropdown
    let startyearDropdown = document.getElementById('startyear-dropdown');
    let endyearDropdown = document.getElementById('endyear-dropdown');
    let startyearDropdown2 = document.getElementById('startyear-dropdown2');
    let endyearDropdown2 = document.getElementById('endyear-dropdown2');
    let gradyearDropdown = document.getElementById('gradyear-dropdown');

    yeardropdown(startyearDropdown);
    yeardropdown(endyearDropdown);
    yeardropdown(startyearDropdown2);
    yeardropdown(endyearDropdown2);
    yeardropdown(gradyearDropdown);

    function yeardropdown(dropdown) {
        let currentYear = new Date().getFullYear();
        let earliestYear = 2000;
        while (currentYear >= earliestYear) {
            let dateOption = document.createElement('option');
            dateOption.text = currentYear;
            dateOption.value = currentYear;
            dropdown.add(dateOption);
            currentYear -= 1;
        }
    }
</script>
@endsection