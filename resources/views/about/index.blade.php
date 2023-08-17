@extends('layouts.app')
@section('content')

<body>
  <!-- Values section -->
  <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <div
      style="margin-left: auto; margin-right: auto; max-width: 75%; padding-left: 1.5rem; padding-right: 1.5rem; padding-left: 1.5rem; padding-right: 2rem;">
      <div style="text-align: center; margin-left: auto; margin-right: auto; margin-left: 0;">
        <div id="title">
          <div
            style="font-size: 1.875rem; font-weight: bold; letter-spacing: -0.025em; color: #374151; margin-top: 0.75rem; font-size: 2.25rem;">
            {{ $title }}</div>
          @can('isAdmin')
          <small id="btneditTitle"><a href="" class="text-secondary" data-toggle="modal" data-target="#titleModal">Edit
              Judul</a></small>
          @endcan
        </div>
        <div id="desc">
          <p style="margin-top: 1.5rem; font-size: 1.125rem; line-height: 1.75rem; color: #6B7280;">
            {{ $desc }}</p>
          @can('isAdmin')
          <small id="btneditDesc"><a href="" class="text-secondary" data-toggle="modal" data-target="#descModal">Edit
              Deskripsi</a></small>
          @endcan
        </div>
      </div>
    </div>
    <!-- Image section -->
    <div id="picture"
      style="margin-top: 2rem; margin-left: auto; margin-right: auto; padding-left: 2rem; padding-right: 2rem; display: flex; flex-direction: column;justify-content: center;align-items: center;">
      <img src="{{ asset('img/' . $img) }}" alt=""
        style="aspect-ratio: 5/2; width: 75%; object-fit: cover; border-radius: 1.5rem;">
      @can('isAdmin')
      <small id="btneditPicture">
        <a href="" class="pl-3 text-secondary" data-toggle="modal" data-target="#pictureModal">Edit Gambar</a>
      </small>
      @endcan
    </div>
  </div>


  <!-- Modal Edit Profile Title -->
  <form action="{{ route('admin.about.update') }}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade" id="titleModal" aria-labelledby="titleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titleModalLabel">Edit Judul</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <input type="hidden" name="type" value="title">
                <input type="text" name="title" class="form-control" value="{{ $title }}" autocomplete="off">
                @include('layouts.error', ['name' => 'title'])
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

  <!-- Modal Edit Profile Description -->
  <form action="{{ route('admin.about.update') }}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade" id="descModal" aria-labelledby="descModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="descModalLabel">Edit Deskripsi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <input type="hidden" name="type" value="desc">
                <textarea name="desc" rows="15" style="width: 100%;">{{ $desc }}</textarea>
                @include('layouts.error', ['name' => 'desc'])
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

  <!-- Modal Edit Profile Picture -->
  <form action="{{ route('admin.about.update') }}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade" id="pictureModal" aria-labelledby="pictureModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="pictureModalLabel">Edit Judul</h5>
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
                <input type="hidden" name="type" value="image">
                <input type="file" name="image" accept="image/*" class="form-control mt-2"
                  onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])"
                  id="image">
                @include('layouts.error', ['name' => 'image'])
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
</body>
@endsection

@section('script')
<script src="{{ asset('js/profile.js') }}"></script>
<script>
  $("#btneditTitle").hide();
    $("#btneditDesc").hide();
    $("#btneditPicture").hide();

    $("#title").mouseenter(function () {
        $("#btneditTitle").show();
    });
    $("#title").mouseleave(function () {
        $("#btneditTitle").hide();
    });
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
</script>
@endsection