<x-guest-layout>
    <h1>CRONOFAST</h1>
    <nav>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <input type="email" name="email" placeholder="Email" id="email" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Senha" id="password" required>
            </div>
            <div>
                <a href="/register">Cadastar</a>
            </div>
            <button type="submit">Entrar</button>
        </form>
    </nav>
    <p id="copy"> &copy; 2025 - {{ $now }} | Diogo da Silva Oliveira </p>
</x-guest-layout>
