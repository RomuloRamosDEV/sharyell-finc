<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Previsao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrevisoesController extends Controller
{
   public function index()
   {
        return view('application.previsoes.index');
   }

   public function edit(Previsao $previsao)
   {
        $user = Auth::user();

        $categories = Categories::where('user_id', $user->id)
            ->where('type', 'saida')->get();

        return view('application.previsoes.edit', compact('previsao', 'categories'));
   }

   public function update(Previsao $previsao, Request $request)
   {
       try {
            $valor = str_replace([' ', ',', '.', 'R', '$'], '', $request->top_value);
            
            $previsao->category_id = $request->category_id;
            $previsao->top_value = $valor;

            $previsao->save();

            return to_route('previsoes-index')->with('success', 'Previsão atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar a previsão.');
        }
   }
}
