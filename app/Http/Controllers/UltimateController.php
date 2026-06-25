<?php

namespace App\Http\Controllers;

use App\Models\Ultimate;
use App\Models\Agente;
use Illuminate\Http\Request;

class UltimateController extends Controller
{
    public function index()
    {
        $ultimates = Ultimate::with('agente')->orderBy('id')->get();

        return view('ultimates.index', compact('ultimates'));
    }

    public function create()
    {
        $agentes = Agente::orderBy('nome')->get();

        return view('ultimates.create', compact('agentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agente_id' => 'required|exists:agentes,id',
            'preco_orbes' => 'required|integer|min:0',
            'descricao' => 'nullable|string',
        ]);

        Ultimate::create($request->all());

        return redirect()->route('ultimates.index')->with('sucesso', 'Ultimate cadastrada com sucesso!');
    }

    public function edit(Ultimate $ultimate)
    {
        $agentes = Agente::orderBy('nome')->get();

        return view('ultimates.edit', compact('ultimate', 'agentes'));
    }

    public function update(Request $request, Ultimate $ultimate)
    {
        $request->validate([
            'agente_id' => 'required|exists:agentes,id',
            'preco_orbes' => 'required|integer|min:0',
            'descricao' => 'nullable|string',
        ]);

        $ultimate->update($request->all());

        return redirect()->route('ultimates.index')->with('sucesso', 'Ultimate atualizada com sucesso!');
    }

    public function destroy(Ultimate $ultimate)
    {
        $ultimate->delete();

        return redirect()->route('ultimates.index')->with('sucesso', 'Ultimate removida com sucesso!');
    }
}
