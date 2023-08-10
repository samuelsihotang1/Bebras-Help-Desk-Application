<li class="nav-item ml-4">
  <a href="{{ route('admin.topics.latest') }}"
    class="{{ request()->route()->named('admin.topics.latest') ? 'text-danger' : 'text-dark' }}">
    <i class="bi bi-journal" style="font-size: 1.5rem;"></i>
    @if (request()->route()->named('admin.topics.latest'))
    <span class="badge badge-primary badge-pill">
      {{ $topics ?? 0 }}
    </span>
    @endif
  </a>
</li>