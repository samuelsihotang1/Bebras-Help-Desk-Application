<li class="nav-item ml-4">
  @if (request()->route()->named('admin.comments.latest') || request()->route()->named('admin.comments.most-reported'))
  <a href="{{ route('admin.comments.latest') }}" class="text-danger">
    <i class="bi bi-chat" style="font-size: 1.5rem;"></i>
    <span class="badge badge-primary badge-pill">
      {{ $comments ?? 0 }}
    </span>
    @else
    <a href="{{ route('admin.comments.latest') }}" class="text-dark">
      <i class="bi bi-chat" style="font-size: 1.5rem;"></i>
      @endif
    </a>
</li>