<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="img/icone-valorant.ico">
    <title>Login - Painel Valorant</title>
    <link rel="stylesheet" href="{{ asset('css/painel.css') }}">
</head>
<body>

    <div class="login-fundo">
        <div class="login-caixa">

            <div>
                <div class="login-cabecalho">
                    <img src="{{ asset('img/logo-valorant.png') }}" alt="Logo Valorant">
                    <h1>Entre como administrador</h1>
                </div>

                @if ($errors->any())
                    <div class="erro-login">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="login-form" method="POST" action="{{ route('login.attempt') }}">
                    @csrf

                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>

                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" required>

                    <button type="submit" class="botao-vermelho">Entrar</button>
                </form>
            </div>

            <div class="login-arte">
                <img src="{{ asset('img/arte-login.png') }}" alt="Arte Valorant">
            </div>

        </div>
    </div>

</body>
</html>
