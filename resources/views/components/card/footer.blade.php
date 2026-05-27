@props(['boxBtn' => 'all', 'id' => 'null', 'open' => 'noFooter'])
<div class="footer">
    <div class="box">
        {{ $slot }}                
    </div>
    <div>
        @if($boxBtn === 'view')
            <button class="btn-card view" data-view="{{ $id }}">
                <x-svgs.optic w="21" h="21"/>
            </button>
        @elseif($boxBtn === 'all')
            <button class="btn-card edit" data-open="{{ $open }}" data-edit="{{ $id }}">
                <x-svgs.edit  w="21" h="21"/>
            </button> 
            <button class="btn-card delete" data-delete="{{ $id }}">
                <x-svgs.delete w="21" h="21"/>
            </button>
        @elseif($boxBtn === 'delete')
            <button class="btn-card delete" data-delete="{{ $id }}">
                <x-svgs.delete w="21" h="21"/>
            </button>
        @endif
        
    </div>    
</div>