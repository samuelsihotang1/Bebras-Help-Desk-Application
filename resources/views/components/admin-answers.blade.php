<li class="nav-item ml-4">
  @if (request()->route()->named('admin.answers.latest') || request()->route()->named('admin.answers.most-reported'))
  <a href="{{ route('admin.answers.latest') }}" class="text-danger">
    @else
    <a href="{{ route('admin.answers.latest') }}" class="text-dark">
      @endif
      <i class="bi bi-newspaper" style="font-size: 1.5rem;"></i>
      <span class="badge badge-primary badge-pill">
        {{ $answers ?? 0 }}
      </span>
    </a>
</li>