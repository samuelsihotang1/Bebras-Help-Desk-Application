<div>
  <li class="nav-item ml-4{{ $dmenn }}">
    <a id="notification" href="javascript: void(0)" class="text-dark" role="button" data-toggle="dropdown"
      wire:click="viewedeeeee" aria-haspopup="true" aria-expanded="{{ $aria_expanded }}" v-pre
      style="position: relative;">
      <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
      @if ($unviewed >0)
      <span
        style="position: absolute; top: -5px; right: 0; background-color: red; border-radius: 50%; width: 9.5px; height: 9.5px; display: flex;">
      </span>
      @endif
    </a>

    <div class="dropdown-menu dropdown-menu-right dmenu{{ $show }}" aria-labelledby="notification"
      style="right: 340px;top: 85px;max-height: 75vh; overflow-y: auto;">

      <span class="dropdown-item font-weight-bold mb-n1" style="pointer-events: none;">
        Pemberitahuan
      </span>

      <div class="dropdown-divider"></div>
      @forelse ($notifikasis as $notifikasi)
      @if ($notifikasi->type == 'answer')
      <a href="{{ route('question.show', $notifikasi->slug_link) }}" class="dropdown-item" style="white-space:unset">
        <i class="bi bi-pencil-square mr-2 text-dark"></i>
        {{ $notifikasi->text }}
      </a>
      @elseif($notifikasi->type == 'question')
      <a href="{{ route('question.show', $notifikasi->slug_link) }}" class="dropdown-item" style="white-space:unset">
        <i class="bi bi-newspaper mr-2 text-dark"></i>
        {{ $notifikasi->text }}
      </a>
      @elseif($notifikasi->type == 'comment')
      <a href="{{ route('question.show', $notifikasi->slug_link) }}" class="dropdown-item" style="white-space:unset">
        <i class="bi bi-chat mr-2 text-dark"></i>
        {{ $notifikasi->text }}
      </a>
      @elseif($notifikasi->type == 'user')
      <a href="{{ route('profile.show', $notifikasi->slug_link) }}" class="dropdown-item" style="white-space:unset">
        <i class="bi bi-people mr-2 text-dark"></i>
        {{ $notifikasi->text }}
      </a>
      @elseif($notifikasi->type == 'topic')
      <a href="{{ route('topic.show', $notifikasi->slug_link) }}" class="dropdown-item" style="white-space:unset">
        <i class="bi bi-journal mr-2 text-dark"></i>
        {{ $notifikasi->text }}
      </a>
      {{-- @elseif($notifikasi->type == 'others')
      <a href="http://127.0.0.1:8000/admin/users/unapproved" class="dropdown-item" style="white-space:unset">
        <i class="bi bi-question-circle mr-2 text-dark"></i>
        {{ $notifikasi->text }}
      </a> --}}
      @endif
      @if(!$loop->last)
      <div class="dropdown-divider"></div>
      @endif
      @empty
      <span class="dropdown-item" style="white-space:unset;pointer-events: none;">
        Tidak ada pemberitahuan
      </span>
      @endforelse
    </div>
  </li>
</div>