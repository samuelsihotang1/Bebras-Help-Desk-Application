<li class="nav-item ml-4">       
    <a href="{{ route('admin.questions.latest') }}" class="{{ request()->route()->named('admin.questions.latest') ? 'text-danger' : 'text-dark' }}">
        <i class="bi bi-pencil-square" style="font-size: 1.5rem;"></i>
        <span class="badge badge-primary badge-pill">
            {{ $questions ?? 0 }}
        </span>
    </a>
</li>