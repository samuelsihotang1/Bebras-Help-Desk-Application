@extends('layouts.app')

@section('title')
Comments
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-2">
      <div class="card-body">
        <div class="row">
          <div class="col-12" style="font-weight: bold;">
            Sorted by
          </div>
        </div>
        <hr>
          <div class="row">
            <div class="col-12">
                <div class="q-text qu-color--red qu-medium" style="box-sizing: border-box;">
                    <a href="{{ route('admin.comments.latest') }}" class="{{ request()->route()->named('admin.comments.latest') ? 'text-danger font-weight-bold bg-red-trans' : 'text-dark' }}" style="{{ request()->route()->named('admin.comments.latest') ? 'background-color: rgba(255, 0, 0, 0.1); display: inline-block; width: 100%; padding: 5px 10px; border-radius: 5px; font-size: 13px;' : 'display: inline-block; padding: 5px 10px; border-radius: 5px; font-size: 13px;' }}">Latest</a>
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="q-text qu-color--red qu-medium" style="box-sizing: border-box;">
                    <a href="{{ route('admin.comments.most-reported') }}" class="{{ request()->route()->named('admin.comments.most-reported') ? 'text-danger font-weight-bold bg-red-trans' : 'text-dark' }}" style="{{ request()->route()->named('admin.comments.most-reported') ? 'background-color: rgba(255, 0, 0, 0.1); display: inline-block; width: 100%; padding: 5px 10px; border-radius: 5px; font-size: 13px;' : 'display: inline-block; padding: 5px 10px; border-radius: 5px; font-size: 13px;' }}">Most Reported</a>
                </div>
            </div>
        </div>      
      </div>
    </div>
    <div class="col-10">

      @include('layouts.success')

      <div class="card-body">

        @if (request()->route()->named('admin.comments.latest'))

        <div class="row">
          <div class="col-12">
            Comments sorted by latest
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
                class="mr-2" onclick="return confirm('Are you sure?')"><i
                  class="bi bi-check-circle text-success"></i></a>
              <a href="{{ route('admin.comment.status',['comment' => $comment->id,'status' => 'deleted_by_admin']) }}"
                onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
            </span>
          </div>
        </div>
        @empty
        <div class="text-center mt-2">
          No comments
        </div>
        @endforelse

        @elseif(request()->route()->named('admin.comments.most-reported'))

        <div class="row">
          <div class="col-12">
            Comments sorted by most reported
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
                class="mr-2" onclick="return confirm('Are you sure?')"><i
                  class="bi bi-check-circle text-success"></i></a>
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
        @empty
        <div class="text-center mt-2">
          No comments reported
        </div>
        @endforelse

        @endif

      </div>
    </div>

  </div>
</div>
@endsection