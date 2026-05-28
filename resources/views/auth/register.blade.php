<x-guest-layout title="Register">
   
    <h1 class="title">CRONOFAST</h1>

    <form method="POST" id="form" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" id="name" placeholder="Nome">
        <input type="email" name="email" id="email" placeholder="Email">
        <input type="password" name="password" id="password" placeholder="Senha">
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar senha">
        <button type="submit">Cadastrar</button>
        <a href="/login">Voltar</a>
    </form>

    <p id="copy">&copy; 2025 - {{ $now }} | Diogo da Silva Oliveira</p>
    
</x-guest-layout>
