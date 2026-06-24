@extends('layouts.painel')

@section('titulo', 'Editar Arma - Painel Valorant')

@section('conteudo')

    <div class="conteudo-topo">
        <div class="conteudo-titulo">
            <h2>Editar arma</h2>
        </div>
    </div>

    <div class="form-painel">
        <form method="POST" action="{{ route('armas.update', $arma->id) }}">
            @csrf
            @method('PUT')

            <div class="campo">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $arma->nome) }}" required>
                @error('nome')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="classe">Classe</label>
                <select name="classe" id="classe" required>
                    <option value="">Selecione...</option>
                    <option value="Pistola" {{ old('classe', $arma->classe) == 'Pistola' ? 'selected' : '' }}>Pistola</option>
                    <option value="Submetralhadora" {{ old('classe', $arma->classe) == 'Submetralhadora' ? 'selected' : '' }}>Submetralhadora</option>
                    <option value="Fuzil" {{ old('classe', $arma->classe) == 'Fuzil' ? 'selected' : '' }}>Fuzil</option>
                    <option value="Escopeta" {{ old('classe', $arma->classe) == 'Escopeta' ? 'selected' : '' }}>Escopeta</option>
                    <option value="Precisao" {{ old('classe', $arma->classe) == 'Precisao' ? 'selected' : '' }}>Precisão</option>
                    <option value="Metralhadora" {{ old('classe', $arma->classe) == 'Metralhadora' ? 'selected' : '' }}>Metralhadora</option>
                </select>
                @error('classe')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="preco">Preço</label>
                <input type="number" step="0.01" min="0" name="preco" id="preco" value="{{ old('preco', $arma->preco) }}" required>
                @error('preco')
                    <div class="campo-erro">{{ $message }}</div>
                @enderror
            </div>

            <div class="botoes-form">
                <button type="submit" class="botao-salvar">Salvar alterações</button>
                <a href="{{ route('armas.index') }}">
                    <button type="button" class="botao-cancelar">Cancelar</button>
                </a>
            </div>
        </form>
    </div>

@endsection
