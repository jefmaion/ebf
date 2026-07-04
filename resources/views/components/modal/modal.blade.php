@props(['id', 'size'])
<div wire:ignore.self class="modal modal-blur fadse" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog {{ $size ?? '' }} {{ $isMobile ? '' : 'modal-dialog-centered'; }} " role="document">
        <div class="modal-content">
        {{ $slot }}
    </div>
    </div>
</div>