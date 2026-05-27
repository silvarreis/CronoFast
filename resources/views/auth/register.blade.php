<x-guest-layout>
    <nav>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <input type="text" name="name" placeholder="Nome" required>
            </div>
            <div>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Senha" required>
            </div>
            <div>
                <input type="password" name="password_confirmation" placeholder="Confirmar senha" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </nav>
    <p id="copy">&copy; 2025 - {{ $now }} | Diogo da Silva Oliveira</p>
</x-guest-layout>
