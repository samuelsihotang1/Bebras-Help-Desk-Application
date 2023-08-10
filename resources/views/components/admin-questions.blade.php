<li class="nav-item ml-4">
  @if (request()->route()->named('admin.questions.latest') ||
  request()->route()->named('admin.questions.most-reported'))
  <a href="{{ route('admin.questions.latest') }}" class="text-danger">
    <i class="bi bi-pencil-square" style="font-size: 1.5rem;"></i>
    <span class="badge badge-primary badge-pill">
      {{ $questions ?? 0 }}
    </span>
    @else
    <a href="{{ route('admin.questions.latest') }}" class="text-dark">
      <i class="bi bi-pencil-square" style="font-size: 1.5rem;"></i>
      @endif
    </a>
</li>