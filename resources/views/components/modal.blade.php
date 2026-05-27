@props(['id' => 'modal-default'])
<div class="modal-container hidden" id="{{ $id }}">
    <div class="modal">
        {{ $slot }}
    </div>
</div>