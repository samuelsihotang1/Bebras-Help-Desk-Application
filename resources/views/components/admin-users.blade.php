<li class="nav-item ml-4">
  @if (request()->route()->named('admin.users.latest') ||
  request()->route()->named('admin.users.unapproved'))
  <a href="{{ route('admin.users.unapproved') }}" class="text-danger">
    <i class="bi bi-people" style="font-size: 1.5rem;"></i>
    <span class="badge badge-primary badge-pill">
      {{ $users ?? 0 }}
    </span>
    @else
    <a href="{{ route('admin.users.unapproved') }}" class="text-dark">
      <i class="bi bi-people" style="font-size: 1.5rem;"></i>
      @endif
    </a>
</li>