<x-app-layout>
    @if($operations->isEmpty())
        <span class="col-12 not-found">
           não a operação cadastrada...
        </span> 
        <button data-open="add-operation" class="col-12 btn-not-found">
            CLIQUE AQUI PARA CADASTRAR
        </button>
        <a class="btn-not-found link m-auto col-12" href="/operation">Voltar</a>
    @else
        <div class="col-6 col-sm-12">
            <form action="{{ route('operation.show') }}" class="d-flex" method="get">
                <input type="text" class="input-search" name="search" size="40">
                <button class="btn-search" value="1">
                    <x-svgs.search w="21" h="21"/>
                </button>
            </form>
        </div>
        <div class="col-6 col-sm-12">
            <button class="btn flw-right w-sm-100" data-open="add-operation">
                CADASTRAR
            </button>
        </div>
        
        @foreach($operations as $operation)
            <x-card col="4" id="{{ $operation->id }}">
                <x-card.header title="{{ $operation->id }}"/>
                <x-card.body>
                    <p class="text">{{ $operation->description }}</p>
                </x-card.body>   
                <x-card.footer open="edit-operation" id="{{ $operation->id }}"/>
            </x-card>
        @endforeach
    @endif
    <x-modal id="add-operation">
        <x-modal.header title="Formulario adicionar operações"/>
        <x-modal.body>
            <x-forms.add-operation/>
        </x-modal.body>
        <x-modal.footer>
            <button class="btn" data-close>Cancelar</button>
            <button class="btn" data-send="form-operation">Salvar</button>
        </x-modal.footer>
    </x-modal>
    <x-modal id="edit-operation">
        <x-modal.header title="Formulario editar operações"/>
        <x-modal.body>
            <x-forms.edit-operation/>
        </x-modal.body>
        <x-modal.footer>
            <button class="btn" data-close>Cancelar</button>
            <button class="btn" data-send="form-edit-operation">Salvar</button>
        </x-modal.footer>
    </x-modal>
</x-app-layout>