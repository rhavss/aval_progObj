<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use Illuminate\Http\Request;

class AgenteController extends Controller
{
    public function index()
    {
        $agentes = Agente::orderBy('nome')->get();

        return view('agentes.index', compact('agentes'));
    }

    public function create()
    {
        return view('agentes.create');
    }

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

    public function edit(Agente $agente)
    {
        return view('agentes.edit', compact('agente'));
    }

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

    public function destroy(Agente $agente)
    {
        $agente->delete();

        return redirect()->route('agentes.index')->with('sucesso', 'Agente removido com sucesso!');
    }
}
