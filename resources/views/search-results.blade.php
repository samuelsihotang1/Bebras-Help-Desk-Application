@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2>Hasil Pencarian</h2>
    
    @if($questions->isEmpty())
        <p class="text-muted">Tidak ada hasil untuk pencarian "{{ request('q') }}"</p>
    @else
        <ul class="list-group mt-4">
            @foreach($questions as $question)
                <li class="list-group-item">
                    <a href="/{{ $question->title_slug }}">
                        {{ $question->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>

@endsection
