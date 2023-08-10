<div class="col-12">
  <div id="answersQuestion">
    <!-- Modal Answer-->
    <form action="" method="POST" id="answer-updateForm" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal fade" id="answer-updateModal" aria-labelledby="answer-updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="answer-updateModalLabel"><b>Edit Jawaban</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <textarea name="text" class="form-control" id="textAnswer" autocomplete="off"></textarea>
                  @include('layouts.error', ['name' => 'text'])
                  <div id="img2">
                    <img id="output2" class="img-fluid mt-2 rounded">
                  </div>
                  <input type="file" name="image" accept="image/*" class="form-control mt-2"
                    onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])"
                    id="image2">
                  @include('layouts.error', ['name' => 'image'])
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal" id="close2">Batal</button>
              <button type="submit" class="btn btn-primary answer-update rounded-pill">Perbarui</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    @php
    if ($answers->count() > 0) {
    $credential = \App\Http\Controllers\User\ProfileController::set_credential($answers[0]->user);
    }
    @endphp

    @if ($answers->count() > 0)
    <div id="{{ $answers[0]->user->name_slug }}">
      <div class="card mt-4">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-sm-1">
                  <img
                    src="{{ (strpos($answers[0]->user->avatar, 'https') === 0) ? $answers[0]->user->avatar : asset('img/' . $answers[0]->user->avatar)}}"
                    alt="avatar" class="rounded-circle" width="45px" height="45px">
                </div>

                <div class="col-sm-11">
                  <b><a href="{{ route('profile.show',$answers[0]->user->name_slug) }}" class="text-dark">{{
                      $answers[0]->user->name }}</a></b>
                  @php
                  //set follow status
                  if(auth()->user()->isFollowing($answers[0]->user)){
                  $status = "Mengikuti";
                  }else{
                  $status = "Ikuti";
                  }
                  @endphp
                  @if ($answers[0]->user_id != auth()->id())
                  &#183;
                  <a href="{{ route('follow',$answers[0]->user->name_slug) }}">{{ $status }}</a>
                  @endif
                  @if ($answers[0]->question->pin_answer == $answers[0]->id)
                  <svg xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 -960 960 960" width="18">
                    <path
                      d="m419-285 291-292-63-64-228 228-111-111-63 64 174 175Zm60.679 226q-86.319 0-163.646-32.604-77.328-32.603-134.577-89.852-57.249-57.249-89.852-134.57Q59-393.346 59-479.862q0-87.41 32.662-164.275 32.663-76.865 90.042-134.438 57.378-57.574 134.411-90.499Q393.147-902 479.336-902q87.55 0 164.839 32.848 77.288 32.849 134.569 90.303 57.281 57.454 90.269 134.523Q902-567.257 902-479.458q0 86.734-32.926 163.544-32.925 76.809-90.499 134.199-57.573 57.39-134.447 90.053Q567.255-59 479.679-59Z"
                      fill="green" />
                  </svg>
                  Jawaban yang dipin
                  @endif
                  <a class="text-dark float-right dropdown-toogle" id="navbarDropdown" href="" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i
                      class="bi bi-three-dots"></i></a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    @if ($answers[0]->user_id == auth()->id())
                    <a href="" data-attr="{{ route('answer.update',$answers[0]->id) }}" class="dropdown-item"
                      data-toggle="modal" data-target="#answer-updateModal" id="answerUpdate"
                      data-text="{{ $answers[0]->text }}" data-img="{{ $answers[0]->image }}">
                      Edit jawaban
                    </a>

                    <a href="{{ route('answer.destroy',$answers[0]->id) }}" class="dropdown-item"
                      onclick="return confirm('Are you sure you want to delete this answer?')">
                      Hapus jawaban
                    </a>
                    @else
                    @php
                    $reported_answer =
                    App\Models\ReportAnswer::where('answer_id',$answers[0]->id)->where('user_id',auth()->id())->first();
                    @endphp
                    @if ($reported_answer)
                    <a class="dropdown-item text-danger">
                      Dilaporkan
                    </a>
                    @else
                    <a href="" class="dropdown-item text-dark" data-toggle="modal" data-target="#report_answerModal"
                      data-attr="{{ route('answer.report',$answers[0]->id) }}" id="reportAnswer">
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
                    {{-- Admin --}}
                    @if (auth()->user()->role == 'admin' && $answers[0]->question->pin_answer != $answers[0]->id)
                    <a href="{{ route('answer.pin',$answers[0]->id) }}" class="dropdown-item">Pin Jawaban</a>
                    @endif

                    @if (auth()->user()->role == 'admin' && $answers[0]->question->pin_answer == $answers[0]->id)
                    <a href="{{ route('answer.deletepin',$answers[0]->id) }}" class="dropdown-item">Hapus Pin</a>
                    @endif
                  </div>
                  <br>

                  <div class="text-secondary">
                    @if ($answers[0]->user->marker == 'super-admin' || $answers[0]->user->marker == 'biro')
                    Pengurus Bebras Biro
                    @elseif ($answers[0]->user->marker == 'pusat')
                    Pengurus Bebras Pusat
                    @elseif ($answers[0]->user->marker == 'guru')
                    Pengajar
                    @endif
                    &#183; {{ $answers[0]->created_at->format('M d Y') }}
                  </div>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-12">
                  {{ $answers[0]->text }}<br>
                  @if ($answers[0]->image)
                  <img src="{{ asset('img/' . $answers[0]->image) }}" class="img-fluid mt-2 mb-2"
                    style="height: 300px;">
                  @else
                  <div class="mb-2"></div>
                  @endif
                </div>
                <small class="col-12 text-secondary">{{ views($answers[0])->count() }} Tampilan</small>
              </div>

              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <div class="btn-group" role="group">
                    <a href="{{ route('answer.vote',['answer' => $answers[0]->id, 'vote' => 'upvote']) }}"
                      class="text-success mr-2" id="upvote"><i
                        class="bi bi-arrow-up-circle{{ auth()->user()->hasUpVoted($answers[0]) ? '-fill' : '' }}"></i>
                      {{ $answers[0]->upVoters()->count() }}</a>
                    <a href="{{ route('answer.vote',['answer' => $answers[0]->id, 'vote' => 'downvote']) }}"
                      class="text-danger mr-4" id="downvote"><i
                        class="bi bi-arrow-down-circle{{ auth()->user()->hasDownVoted($answers[0]) ? '-fill' : '' }}"></i>
                      {{ $answers[0]->downVoters()->count() }}</a>
                    <a href="javascript: void(0)" class="text-secondary" id="comment"><i class="bi bi-chat"></i>
                      {{ $answers[0]->comments->count() }}</a>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="btn-group float-right" role="group">
                    <a href="" class="text-dark" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="bi bi-share"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="javascript: void(0)" onclick="copy()"
                        data-attr="#{{ $answers[0]->user->name_slug }}" id="copyLink">Salin Tautan</a>
                    </div>
                  </div>
                </div>
              </div>

              <div id="show_comment">
                <form action="{{ route('comment.store') }}" method="POST">
                  @csrf
                  <div class="row mt-3">
                    <div class="col-1">
                      <img
                        src="{{ (strpos(auth()->user()->avatar, 'https') === 0) ? auth()->user()->avatar : asset('img/' . auth()->user()->avatar) }}"
                        alt="avatar" class="rounded-circle" width="45px" height="45px">
                    </div>
                    <div class="col-9">
                      <input type="text" class="form-control" placeholder="Tambahkan komentar anda..." name="comment"
                        autocomplete="off">
                      <input type="hidden" name="answer_id" value="{{ $answers[0]->id }}" id="answer_id">
                    </div>
                    <div class="col-2">
                      <button class="btn btn-outline-primary btn-sm py-0 px-2" type="submit">Tambahkan komentar</button>

                    </div>
                  </div>
                  @include('layouts.comment',['comments' => $answers[0]->comments,'answer_id' => $answers[0]->id])
                </form>
              </div>
              <script></script>
            </div>
          </div>
        </div>
      </div>
    </div>
    @php
    $page = 1;
    @endphp
    @endif
  </div>
  @foreach ($answers as $answer)
  @if(!$loop->first)
  @livewire('answered-question-item', ['answer' => $answer], key($answer->id))
  @php
  $page = $loop->iteration;
  @endphp
  @endif
  @endforeach

  @if ($answers->isEmpty())
  <div class="text-center mt-4"><b>Tidak ada jawaban</b></div>
  @endif

  @if ($answers->count() > 0 )
  @if ($page != $count)
  <div class="text-center" wire:click="morePage">
    <button class="btn btn-secondary btn-sm moreHome mt-2 rounded-pill">Lebih lanjut</button>
  </div>
  @endif
  @endif

</div>