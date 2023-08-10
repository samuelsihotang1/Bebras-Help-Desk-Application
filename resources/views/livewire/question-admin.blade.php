<div class="card-body">

  @if ($type == 'all')
  <div class="row">
    <div class="col-12">
      Pertanyaan diurutkan berdasarkan yang terbaru
    </div>
  </div>
  <hr>
  @forelse ($questions as $question)
  <div class="card mt-2">
    <div class="card-body">
      <a href="/{{ $question->title_slug }}">
        {{ $question->title }}
      </a>
      <span class="float-right">
        <a href="{{ route('admin.question.status',['question' => $question->id,'status' => 'viewed_by_admin']) }}"
          class="mr-2" onclick="return confirm('Apakah Anda yakin?')"><i class="bi bi-check-circle text-success"></i></a>
        <a href="{{ route('admin.question.status',['question' => $question->id,'status' => 'deleted_by_admin']) }}"
          onclick="return confirm('Apakah Anda yakin?')"><i class="bi bi-x-circle text-danger"></i></a>
      </span>
    </div>
  </div>
  @php
  $page = $loop->iteration;
  @endphp
  @empty
  <div class="text-center mt-2">
    Tidak ada jawaban
  </div>
  @endforelse

  @elseif($type == 'reported')

  <div class="row">
    <div class="col-12">
      Pertanyaan diurutkan berdasarkan yang paling banyak dilaporkan
    </div>
  </div>
  <hr>
  @forelse ($questions as $question)
  <div class="card mt-2">
    <div class="card-body">
      <span class="float-right badge badge-danger badge-pill">{{ $question->report_users_count }}</span>
      <br>
      <b>{{ $question->title }}</b>
      <span class="float-right">
        <a href="{{ route('admin.question.status',['question' => $question->id,'status' => 'viewed_by_admin']) }}"
          class="mr-2" onclick="return confirm('Apakah Anda yakin?')"><i class="bi bi-check-circle text-success"></i></a>
        <a href="{{ route('admin.question.status',['question' => $question->id,'status' => 'deleted_by_admin']) }}"
          onclick="return confirm('Apakah Anda yakin?')"><i class="bi bi-x-circle text-danger"></i></a>
      </span>
      <br>

      <div class="row">
        @foreach ($question->report_users as $report_user)
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
    Tidak ada pertanyaan yang dilaporkan
  </div>
  @endforelse
  @endif

  @if ($questions->count() > 0 )
  @if ($page < $count) <div class="text-center" wire:click="morePage">
    <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">Lebih lanjut</button>
</div>
@endif
@endif


</div>