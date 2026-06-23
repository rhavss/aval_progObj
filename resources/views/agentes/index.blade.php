@extends('layouts.painel')

@section('titulo', 'Agentes - Painel Valorant')

@section('conteudo')

    <div class="conteudo-topo">
        <div class="conteudo-titulo">
            <h2>Seja bem vindo(a) ao painel de administração de agentes Valorant</h2>
        </div>

        <a href="{{ route('agentes.create') }}">
            <button class="botao-adicionar">+ Adicionar agente</button>
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
                    <th>Função</th>
                    <th>Nacionalidade</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($agentes as $agente)
                    <tr>
                        <td>{{ $agente->nome }}</td>
                        <td>{{ $agente->funcao }}</td>
                        <td>{{ $agente->nacionalidade }}</td>
                        <td>{{ Str::limit($agente->descricao, 60) }}</td>
                        <td>
                            <div class="acoes">
                                <a href="{{ route('agentes.edit', $agente->id) }}">
                                    <button class="botao-editar">Editar</button>
                                </a>

                                <form method="POST" action="{{ route('agentes.destroy', $agente->id) }}" onsubmit="return confirm('Tem certeza que deseja excluir este agente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="botao-excluir">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="vazio">Nenhum agente cadastrado ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
