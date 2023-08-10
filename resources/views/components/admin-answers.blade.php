<li class="nav-item ml-4">
  @if (request()->route()->named('admin.answers.latest') || request()->route()->named('admin.answers.most-reported'))
  <a href="{{ route('admin.answers.latest') }}" class="text-danger">
    <i class="bi bi-newspaper" style="font-size: 1.5rem;"></i>
    @else
    <a href="{{ route('admin.answers.latest') }}" class="text-dark">
      <i class="bi bi-newspaper" style="font-size: 1.5rem;"></i>
      @endif
      <span class="badge badge-primary badge-pill">
        @if ($answers)
        @if ($answers > 9)
        9+
        @else
        {{ $answers }}
        @endif
        @else
        0
        @endif
        {{-- {{ $answers ?? 0 }} --}}
      </span>
    </a>
</li>