@extends('layouts.painel')

@section('titulo', 'Ultimates - Painel Valorant')

@section('conteudo')

    <div class="conteudo-topo">
        <div class="conteudo-titulo">
            <h2>Seja bem vindo(a) ao painel de administração de ultimates Valorant</h2>
        </div>

        <a href="{{ route('ultimates.create') }}">
            <button class="botao-adicionar">+ Adicionar ultimate</button>
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
                    <th>Agente</th>
                    <th>Preço em orbes</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ultimates as $ultimate)
                    <tr>
                        <td>{{ $ultimate->agente->nome ?? '—' }}</td>
                        <td>{{ $ultimate->preco_orbes }}</td>
                        <td>{{ Str::limit($ultimate->descricao, 60) }}</td>
                        <td>
                            <div class="acoes">
                                <a href="{{ route('ultimates.edit', $ultimate->id) }}">
                                    <button class="botao-editar">Editar</button>
                                </a>

                                <form method="POST" action="{{ route('ultimates.destroy', $ultimate->id) }}" onsubmit="return confirm('Tem certeza que deseja excluir esta ultimate?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="botao-excluir">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="vazio">Nenhuma ultimate cadastrada ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
