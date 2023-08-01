<li class="nav-item ml-4">       
    <a href="{{ route('admin.users.latest') }}" class="text-dark">
        <i class="bi bi-people" style="font-size: 1.5rem;"></i>
        <span class="badge badge-primary badge-pill">
            {{ $users ?? 0 }}
        </span>
    </a>
</li>


