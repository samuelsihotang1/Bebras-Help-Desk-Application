<li class="nav-item ml-4">
  @if (request()->route()->named('admin.users.latest') ||
  request()->route()->named('admin.users.unapproved'))
  <a href="{{ route('admin.users.unapproved') }}" class="text-danger">
    <i class="bi bi-people" style="font-size: 1.5rem;"></i>
    @else
    <a href="{{ route('admin.users.unapproved') }}" class="text-dark">
      <i class="bi bi-people" style="font-size: 1.5rem;"></i>
      @endif
      <span class="badge badge-primary badge-pill">
        @if ($users)
        @if ($users > 9)
        9+
        @else
        {{ $users }}
        @endif
        @else
        0
        @endif
      </span>
    </a>
</li>