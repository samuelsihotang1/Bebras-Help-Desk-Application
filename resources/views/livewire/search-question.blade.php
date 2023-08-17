<div x-data="{ open: false }" style="width: 450px;">
  <div>
    <form action="/search" method="GET">
      <input placeholder="Cari Pertanyaan..." @click="open = true" @click.away="open = false" name="search" type="text"
        class="form-control" wire:model="search">
    </form>
    <div x-show="open"
      style="padding-left: 0.75rem !important;width: 450px; position: absolute; z-index: 10; max-height: 15rem; overflow: auto; border-radius: 0.375rem; background-color: #FFFFFF; font-size: 1rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05), 0 1px 3px 0 rgba(0, 0, 0, 0.1); outline: 1px solid #00000010;">
      @if (isset($questions))
      @foreach ($questions as $question)
      <a href="/{{ $question->title_slug }}"
        style="position: relative; padding-left: 0.75rem !important; padding-right: 2.25rem; color: #1F2937;"
        id="option-0">
        <span style="display: block; line-height: 1 !important;">
          {{ $question->title }}</span>
      </a>
      @endforeach
      @else
      <a style="position: relative; padding-left: 0.75rem !important; padding-right: 2.25rem; color: #1F2937;"
        id="option-0">
        <span style="display: block; margin: 0 !important; padding: 0 !important; line-height: 1 !important;">
          Tidak ada pertanyaan</span>
      </a>
      @endif

      {{-- <a href="/"
        style="position: relative; cursor: default; user-select: none; padding-left: 0.75rem !important; padding-right: 2.25rem; color: #1F2937;"
        id="option-0" role="option" tabindex="-1">
        <span style="display: block; margin: 0 !important; padding: 0 !important; line-height: 0.1 !important;">Leslie
          Alexander</span>
      </a> --}}
    </div>
  </div>
</div>