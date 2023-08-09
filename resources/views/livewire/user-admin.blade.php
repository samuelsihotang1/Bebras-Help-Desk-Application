<div class="card-body">
  @if ($type == 'all')
  <div class="row">
    <div class="col-12">
      Pengguna diurutkan berdasarkan yang terbaru
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
        <a href="{{ route('admin.user.status',['user' => $user->id,'status' => 'deleted_by_admin']) }}"
          onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
      </span>
    </div>
  </div>
  @php
  $page = $loop->iteration;
  @endphp
  @empty
  <div class="text-center mt-2">
    Tidak ada Pengguna
  </div>
  @endforelse

  @if ($users->count() > 0 )
  @if ($page != $count)
  <div class="text-center" wire:click="morePage">
    <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">Lebih lanjut</button>
  </div>
  @endif
  @endif

  @endif
</div>