@extends('layouts.painel')

@section('titulo', 'Armas - Painel Valorant')

@section('conteudo')

    <div class="conteudo-topo">
        <div class="conteudo-titulo">
            <h2>Seja bem vindo(a) ao painel de administração de armas Valorant</h2>
        </div>

        <a href="{{ route('armas.create') }}">
            <button class="botao-adicionar">+ Adicionar arma</button>
        </a>
    </div>

    @if (session('sucesso'))
        <div class="alerta-sucesso">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="caixa-conteudo">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Classe</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($armas as $arma)
                    <tr>
                        <td>{{ $arma->nome }}</td>
                        <td>{{ $arma->classe }}</td>
                        <td>{{ number_format($arma->preco, 2, ',', '.') }}</td>
                        <td>
                            <div class="acoes">
                                <a href="{{ route('armas.edit', $arma->id) }}">
                                    <button class="botao-editar">Editar</button>
                                </a>

                                <form method="POST" action="{{ route('armas.destroy', $arma->id) }}" onsubmit="return confirm('Tem certeza que deseja excluir esta arma?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="botao-excluir">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="vazio">Nenhuma arma cadastrada ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
