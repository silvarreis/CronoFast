<x-app-layout>
    @if($refIternals->isEmpty())
        <span class="col-12 not-found">
           não a referencia cadastrada...
        </span>
        <button data-open="add-refIternal" class="col-12 btn-not-found">
            CLIQUE AQUI PARA CADASTRAR
        </button>
        <a class="btn-not-found link m-auto col-12" href="/refIternal">Voltar</a>
    @else
        <div class="col-6 col-sm-12">
            <form action="{{ route('refIternal.show') }}"  class="d-flex" method="GET">
                <input type="text" class="input-search" name="search" size="40">
                <button class="btn-search" value="1">
                    <x-svgs.search w="21" h="21"/>
                </button>
            </form>
        </div>
        <div class="col-6 col-sm-12">
            <button class="btn flw-right w-sm-100" data-open="add-refIternal">
                CADASTRAR
            </button>
        </div>
        
        @foreach($refIternals as $refIternal)
            <x-card id="{{ $refIternal->id }}">
                <x-card.header title="{{ $refIternal->id }}"/>
                <x-card.body>
                    <p class="text">{{ $refIternal->ref_code }}</p>
                </x-card.body>   
                <x-card.footer open="edit-refIternal" id="{{ $refIternal->id }}"/>
            </x-card>
        @endforeach
    @endif
    <x-modal id="add-refIternal">
        <x-modal.header title="Formulario adicionar referencia interna"/>
        <x-modal.body>
            <x-forms.add-ref-iternal/>
        </x-modal.body>
        <x-modal.footer>
            <button class="btn" data-close>Cancelar</button>
            <button class="btn" data-send="add-refiternal">Salvar</button>
        </x-modal.footer>
    </x-modal>
    <x-modal id="edit-refIternal">
        <x-modal.header title="Formulario editar referencia interna"/>
        <x-modal.body>
            <x-forms.edit-ref-iternal/>
        </x-modal.body>
        <x-modal.footer>
            <button class="btn" data-close>Cancelar</button>
            <button class="btn" data-send="form-edit-refIternal">Salvar</button>
        </x-modal.footer>
    </x-modal>  
</x-app-layout>