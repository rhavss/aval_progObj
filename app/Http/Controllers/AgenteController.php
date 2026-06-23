<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use Illuminate\Http\Request;

class AgenteController extends Controller
{
    // lista todos os agentes cadastrados
    public function index()
    {
        $agentes = Agente::orderBy('nome')->get();

        return view('agentes.index', compact('agentes'));
    }

    // mostra o formulario de cadastro
    public function create()
    {
        return view('agentes.create');
    }

    // salva um novo agente no banco
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'funcao' => 'required|in:Duelista,Sentinela,Controlador,Iniciador',
            'nacionalidade' => 'required|string|max:100',
            'descricao' => 'nullable|string',
        ]);

        Agente::create($request->all());

        return redirect()->route('agentes.index')->with('sucesso', 'Agente cadastrado com sucesso!');
    }

    // mostra o formulario de edicao com os dados do agente ja preenchidos
    public function edit(Agente $agente)
    {
        return view('agentes.edit', compact('agente'));
    }

    // atualiza os dados do agente
    public function update(Request $request, Agente $agente)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'funcao' => 'required|in:Duelista,Sentinela,Controlador,Iniciador',
            'nacionalidade' => 'required|string|max:100',
            'descricao' => 'nullable|string',
        ]);

        $agente->update($request->all());

        return redirect()->route('agentes.index')->with('sucesso', 'Agente atualizado com sucesso!');
    }

    // remove o agente do banco
    public function destroy(Agente $agente)
    {
        $agente->delete();

        return redirect()->route('agentes.index')->with('sucesso', 'Agente removido com sucesso!');
    }
}
