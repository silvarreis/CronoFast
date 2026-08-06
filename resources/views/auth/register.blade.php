<x-guest-layout title="Register">
   
    <h1 class="title">CRONOFAST</h1>

    
    <form method="POST" id="form-register" action="{{ route('register') }}">
        @csrf
        <div id="step-1">
            <input type="text" name="name" id="name" placeholder="Nome">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Senha">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar senha">
        </div>
        <div id="step-2" style="display:none">
            <label class="box">
                <div class="left">
                    <input type="radio" name="plan_id" value="1" class="radio">
                    <div>
                        <p class="title-box">CronoFast - Starter</p>
                        <p class="text-box">Cronometragem ilimitada + relatórios em PDF</p>
                    </div>
                </div>
                <p class="price-box">R$ 290,00<span>/mês</span></p>
            </label>
            <label class="box">
                <input type="radio" name="plan_id" value="2" class="radio" disabled>
                <div>
                    <p class="title-box">CronoFast - Business</p>
                    <p class="text-box">Tudo da Starter + Balanceamento de Células + Cálculo de Custo Minuto</p>
                </div>
                <p class="price-box">R$ 590,00<span>/mês</span></p>
            </label>
            <label class="box">
                <input type="radio" name="plan_id" value="3" class="radio" disabled>
                <div>
                    <p class="title-box">CronoFast - Enterprise</p>
                    <p class="text-box">Tudo do Business + Dashboard de Produtividade + Suporte prioritário</p>
                </div>
                <p class="price-box">R$ 1200,00<span>/mês</span></p>
            </label>
        </div>
        <div class="box-btns">
            <button type="button" id="backStep">Voltar</button>
            <div id="info"></div>
            <button type="button" id="nextStep">Continuar</button>
        </div>
    </form>
    
    <p id="copy">&copy; 2025 - {{ $now }} | Dev: <a href="#">Diogo Oliveira</a></p>
    
</x-guest-layout>