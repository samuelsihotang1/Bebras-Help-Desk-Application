<li class="nav-item ml-4">
    <a href="{{ route('admin.faqs') }}" class="{{ request()->route()->named('admin.faqs') ? 'text-danger' : 'text-dark' }}">
        <i class="bi bi-question-circle"style="font-size: 1.5rem;"></i>
        <span class="badge badge-primary badge-pill">
            {{ $faqs ?? 0 }}
        </span>
    </a>
</li>
