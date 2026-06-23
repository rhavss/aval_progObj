<?php

namespace App\Http\Controllers;

use App\Models\Arma;
use Illuminate\Http\Request;

class ArmaController extends Controller
{
    public function index()
    {
        $armas = Arma::orderBy('nome')->get();

        return view('armas.index', compact('armas'));
    }

    public function create()
    {
        return view('armas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'classe' => 'required|in:Pistola,Submetralhadora,Fuzil,Escopeta,Precisao,Metralhadora',
            'preco' => 'required|numeric|min:0',
        ]);

        Arma::create($request->all());

        return redirect()->route('armas.index')->with('sucesso', 'Arma cadastrada com sucesso!');
    }

    public function edit(Arma $arma)
    {
        return view('armas.edit', compact('arma'));
    }

    public function update(Request $request, Arma $arma)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'classe' => 'required|in:Pistola,Submetralhadora,Fuzil,Escopeta,Precisao,Metralhadora',
            'preco' => 'required|numeric|min:0',
        ]);

        $arma->update($request->all());

        return redirect()->route('armas.index')->with('sucesso', 'Arma atualizada com sucesso!');
    }

    public function destroy(Arma $arma)
    {
        $arma->delete();

        return redirect()->route('armas.index')->with('sucesso', 'Arma removida com sucesso!');
    }
}
