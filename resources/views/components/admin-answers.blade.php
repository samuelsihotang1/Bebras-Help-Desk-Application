
<li class="nav-item ml-4">
    <a href="{{ route('admin.answers.latest') }}" class="{{ request()->route()->named('admin.answers.latest') ? 'text-danger' : 'text-dark' }}">
        <i class="bi bi-newspaper" style="font-size: 1.5rem;"></i>
        <span class="badge badge-primary badge-pill">
            {{ $answers ?? 0 }}
        </span>
    </a>
</li>



