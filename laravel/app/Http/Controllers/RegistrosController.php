<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Goal;
use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrosController extends Controller
{
    public function regEarn()
    {
        $user = Auth::user();

        $registros = Ledger::where('ledger.user_id', $user->id)
        ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
        ->where('cat.type', 'entrada')
        ->orderBy('ledger.date', 'desc')
        ->select('cat.titulo as cat_titulo', 'cat.id as cat_id', 'cat.type as cat_type','ledger.*')
        ->simplePaginate(20);

        $categories = Categories::where('user_id', $user->id)->where('type', 'entrada')->get();

        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m-t');

        return view('application.ledger.entradas', compact('registros', 'categories', 'start_date', 'end_date'));
    }

    public function regSpend()
    {
        $user = Auth::user();

        $registros = Ledger::where('ledger.user_id', $user->id)
        ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
        ->where('cat.type', 'saida')
        ->orderBy('ledger.date', 'desc')
        ->select('cat.titulo as cat_titulo', 'cat.id as cat_id', 'cat.type as cat_type','ledger.*')
        ->simplePaginate(20);

        $categories = Categories::where('user_id', $user->id)->where('type', 'saida')->get();

        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m-t');

        return view('application.ledger.saidas', compact('registros', 'categories', 'start_date', 'end_date'));
    }

    public function update(Ledger $registro, Request $request)
    {
        try {
            $user = Auth::user();

            $valor = str_replace([' ', ',', '.', 'R', '$'], '', $request->value);

            $category = Categories::find($request->cat_title);

            if($category->type == 'saida'){
                if($request->type == 'livre'){
                    $remember = 0;
                } else if ($request->type == 'fixo') {
                    $remember = 1;
                }
    
                $registro->update([
                    'category_id' => $request->cat_title,
                    'descricao' => $request->descricao,
                    'value' => $valor,
                    'date' => $request->date,
                    'type' => $request->type,
                    'remember' => $remember,
                ]);
    
                return to_route('registros-saida')->with('success', 'Registro alterado com sucesso.');

            } else if ($category->type == 'entrada') {
                if($request->type == 'livre'){
                    $remember = 0;
                } else if ($request->type == 'fixo') {
                    $remember = 1;
                }
    
                $registro->update([
                    'category_id' => $request->cat_title,
                    'descricao' => $request->descricao,
                    'value' => $valor,
                    'date' => $request->date,
                    'type' => $request->type,
                    'remember' => $remember,
                ]);
    
                return to_route('registros-entrada')->with('success', 'Registro alterado com sucesso.');
            }

        } catch (\Exception $e) {
            return back()->with('problem', 'Erro ao alterar registro: ' . $e->getMessage());
        }
    }

    public function destroy(Ledger $registro)
    {
        try {
            $registro->delete();

            return back()->with('success', 'Registro excluído com sucesso.');
        } catch (\Exception $e) {

            return back()->withErrors(['Erro ao excluir registro: ' . $e->getMessage()]);
        }
    }

    public function regSearch(Request $request)
    {
        $user = Auth::user();

        if ($request->category != null and $request->type != null) {
            $registros = Ledger::where('ledger.user_id', $user->id)
                ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
                ->where('cat.type', 'saida')
                ->where('ledger.type', $request->type)
                ->where('cat.id', $request->category)
                ->where('ledger.date', '>=', $request->start_date)
                ->where('ledger.date', '<=', $request->end_date)
                ->orderBy('ledger.date', 'desc')
                ->select('cat.titulo as cat_titulo', 'cat.type as cat_type','ledger.*')
                ->get();

            $categories = Categories::where('user_id', $user->id)->where('type', 'saida')->get();

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            return view('application.ledger.saidas', compact('registros', 'categories', 'start_date', 'end_date'));
        }

        else if ($request->category != null and $request->type == null) {
            $registros = Ledger::where('ledger.user_id', $user->id)
                ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
                ->where('cat.type', 'saida')
                ->where('cat.id', $request->category)
                ->where('ledger.date', '>=', $request->start_date)
                ->where('ledger.date', '<=', $request->end_date)
                ->orderBy('ledger.date', 'desc')
                ->select('cat.titulo as cat_titulo', 'cat.id as cat_id', 'cat.type as cat_type','ledger.*')
                ->get();

            $categories = Categories::where('user_id', $user->id)->where('type', 'saida')->get();

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            return view('application.ledger.saidas', compact('registros', 'categories', 'start_date', 'end_date'));
        }

        else if ($request->category == null and $request->type != null) {
            $registros = Ledger::where('ledger.user_id', $user->id)
                ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
                ->where('cat.type', 'saida')
                ->where('ledger.type', $request->type)
                ->where('ledger.date', '>=', $request->start_date)
                ->where('ledger.date', '<=', $request->end_date)
                ->orderBy('ledger.date', 'desc')
                ->select('cat.titulo as cat_titulo', 'cat.id as cat_id', 'cat.type as cat_type','ledger.*')
                ->get();

            $categories = Categories::where('user_id', $user->id)->where('type', 'saida')->get();

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            return view('application.ledger.saidas', compact('registros', 'categories', 'start_date', 'end_date'));
        }

        else if ($request->category == null and $request->type == null) {
            $registros = Ledger::where('ledger.user_id', $user->id)
                ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
                ->where('cat.type', 'saida')
                ->where('ledger.date', '>=', $request->start_date)
                ->where('ledger.date', '<=', $request->end_date)
                ->orderBy('ledger.date', 'desc')
                ->select('cat.titulo as cat_titulo', 'cat.id as cat_id', 'cat.type as cat_type','ledger.*')
                ->get();

            $categories = Categories::where('user_id', $user->id)->where('type', 'saida')->get();

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            return view('application.ledger.saidas', compact('registros', 'categories', 'start_date', 'end_date'));
        }
        
    }

    public function regSearchEarn(Request $request)
    {
        $user = Auth::user();

        if ($request->category != null and $request->type != null) {
            $registros = Ledger::where('ledger.user_id', $user->id)
                ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
                ->where('cat.type', 'entrada')
                ->where('ledger.type', $request->type)
                ->where('cat.id', $request->category)
                ->where('ledger.date', '>=', $request->start_date)
                ->where('ledger.date', '<=', $request->end_date)
                ->orderBy('ledger.date', 'desc')
                ->select('cat.titulo as cat_titulo', 'cat.type as cat_type','ledger.*')
                ->get();

            $categories = Categories::where('user_id', $user->id)->where('type', 'entrada')->get();

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            return view('application.ledger.entradas', compact('registros', 'categories', 'start_date', 'end_date'));
        }

        else if ($request->category != null and $request->type == null) {
            $registros = Ledger::where('ledger.user_id', $user->id)
                ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
                ->where('cat.type', 'entrada')
                ->where('cat.id', $request->category)
                ->where('ledger.date', '>=', $request->start_date)
                ->where('ledger.date', '<=', $request->end_date)
                ->orderBy('ledger.date', 'desc')
                ->select('cat.titulo as cat_titulo', 'cat.id as cat_id', 'cat.type as cat_type','ledger.*')
                ->get();

            $categories = Categories::where('user_id', $user->id)->where('type', 'entrada')->get();

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            return view('application.ledger.entradas', compact('registros', 'categories', 'start_date', 'end_date'));
        }

        else if ($request->category == null and $request->type != null) {
            $registros = Ledger::where('ledger.user_id', $user->id)
                ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
                ->where('cat.type', 'entrada')
                ->where('ledger.type', $request->type)
                ->where('ledger.date', '>=', $request->start_date)
                ->where('ledger.date', '<=', $request->end_date)
                ->orderBy('ledger.date', 'desc')
                ->select('cat.titulo as cat_titulo', 'cat.id as cat_id', 'cat.type as cat_type','ledger.*')
                ->get();

            $categories = Categories::where('user_id', $user->id)->where('type', 'entrada')->get();

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            return view('application.ledger.entradas', compact('registros', 'categories', 'start_date', 'end_date'));
        }

        else if ($request->category == null and $request->type == null) {
            $registros = Ledger::where('ledger.user_id', $user->id)
                ->join('categories as cat', 'cat.id', '=', 'ledger.category_id')
                ->where('cat.type', 'entrada')
                ->where('ledger.date', '>=', $request->start_date)
                ->where('ledger.date', '<=', $request->end_date)
                ->orderBy('ledger.date', 'desc')
                ->select('cat.titulo as cat_titulo', 'cat.id as cat_id', 'cat.type as cat_type','ledger.*')
                ->get();

            $categories = Categories::where('user_id', $user->id)->where('type', 'entrada')->get();

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            return view('application.ledger.entradas', compact('registros', 'categories', 'start_date', 'end_date'));
        }
        
    }
}
