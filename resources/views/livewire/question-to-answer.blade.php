<div id="questionsAnswer">
  @foreach ($questions as $question)
  <div class="question-row" id="question-{{ $question->id }}">
    <div class="row">
      <div class="col-sm-12">
        <a href="{{ route('question.show',$question->title_slug) }}" class="text-dark">
          <h5><b>{{ $question->title }}</b></h5>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <a href="{{ route('question.show',$question->title_slug) }}"><b class="text-secondary">{{
            $question->answers->count() ? $question->answers->count() . ' Jawaban' : 'No answer yet'}} </b></a> &#183;
        <small>{{ 'Diperbarui terakhir ' . $question->updated_at->diffForHumans() }}</small>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-sm-6">
        <a href="" data-toggle="modal" data-target="#answerModal"
          data-attr="{{ route('answer.store',$question->title_slug) }}" id="answer"><i class="bi bi-pencil-square"></i>
          Jawaban</a>
      </div>
    </div>
    <hr>
  </div>
  @php
  $page = $loop->iteration;
  @endphp
  @endforeach

  @if ($questions->count() > 0 )
  @if ($page < $count) <div class="text-center" wire:click="morePage">
    <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">Lebih lanjut</button>
</div>
@endif
@endif
</div>