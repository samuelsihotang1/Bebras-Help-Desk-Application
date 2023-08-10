<li class="nav-item ml-4">
  @if (request()->route()->named('admin.comments.latest') || request()->route()->named('admin.comments.most-reported'))
  <a href="{{ route('admin.comments.latest') }}" class="text-danger">
    <i class="bi bi-chat" style="font-size: 1.5rem;"></i>
    @else
    <a href="{{ route('admin.comments.latest') }}" class="text-dark">
      <i class="bi bi-chat" style="font-size: 1.5rem;"></i>
      @endif
      <span class="badge badge-primary badge-pill">
        @if ($comments)
        @if ($comments > 9)
        9+
        @else
        {{ $comments }}
        @endif
        @else
        0
        @endif
      </span>
    </a>
</li>