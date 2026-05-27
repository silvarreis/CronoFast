<header>
    <div class="logo">CronoFast</div>
    <x-svgs.menu/>
    <nav class="nav" id="nav">
        <ul class="menu">
            <li>
                <a href="/stopwatch">Cronometro</a>
            </li>
            <li>
                <a href="/refIternal">Referências</a>
            </li>
            <li>
                <a href="/operation">Operações</a>
            </li>
            <li>
                <a href="/employee">Operador</a>
            </li>
            <li>
                <a href="/dashboard">Tempos</a>
            </li>
            <li class="dropdown">
                <div class="dropdown-btn">
                    <p>{{ Auth::user()->name }}</p>
                    <x-svgs.down-arrow/>
                </div>
                <ul class="dropdown-menu">
                    <li id="btn-config-user">Configurações</li>
                    <li id="btn-logout">Sair</li>
                </ul>
            </li>
        </ul>
    </nav>
</header>