<x-app-layout>
    @if($machines->isEmpty())
        <span class="col-12 not-found">
            não a maquinas cadastrado...
        </span>
        <button data-open="add-machine" class="col-12 btn-not-found">
            CLIQUE AQUI PARA CADASTRAR
        </button>
        <a class="btn-not-found link m-auto col-12" href="/machine">Voltar</a>
    @else
        <div class="col-6 col-sm-12">
            <form action="{{-- route(' machine.show') --}}"  class="d-flex" method="GET">
                <input type="text" class="input-search" name="search" size="40">
                <button class="btn-search" value="1">
                    <x-svgs.search w="21" h="21"/>
                </button>
            </form>
        </div>
        <div class="col-6 col-sm-12">
            <button class="btn flw-right w-sm-100" data-open="add-machine">
                CADASTRAR
            </button>
        </div>
        @foreach($machines as $machine)
            <x-card id="{{ $machine->id }}">
                <x-card.header title="{{ $machine->id }}"/>
                <x-card.body>
                    <p class="text">{{ $machine->name }}</p>
                </x-card.body>   
                <x-card.footer open="edit-machine" id="{{ $machine->id }}"/>
            </x-card>
        @endforeach
    @endif
    <x-modal id="add-machine">
        <x-modal.header title="Formulario para adicionar maquina"/>
        <x-modal.body>
            <x-forms.add-machine/>
        </x-modal.body>
        <x-modal.footer>
            <button class="btn" data-close>Cancelar</button>
            <button class="btn" data-send="form-machine">Salvar</button>
        </x-modal.footer>
    </x-modal>
    <x-modal id="edit-machine">
        <x-modal.header title="Formulario para editar maquina"/>
        <x-modal.body>
            <x-forms.edit-machine/>
        </x-modal.body>
        <x-modal.footer>
            <button class="btn" data-close>Cancelar</button>
            <button class="btn" data-send="form-edit-machine">Salvar</button>
        </x-modal.footer>
    </x-modal>
</x-app-layout>