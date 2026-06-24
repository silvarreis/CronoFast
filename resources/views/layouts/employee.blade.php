<x-app-layout>
    @if($employees->isEmpty())
        <span class="col-12 not-found">
            não a operador cadastrado...
        </span>
        <button data-open="add-employee" class="col-12 btn-not-found">
            CLIQUE AQUI PARA CADASTRAR
        </button>
        <a class="btn-not-found link m-auto col-12" href="/employee">Voltar</a>
    @else
        <div class="col-6 col-sm-12">
            <form action="{{ route('employee.show') }}"  class="d-flex" method="GET">
                <input type="text" class="input-search" name="search" size="40">
                <button class="btn-search" value="1">
                    <x-svgs.search w="21" h="21"/>
                </button>
            </form>
        </div>
        <div class="col-6 col-sm-12">
            <button class="btn flw-right w-sm-100" data-open="add-employee">
                CADASTRAR
            </button>
        </div>
        @foreach($employees as $employee)
            <x-card id="{{ $employee->id }}">
                <x-card.header title="{{ $employee->id }}"/>
                <x-card.body>
                    <p class="text">{{ $employee->name }}</p>
                </x-card.body>   
                <x-card.footer open="edit-employee" id="{{ $employee->id }}"/>
            </x-card>
        @endforeach
    @endif
    <x-modal id="add-employee">
        <x-modal.header title="Formulario adicionar colaborador"/>
        <x-modal.body>
            <x-forms.add-employee/>
        </x-modal.body>
        <x-modal.footer>
            <button class="btn" data-close>Cancelar</button>
            <button class="btn" data-send="form-employee">Salvar</button>
        </x-modal.footer>
    </x-modal>
    <x-modal id="edit-employee">
        <x-modal.header title="Formulario editar colaborador"/>
        <x-modal.body>
            <x-forms.edit-employee/>
        </x-modal.body>
        <x-modal.footer>
            <button class="btn" data-close>Cancelar</button>
            <button class="btn" data-send="form-edit-employee">Salvar</button>
        </x-modal.footer>
    </x-modal>    
</x-app-layout>