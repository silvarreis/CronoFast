<x-guest-layout title="Login">
    <h1 class="title">
        CRONOFAST 
        <span id="icon-copy">&copy;</span> 
    </h1>
    
    <form method="POST" id="form" action="{{ route('login') }}">
        @csrf
        <div id="step-1">
            <input type="email" name="email" placeholder="Email" id="email" >
            <input type="password" name="password" placeholder="Senha" id="password">
        </div>
        <div class="box-btns">
            <a href="/register">Cadastar</a>
            <button type="submit" id="btn">Entrar</button>
        </div>
    </form>
    <p id="copy">Copyright &copy; 2025 - {{ $now }} FORTEX. All rights reserved. Developed by <a href="">Diogo da Silva Oliveira.</a> </p>
</x-guest-layout>

