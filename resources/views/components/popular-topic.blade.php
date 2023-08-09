
<div class="card">
    <div class="card-header">
        Topik Populer
        <button class="btn btn-sm btn-outline-primary float-right" id="btnTopic">Tambah Topik</button>
    </div>
    <div class="card-body">
        <div id="formTopic">
            <form action="{{ route('create.topic') }}" method="POST">
                @csrf
                <div class="input-group input-group-sm">
                    <input type="text" name="topic_name" class="form-control @error('topic_name') is-invalid @enderror" autocomplete="off">
                    
                    @error('topic_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>

                <button type="submit" class="btn btn-sm btn-primary mt-2 rounded-pill">Create</button>
            </form>
            <hr>
        </div>
        @foreach($topics as $topic)
            <a href="{{ route('topic.show',$topic->name_slug) }}" class="text-dark">{{ $topic->name }} 
                <div class="btn btn-outline-secondary float-right btn-sm rounded-pill">
                {{ $topic->follower }} Pengikut</div></a>
                @if ($loop->last)
                @else
                <hr>
                @endif
        @endforeach
    </div>
</div>



