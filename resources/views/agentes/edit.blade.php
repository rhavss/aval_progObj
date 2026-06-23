@extends('layouts.painel')

@section('titulo', 'Editar Agente - Painel Valorant')

@section('conteudo')

    <div class="conteudo-topo">
        <div class="conteudo-titulo">
            <h2>Editar agente</h2>
        </div>
    </div>

    <div class="form-painel">
        <form method="POST" action="{{ route('agentes.update', $agente->id) }}">
            @csrf
            @method('PUT')

            <div class="campo">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $agente->nome) }}" required>
                @error('nome')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="funcao">Função</label>
                <select name="funcao" id="funcao" required>
                    <option value="">Selecione...</option>
                    <option value="Duelista" {{ old('funcao', $agente->funcao) == 'Duelista' ? 'selected' : '' }}>Duelista</option>
                    <option value="Sentinela" {{ old('funcao', $agente->funcao) == 'Sentinela' ? 'selected' : '' }}>Sentinela</option>
                    <option value="Controlador" {{ old('funcao', $agente->funcao) == 'Controlador' ? 'selected' : '' }}>Controlador</option>
                    <option value="Iniciador" {{ old('funcao', $agente->funcao) == 'Iniciador' ? 'selected' : '' }}>Iniciador</option>
                </select>
                @error('funcao')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="nacionalidade">Nacionalidade</label>
                <input type="text" name="nacionalidade" id="nacionalidade" value="{{ old('nacionalidade', $agente->nacionalidade) }}" required>
                @error('nacionalidade')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao">{{ old('descricao', $agente->descricao) }}</textarea>
                @error('descricao')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="botoes-form">
                <button type="submit" class="botao-adicionar">Salvar alterações</button>
                <a href="{{ route('agentes.index') }}">
                    <button type="button" class="botao-cancelar">Cancelar</button>
                </a>
            </div>
        </form>
    </div>

@endsection
