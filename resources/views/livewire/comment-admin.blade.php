<div class="card-body">

  @if ($type == 'all')

  <div class="row">
    <div class="col-12">
      Komentar diurutkan berdasarkan yang terbaru
    </div>
  </div>
  <hr>
  @forelse ($comments as $comment)
  <div class="card mt-2">
    <div class="card-body">
      <a
        href="/{{ App\Models\Answer::where('id',$comment->commentable_id)->first()->question->title_slug }}#{{ $comment->id }}">
        {{ $comment->comment }}
      </a>
      <span class="float-right">
        <a href="{{ route('admin.comment.status',['comment' => $comment->id,'status' => 'viewed_by_admin']) }}"
          class="mr-2" onclick="return confirm('Are you sure?')"><i class="bi bi-check-circle text-success"></i></a>
        <a href="{{ route('admin.comment.status',['comment' => $comment->id,'status' => 'deleted_by_admin']) }}"
          onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
      </span>
    </div>
  </div>
  @php
  $page = $loop->iteration;
  @endphp
  @empty
  <div class="text-center mt-2">
    Tidak ada komentar
  </div>
  @endforelse

  @elseif($type == 'reported')

  <div class="row">
    <div class="col-12">
      Komentar diurutkan berdasarkan yang paling banyak dilaporkan
    </div>
  </div>
  <hr>
  @forelse ($comments as $comment)
  <div class="card mt-2">
    <div class="card-body">
      <span class="float-right badge badge-danger badge-pill">{{ $comment->report_users_count }}</span><br>

      <b>{{ $comment->comment }}</b>

      <span class="float-right">
        <a href="{{ route('admin.comment.status',['comment' => $comment->id,'status' => 'viewed_by_admin']) }}"
          class="mr-2" onclick="return confirm('Are you sure?')"><i class="bi bi-check-circle text-success"></i></a>
        <a href="{{ route('admin.comment.status',['comment' => $comment->id,'status' => 'deleted_by_admin']) }}"
          onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
      </span>
      <br>

      <div class="row">
        @foreach ($comment->report_users as $report_user)
        <div class="col-4 mt-3">
          <div class="card">
            <span class="text-secondary text-center">
              {{ $report_user->pivot->type }}
            </span>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
  @php
  $page = $loop->iteration;
  @endphp
  @empty
  <div class="text-center mt-2">
    Tidak ada komentar yang dilaporkan
  </div>
  @endforelse

  @endif

  @if ($comments->count() > 0 )
  @if ($page < $count) <div class="text-center" wire:click="morePage">
    <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">Lebih lanjut</button>
</div>
@endif
@endif

</div>