<li class="nav-item ml-4">       
    <a href="{{ route('admin.users.latest') }}"  class="{{ request()->route()->named('admin.users.latest') ? 'text-danger' : 'text-dark' }}">
        <i class="bi bi-people" style="font-size: 1.5rem;"></i>
        <span class="badge badge-primary badge-pill">
            {{ $users ?? 0 }}
        </span>
    </a>
</li>


