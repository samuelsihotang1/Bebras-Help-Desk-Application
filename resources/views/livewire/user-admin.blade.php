<div class="card-body">
  <div class="row col-3">
    <span>
      Cari Pengguna
      <input type="text" name="search" class="form-control" wire:model="search">
    </span>
  </div>
  <br>
  @if ($type == 'all')
  <div class="row">
    <div class="col-12">
      Pengguna diurutkan berdasarkan yang terbaru
      <span class="float-right">
        <a href="" class="mr-2" data-toggle="modal" data-target="#add-userModal">Buat baru</a>
      </span>
    </div>
  </div>
  <hr>
  @forelse ($users as $user)
  <div class="card mt-2">
    <div class="card-body">
      <a href="/profile/{{ $user->name_slug }}">
        {{ $user->name }}
      </a>
      @if ($user->approved == 'true')
      <i class="bi bi-check-circle text-success"> Telah Disetujui</i>
      @endif
      <span class="float-right">
        @if ($user->approved == 'false')
        <a href="{{ route('admin.user.status',['user' => $user->id,'status' => 'approved']) }}"
          onclick="return confirm('Apakah Anda yakin?')"><i class="bi bi-check-circle text-success">Setujui</i></a>
        @endif
        <a href="" class="mr-2" data-toggle="modal" data-target="#edit-user{{ $loop->iteration }}Modal"><i
            class="bi bi-pencil">Edit</i></a>
        <a href="{{ route('admin.user.status',['user' => $user->id,'status' => 'deleted_by_admin']) }}"
          onclick="return confirm('Apakah Anda yakin?')"><i class="bi bi-x-circle text-danger">Hapus</i></a>
      </span>
    </div>
  </div>

  <!-- Modal Update User-->
  <form action="{{ route('admin.users.update') }}" method="POST">
    @csrf
    <div class="modal fade" id="edit-user{{ $loop->iteration }}Modal"
      aria-labelledby="edit-user{{ $loop->iteration }}ModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edit-user{{ $loop->iteration }}ModalLabel">Update User</h5>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                Name :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="q-name">
                @include('layouts.error', ['name' => 'name'])
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-12">
                Email :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="q-email">
                @include('layouts.error', ['name' => 'email'])
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-12">
                Password :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <input type="password" name="password" class="form-control" id="q-password">
                @include('layouts.error', ['name' => 'password'])
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-12">
                Konfirmasi Password :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <input type="password" name="password_confirmation" class="form-control" id="q-password_confirmation">
                @include('layouts.error', ['name' => 'password_confirmation'])
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-12">
                Marker :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <select name="marker" id="marker-dropdown" class="form-control">
                  <option value="guru" {{ $user->marker == 'guru' ? 'selected' : '' }}>Pengajar</option>
                  <option value="biro" {{ $user->marker == 'biro' ? 'selected' : '' }}>Pengurus Bebras Biro</option>
                  <option value="pusat" {{ $user->marker == 'pusat' ? 'selected' : '' }}>Pengurus Bebras Pusat</option>
                  @if (Auth::user()->marker == 'super-admin')
                  <option value="super-admin" {{ $user->marker == 'super-admin' ? 'selected' : '' }}>Super Admin
                  </option>
                  @endif
                </select>
                @include('layouts.error', ['name' => 'marker'])
              </div>
            </div>
            <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light rounded-pill q-cancel" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary rounded-pill">Update User</button>
          </div>
        </div>
      </div>
    </div>
  </form>


  @php
  $page = $loop->iteration;
  @endphp
  @empty
  <div class="text-center mt-2">
    Tidak ada Pengguna
  </div>
  @endforelse

  @if ($users->count() > 0 )
  @if ($page < $count) <div class="text-center" wire:click="morePage">
    <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">Lebih lanjut</button>
</div>
@endif
@endif

@elseif ($type == 'unapproved')
<div class="row">
  <div class="col-12">
    Pengguna yang telah mendaftar namun belum disetujui oleh admin
    <span class="float-right">
      <a href="" class="mr-2" data-toggle="modal" data-target="#add-userModal">Buat baru</a>
    </span>
  </div>
</div>
<hr>
@forelse ($users as $user)
<div class="card mt-2">
  <div class="card-body">
    <a href="/profile/{{ $user->name_slug }}">
      {{ $user->name }}
    </a>
    <span class="float-right">
      @if ($user->approved == 'false')
      <a href="{{ route('admin.user.status',['user' => $user->id,'status' => 'approved']) }}"
        onclick="return confirm('Apakah Anda yakin?')"><i class="bi bi-check-circle text-success">Setujui</i></a>
      @endif
      <a href="" class="mr-2" data-toggle="modal" data-target="#edit-user{{ $loop->iteration }}Modal"><i
          class="bi bi-pencil">Edit</i></a>
      <a href="{{ route('admin.user.status',['user' => $user->id,'status' => 'deleted_by_admin']) }}"
        onclick="return confirm('Apakah Anda yakin?')"><i class="bi bi-x-circle text-danger">Hapus</i></a>
    </span>
  </div>
</div>

<!-- Modal Update User-->
<form action="{{ route('admin.users.update') }}" method="POST">
  @csrf
  <div class="modal fade" id="edit-user{{ $loop->iteration }}Modal"
    aria-labelledby="edit-user{{ $loop->iteration }}ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit-user{{ $loop->iteration }}ModalLabel">Tambah User</h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              Name :
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-sm-12">
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="q-name">
              @include('layouts.error', ['name' => 'name'])
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-sm-12">
              Email :
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-sm-12">
              <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="q-email">
              @include('layouts.error', ['name' => 'email'])
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-sm-12">
              Password :
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-sm-12">
              <input type="password" name="password" class="form-control" id="q-password">
              @include('layouts.error', ['name' => 'password'])
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-sm-12">
              Konfirmasi Password :
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-sm-12">
              <input type="password" name="password_confirmation" class="form-control" id="q-password_confirmation">
              @include('layouts.error', ['name' => 'password_confirmation'])
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-sm-12">
              Marker :
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-sm-12">
              <select name="marker" id="marker-dropdown" class="form-control">
                <option value="guru" {{ $user->marker == 'guru' ? 'selected' : '' }}>Pengajar</option>
                <option value="biro" {{ $user->marker == 'biro' ? 'selected' : '' }}>Pengurus Bebras Biro</option>
                <option value="pusat" {{ $user->marker == 'pusat' ? 'selected' : '' }}>Pengurus Bebras Pusat</option>
                @if (Auth::user()->marker == 'super-admin')
                <option value="super-admin" {{ $user->marker == 'super-admin' ? 'selected' : '' }}>Super Admin
                </option>
                @endif
              </select>
              @include('layouts.error', ['name' => 'marker'])
            </div>
          </div>
          <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light rounded-pill q-cancel" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill">Update User</button>
        </div>
      </div>
    </div>
  </div>
</form>


@php
$page = $loop->iteration;
@endphp
@empty
<div class="text-center mt-2">
  Tidak ada Pengguna
</div>
@endforelse

@if ($users->count() > 0 )
@if ($page < $count) <div class="text-center" wire:click="morePage">
  <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">Lebih lanjut</button>
  </div>
  @endif
  @endif

  @endif

  <form action="{{ route('admin.users.register') }}" method="POST">
    @csrf
    <div class="modal fade" id="add-userModal" aria-labelledby="add-userModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="add-userModalLabel">Tambah User</h5>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                Name :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <input type="text" name="name" class="form-control" id="q-name">
                @include('layouts.error', ['name' => 'name'])
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-12">
                Email :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <input type="email" name="email" class="form-control" id="q-email">
                @include('layouts.error', ['name' => 'email'])
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-12">
                Password :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <input type="password" name="password" class="form-control" id="q-password">
                @include('layouts.error', ['name' => 'password'])
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-12">
                Konfirmasi Password :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <input type="password" name="password_confirmation" class="form-control" id="q-password_confirmation">
                @include('layouts.error', ['name' => 'password_confirmation'])
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-12">
                Marker :
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <select name="marker" id="marker-dropdown" class="form-control">
                  <option value="">---</option>
                  <option value="guru">Pengajar</option>
                  <option value="biro">Pengurus Bebras Biro</option>
                  <option value="pusat">Pengurus Bebras Pusat</option>
                  @if (Auth::user()->marker == 'super-admin')
                  <option value="super-admin">Super Admin</option>
                  @endif
                </select>
                @include('layouts.error', ['name' => 'marker'])
              </div>
            </div>
            <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light rounded-pill q-cancel" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary rounded-pill">Tambah User</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  </div>