@extends('layouts.painel')

@section('titulo', 'Editar Ultimate - Painel Valorant')

@section('conteudo')

    <div class="conteudo-topo">
        <div class="conteudo-titulo">
            <h2>Editar ultimate</h2>
        </div>
    </div>

    <div class="form-painel">
        <form method="POST" action="{{ route('ultimates.update', $ultimate->id) }}">
            @csrf
            @method('PUT')

            <div class="campo">
                <label for="agente_id">Agente</label>
                <select name="agente_id" id="agente_id" required>
                    <option value="">Selecione um agente...</option>
                    @foreach ($agentes as $agente)
                        <option value="{{ $agente->id }}" {{ old('agente_id', $ultimate->agente_id) == $agente->id ? 'selected' : '' }}>
                            {{ $agente->nome }}
                        </option>
                    @endforeach
                </select>
                @error('agente_id')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="preco_orbes">Preço em orbes</label>
                <input type="number" min="0" name="preco_orbes" id="preco_orbes" value="{{ old('preco_orbes', $ultimate->preco_orbes) }}" required>
                @error('preco_orbes')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao">{{ old('descricao', $ultimate->descricao) }}</textarea>
                @error('descricao')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="botoes-form">
                <button type="submit" class="botao-salvar">Salvar alterações</button>
                <a href="{{ route('ultimates.index') }}">
                    <button type="button" class="botao-cancelar">Cancelar</button>
                </a>
            </div>
        </form>
    </div>

@endsection
