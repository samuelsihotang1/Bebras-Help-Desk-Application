<div class="card-body">

  @if ($type == 'all')
  <div class="row">
    <div class="col-12">
      Answers sorted by latest
    </div>
  </div>
  <hr>
  @forelse ($answers as $answer)
  <div class="card mt-2">
    <div class="card-body">
      <a href="/{{ $answer->question->title_slug }}#{{ $answer->user->name_slug }}">
        {{ $answer->text }}
      </a>
      <span class="float-right">
        <a href="{{ route('admin.answer.status',['answer' => $answer->id,'status' => 'viewed_by_admin']) }}"
          class="mr-2" onclick="return confirm('Are you sure?')"><i class="bi bi-check-circle text-success"></i></a>
        <a href="{{ route('admin.answer.status',['answer' => $answer->id,'status' => 'deleted_by_admin']) }}"
          onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
      </span>
    </div>
  </div>
  @php
  $page = $loop->iteration;
  @endphp
  @empty
  <div class="text-center mt-2">
    No Answers
  </div>
  @endforelse

  @elseif($type == 'reported')

  <div class="row">
    <div class="col-12">
      Answers sorted by most reported
    </div>
  </div>
  <hr>
  @forelse ($answers as $answer)
  <div class="card mt-2">
    <div class="card-body">
      <span class="float-right badge badge-danger badge-pill">{{ $answer->report_users_count }}</span><br>

      <b>{{ $answer->text }}</b>

      <span class="float-right">
        <a href="{{ route('admin.answer.status',['answer' => $answer->id,'status' => 'viewed_by_admin']) }}"
          class="mr-2" onclick="return confirm('Are you sure?')"><i class="bi bi-check-circle text-success"></i></a>
        <a href="{{ route('admin.answer.status',['answer' => $answer->id,'status' => 'deleted_by_admin']) }}"
          onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
      </span>
      <br>

      <div class="row">
        @foreach ($answer->report_users as $report_user)
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
    No Answers reported
  </div>
  @endforelse

  @endif

  @if ($answers->count() > 0 )
  @if ($page != $count)
  <div class="text-center" wire:click="morePage">
    <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">More</button>
  </div>
  @endif
  @endif

</div>