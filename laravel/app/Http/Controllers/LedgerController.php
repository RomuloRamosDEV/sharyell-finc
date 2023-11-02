<?php

namespace App\Http\Controllers;

use App\Http\Requests\LedgerRequest;
use App\Models\Ledger;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index()
    {
        $registros = Ledger::orderBy('date', 'desc')
        ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
        ->where('cat.type', 'saida')
        ->select('cat.titulo as categoria', 'cat.type as cat_tipo', 'ledger.*')
        ->get();

        return view('application.ledger.index', compact('registros'));
    }

    public function create()
    {
        return view('application.ledger.create');
    }

    public function store(LedgerRequest $request)
    {
        try {
            $input = $request->all();

            Ledger::create($input);

            return redirect()->route('registros.index')->with('success', 'Registro adicionado com sucesso.');
        } catch (\Exception $e) {

            return back()->withErrors(['Erro ao alterar registro: ' . $e->getMessage()]);
        }
    }

    public function edit(Ledger $registro)
    {
        return view('application.ledger.edit', compact('registro'));
    }

    public function update(LedgerRequest $request, Ledger $registro)
    {
        try {
            $input = $request->all();

            $registro->update($input);

            return redirect()->route('registros.index')->with('success', 'Registro alterado com sucesso.');
        } catch (\Exception $e) {

            return back()->withErrors(['Erro ao alterar registro: ' . $e->getMessage()]);
        }
    }

    public function destroy(Ledger $registro)
    {
        try {
            $registro->delete();

            return redirect()->route('registros.index')->with('success', 'Registro excluído com sucesso.');
        } catch (\Exception $e) {

            return back()->withErrors(['Erro ao excluir registro: ' . $e->getMessage()]);
        }
    }
}
