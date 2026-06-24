<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="img/icone-valorant.ico">
    <title>@yield('titulo', 'Painel Valorant')</title>
    <link rel="stylesheet" href="{{ asset('css/painel.css') }}">
</head>
<body>

    <div class="painel">

        <div class="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('img/logo-valorant.png') }}" alt="Logo Valorant">
            </div>

            <div class="sidebar-menu">
                <a href="{{ route('agentes.index') }}" class="sidebar-link {{ request()->routeIs('agentes.*') ? 'ativo' : '' }}">
                    <img src="{{ asset('img/icone-agentes.png') }}" alt="" class="sidebar-icone">
                    Agentes
                </a>

                <a href="{{ route('armas.index') }}" class="sidebar-link {{ request()->routeIs('armas.*') ? 'ativo' : '' }}">
                    <img src="{{ asset('img/icone-armas.png') }}" alt="" class="sidebar-icone">
                    Armas
                </a>

                <a href="{{ route('ultimates.index') }}" class="sidebar-link {{ request()->routeIs('ultimates.*') ? 'ativo' : '' }}">
                    <img src="{{ asset('img/icone-ultimates.png') }}" alt="" class="sidebar-icone">
                    Ultimates
                </a>
            </div>

            <div class="sidebar-sair">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <img src="{{ asset('img/icone-sair.png') }}" alt="" class="sidebar-icone">
                        Sair
                    </button>
                </form>
            </div>
        </div>

        <div class="conteudo">
            @yield('conteudo')
        </div>

    </div>

</body>
</html>
