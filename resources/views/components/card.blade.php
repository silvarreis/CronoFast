@props(['col' => '2'])
    <div class="card col-{{ $col }} col-sm-12" {{ $attributes }}>
    {{ $slot }}
</div>