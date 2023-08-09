@extends('layouts.app')

@section('title')
Konten Anda
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12" style="font-weight: bold;">
                        Berdasarkan Jenis Konten
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="q-text qu-color--red qu-medium" style="box-sizing: border-box;">
                            <a href="{{ route('content.index') }}" class="{{ request()->route()->named('content.index') ? 'text-danger font-weight-bold' : 'text-dark' }}" style="{{ request()->route()->named('content.index') ? 'background-color: rgba(255, 0, 0, 0.1); display: inline-block; width: 100%; padding: 5px 10px; border-radius: 5px; font-size: 13px;' : 'display: inline-block; padding: 5px 10px; border-radius: 5px; font-size: 13px;' }}">Semua Konten</a>
                        </div>
                    </div>                          
                    <div class="col-12 mt-1">
                        <div class="q-text qu-color--red qu-medium" style="box-sizing: border-box;">
                            <a href="{{ route('content.questions.index') }}" class="{{ request()->route()->named('content.questions.index') ? 'text-danger font-weight-bold bg-red-trans' : 'text-dark' }}" style="{{ request()->route()->named('content.questions.index') ? 'background-color: rgba(255, 0, 0, 0.1); display: inline-block; width: 100%; padding: 5px 10px; border-radius: 5px; font-size: 13px;' : 'display: inline-block; padding: 5px 10px; border-radius: 5px; font-size: 13px;' }}">Pertanyaan</a>
                        </div>
                    </div>
                    <div class="col-12 mt-1">
                        <div class="q-text qu-color--red qu-medium" style="box-sizing: border-box;">
                            <a href="{{ route('content.answers.index') }}" class="{{ request()->route()->named('content.answers.index') ? 'text-danger font-weight-bold bg-red-trans' : 'text-dark' }}" style="{{ request()->route()->named('content.answers.index') ? 'background-color: rgba(255, 0, 0, 0.1); display: inline-block; width: 100%; padding: 5px 10px; border-radius: 5px; font-size: 13px;' : 'display: inline-block; padding: 5px 10px; border-radius: 5px; font-size: 13px;' }}">Jawaban</a>
                        </div>
                    </div>
                </div>                                                 
            </div>
     
        </div>
        <div class="col-7 ml-1">
            @include('layouts.success')

            <div class="card-body">
               
                @if (request()->route()->named('content.questions.index'))

                    <div class="row">
                        <div class="col-12">
                            Pertanyaan Anda
                        </div>
                    </div>
                    <hr>
                    @forelse ($questions as $question)
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('question.show',$question->title_slug) }}">{{ $question->title }}</a><br>
                            <small class="text-secondary">Pertanyaan yang Diajukan {{ $question->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                    <hr>
                    @empty
                    <div class="text-center">Tidak ada pertanyaan</div>
                    @endforelse

                @elseif (request()->route()->named('content.answers.index'))

                    <div class="row">
                        <div class="col-12" >
                            Jawaban Anda
                        </div>
                    </div>
                    <hr>
                    @forelse ($answers as $answer)
                    <div class="row q">
                        <div class="col-12">
                            <span class="text-secondary">Jawaban Anda kepada </span><a href="{{ route('question.show',$answer->question->title_slug) }}"> {{ $answer->question->title }}</a><br>
                            <small class="text-secondary">Sudah Dijawab {{ $answer->question->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                    <hr>
                    @empty
                    <div class="text-center">Tidak ada Jawaban</div>
                    @endforelse

                @elseif (request()->route()->named('content.index'))

                    <div class="row">
                        <div class="col-12">
                            Konten Anda
                        </div>
                    </div>
                    <hr>
                    @forelse ($contents as $content)
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('question.show',$content->title_slug ?? $content->question->title_slug) }}">{{ $content->title ?? $content->question->title }}</a><br>
                            @if ($content->title)
                                <small class="text-secondary">Ditanyakan {{ $content->created_at->format('d M Y') }}</small>
                            @elseif($content->question->title)
                                <small class="text-secondary">Sudah Dijawab {{ $content->created_at->format('d M Y') }}</small>
                            @endif
                        </div>
                    </div>
                    <hr>
                    @empty
                    <div class="text-center">Tidak Ada Konten</div>
                    @endforelse

                @endif

            </div>
        </div>
     
    </div>
</div>
@endsection
