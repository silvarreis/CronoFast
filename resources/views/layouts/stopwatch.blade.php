<x-app-layout>
    <div class="col-12">
        <div class="cicle">
            <p id="time">00:00:00.00</p>
        </div> 
    </div>
    <div class="col-12 controls">
        <button class="btn" data-action="start">Iniciar</button>
        <button class="btn hidden" data-action="lap">Volta</button>
        <button class="btn hidden" data-action="reset">Zerar</button>
        <button class="btn hidden" data-action="pause">Pausar</button>
        <button class="btn hidden" data-action="continue">Continuar</button>
    </div>
    <div class="col-12" id="box-result-lap">
        <form action="" id="laps" class="card-result-lap" method="post"></form>
    </div>
    <div class="col-12 m-auto">
        <button type="button" class="btn hidden" data-open="add-times">
            CALCULAR
        </button>
    </div>
    <x-modal id="add-times">
        <x-modal.header/>
        <x-modal.body>
            <div class="box">
                <p>Media Aritimetica(selec.):
                    <span id="mean-arithmetic">0.0</span>
                </p>
                <p>Total selecionado:
                    <span id="total-selected">00:00:00.00</span>
                </p>
                <p>Total:
                    <span id="total">00:00:00.00</span>
                </p>
            </div>
            <hr>
            <x-forms.add-parts-times/>
        </x-modal.body>
        <x-modal.footer>
            <button class="btn" data-close>Cancelar</button>
            <button class="btn"  data-time>Salvar</button>
        </x-modal.footer>
    </x-modal>
</x-app-layout>