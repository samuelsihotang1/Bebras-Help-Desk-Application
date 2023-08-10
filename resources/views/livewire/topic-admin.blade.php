<div class="card-body">

  @if ($type == 'all')
  <div class="row">
    <div class="col-12">
      Topik diurutkan berdasarkan yang terbaru
    </div>
  </div>
  <hr>
  @forelse ($topics as $topic)
  <div class="card mt-2">
    <div class="card-body">
      <a href="/topic/{{ $topic->name_slug }}">
        {{ $topic->name }}
      </a>
      <span class="float-right">
        <a href="{{ route('admin.topic.status',['topic' => $topic->id,'status' => 'deleted_by_admin']) }}"
          onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
      </span>
    </div>
  </div>
  @php
  $page = $loop->iteration;
  @endphp
  @empty
  <div class="text-center mt-2">
    Tidak ada topik
  </div>
  @endforelse

  @if ($topics->count() > 0 )
  @if ($page < $count) <div class="text-center" wire:click="morePage">
    <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">Lebih lanjut</button>
</div>
@endif
@endif

@endif
</div>