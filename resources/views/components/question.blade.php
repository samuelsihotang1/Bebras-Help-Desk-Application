<form action="{{ route('question.store') }}" method="POST">
    @csrf
    <div class="modal fade" id="add-questionModal" aria-labelledby="add-questionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="add-questionModalLabel" style="font-weight: bold;">Tambah Pertanyaan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <b>Tips untuk mendapatkan jawaban yang baik dengan cepat</b><br>
                            <div class="container">
                                <li>Pastikan pertanyaan Anda belum pernah diajukan sebelumnya.</li>
                                <li>Buat pertanyaan Anda dengan singkat dan langsung pada pokoknya.</li>
                                <li>Periksa kembali tata bahasa dan ejaan Anda.</li>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <img src="{{ (strpos(Auth::user()->avatar, 'https') === 0) ? Auth::user()->avatar : asset('img/' . Auth::user()->avatar) }}" alt="avatar" class="rounded-circle mr-2" width="25px" height="25px">
                        {{ Auth::user()->name }} asked (<i class="bi bi-people"></i> Public)
                    </div>
                </div>
            
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <input type="text" name="title" class="form-control" placeholder="Berikan pertanyaan" autocomplete="off" id="q-title">
                            @include('layouts.error', ['name' => 'title'])
                        </div>
                    </div>
                <hr>
                Topik : 
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($topics as $topic)
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $topic->id }}" name="topic_id[]" id="{{ $topic->id }}" id="q-topic">
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
                <button type="button" class="btn btn-light rounded-pill q-cancel" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-outline-primary">Tambah Pertanyaan</button>
            </div>
        </div>
        </div>
    </div>
</form>

