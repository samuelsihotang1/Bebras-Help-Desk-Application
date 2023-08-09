@extends('layouts.app')

@section('title')
{{ $question->title }}
@endsection

@section('content')
@include('layouts.answer')

<!-- Report Answer Modal -->
@include('layouts.report-answer')

{{-- Report Comment Modal --}}
<form action="" method="POST" id="report-commentForm">
  @csrf
  <div class="modal fade" id="report_commentModal" aria-labelledby="report_commentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="report_commentModalLabel">Laporkan komentar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-check">
            @foreach ($report_comment_types as $report_comment_type)
            <input class="form-check-input" type="radio" name="type" id="{{ $report_comment_type['name'] }}"
              value="{{ $report_comment_type['name'] }}">
            <label class="form-check-label" for="{{ $report_comment_type['name'] }}">
              <b>{{ $report_comment_type['name'] }}</b><br>
              <span class="text-secondary">{{ $report_comment_type['desc'] }}</span>
            </label>
            <br><br>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-text rounded-pill" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill" id="store-reportComment">Kirim</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Edit Comment -->
<form action="" method="POST" id="comment-updateForm">
  @csrf
  @method('PUT')
  <div class="modal fade" id="update_commentModal" aria-labelledby="update_commentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="update_commentModalLabel"><b>Edit Komentar</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <textarea type="text" name="comment" class="form-control" autocomplete="off" id="textComment"></textarea>
              @include('layouts.error', ['name' => 'comment'])
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-text rounded-pill" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill update-comment">Perbarui</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Report Question Modal -->
@include('layouts.report-question')

<!-- Modal Question-->
<form action="{{ route('question.update',$question->title_slug) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="modal fade" id="questionModal" aria-labelledby="questionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="questionModalLabel"><b>Edit Pertanyaan</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <input type="text" name="title" value="{{ $question->title }}" class="form-control" autocomplete="off">
              @include('layouts.error', ['name' => 'title'])
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-text rounded-pill" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill">Perbarui</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal Topic-->
<form action="{{ route('question.update',$question->title_slug) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="modal fade" id="topicModal" aria-labelledby="topicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="topicModalLabel">Edit Topik</h5>
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
                        <input class="form-check-input" type="checkbox" value="{{ $topic->id }}" id="{{ $topic->id }}"
                          name="topic_id[]" @php $checked="" ; foreach($question->topics as $qtopic){
                        if($qtopic->name == $topic->name){
                        $checked = "checked";
                        }
                        }
                        @endphp
                        {{ $checked }}>
                        <label class="form-check-label" for="{{ $topic->id }}">
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
          <button type="submit" class="btn btn-primary rounded-pill">Perbarui</button>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="container">
  <div class="row">
    <div class="col-8">
      <div class="row">
        <div class="col-12">
          @include('layouts.success')
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="row">
                    @foreach ($question->topics as $topic)
                    <div class="col-3 mt-2">
                      <div class="card">
                        <a href="{{ route('topic.show',$topic->name_slug) }}" class="text-secondary text-center">{{
                          $topic->name }}</a>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12">
                  <h4><b>{{ $question->title }}</b></h4>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">

                  @if ($question->user_id != auth()->id())
                  @if ($answered == null)
                  <a href="" data-toggle="modal" data-target="#answerModal"
                    data-attr="{{ route('answer.store',$question->title_slug) }}" id="answer"><i
                      class="bi bi-pencil-square"></i> Jawab</a>
                  @endif
                  @endif

                  <a class="text-dark float-right dropdown-toogle" id="navbarDropdown" href="" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i
                      class="bi bi-three-dots"></i></a>
                  <br>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @if ($question->user_id == auth()->id())
                    <a href="" class="dropdown-item" data-toggle="modal" data-target="#questionModal">
                      Edit Pertanyaan
                    </a>
                    <a href="" class="dropdown-item" data-toggle="modal" data-target="#topicModal">
                      @if (count($question->topics))
                      Edit topik
                      @else
                      Add topik
                      @endif
                    </a>

                    <a href="{{ route('question.destroy',$question->title_slug) }}" class="dropdown-item"
                      onclick="return confirm('Are you sure you want to delete this question?')">
                      Hapus pertanyaan
                    </a>
                    @else

                    @if ($reported_question)
                    <a class="dropdown-item text-danger">
                      Dilaporkan
                    </a>
                    @else
                    <a href="" class="dropdown-item text-dark" data-toggle="modal" data-target="#report_questionModal">
                      Laporkan
                    </a>
                    @endif

                    <a class="dropdown-item">
                      Bookmark
                    </a>

                    <a class="dropdown-item">
                      Sembunyikan
                    </a>
                    @endif

                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-12">
                      {{ $question->answers->count() }} Jawaban
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">

        @livewire('answered-question', [
        'question' => $question,
        ])

      </div>

    </div>
    <div class="col-4">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            Pertanyaan Terkait
          </div>
        </div>
        <hr>
        <div class="row">
          @if ($related_questions)
          @foreach ($related_questions as $related_question)
          <div class="col-12 mb-2">
            <a href="{{ route('question.show',$related_question->title_slug) }}">{{ $related_question->title }}</a>
          </div>
          @endforeach
          @endif

        </div>
      </div>
    </div>

  </div>
</div>
@endsection
@section('script')
<script>
  $(".moreQuestion").click(function () {
        $div = $($(this).data('div')); //div to append
        $link = $(this).data('link'); //current URL

        $page = $(this).data('page'); //get the next page #
        $href = $link + $page; //complete URL
        $.get($href, function (response) { //append data
            $html = $(response).find("#answersQuestion").html();
            $div.append($html);
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });

    //script for answer report form
    $(document).on('click', '#reportAnswer', function () {
        let href = $(this).attr('data-attr');

        $(document).on('click', '#store-reportAnswer', function () {
            $('#report-answerForm').attr('action', href);
        });
    });

    //script for answer edit modal & form
    $(document).on('click', '#answer', function () {
        let href = $(this).attr('data-attr');

        $(document).on('click', '.store', function () {
            $('#answerForm').attr('action', href);
        });
    });

    //script for update answer
    $(document).on('click', '#answerUpdate', function () {
        let href = $(this).attr('data-attr');
        let text = $(this).attr('data-text');

        $('#textAnswer').val(text);
    

        $(document).on('click', '.answer-update', function () {
            $('#answer-updateForm').attr('action', href);
        });
    });

    $('#image2').on('click',function(){
        $('#img2').append("<img id='output2' class='img-fluid mt-2 rounded'>");
    });

    $(document).on('click', '#close2', function () {
        $('#output2').remove();
        $('#image2').val("");
    });


    //script for comment report form
    $(document).on('click', '#reportComment', function () {
        let href = $(this).attr('data-attr');

        $(document).on('click', '#store-reportComment', function () {
            $('#report-commentForm').attr('action', href);
        });
    });

    //script for comment update form
    $(document).on('click', '#updateComment', function () {
        let href = $(this).attr('data-attr');
        let text = $(this).attr('data-text');
        console.log(text);
        $('#textComment').val(text);
        $(document).on('click', '.update-comment', function () {
            $('#comment-updateForm').attr('action', href);
        });
    });

    //script for copy link to clipboard
    function copy() {
        let dummy = document.createElement('input');
        let href = $('#copyLink').attr('data-attr');
        let text = window.location.href + href;

        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);

        alert('Share link copied to clipboard');
    }

</script>
@endsection