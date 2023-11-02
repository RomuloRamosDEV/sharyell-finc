<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetasController extends Controller
{
   public function index()
   {
        return to_route('metas-saida');
   }

   public function edit()
   {
        return view('application.metas.index');
   }

   public function update($meta, Request $request)
   {
        try {
            $user = Auth::user();

            $month_save = $request->month;

            if (isset($request->goal_spend)) {
                $request->validate([
                    'goal_spend' => 'required',
                ]);

                $valor = str_replace([' ', ',', '.', 'R', '$'], '', $request->goal_spend);
    
                $goal = Goal::where('id', $meta)->first();

                if($goal) {

                    $goal->update([
                        'goal_spend' => $valor,
                        'month' => $month_save,
                    ]);
    
                } else {
                    $goal = new Goal();
                    $goal->user_id = $user->id;
                    $goal->goal_spend = $valor;
                    $goal->month = $month_save;
                    $goal->save();
                    
                }

                return to_route('metas-saida')->with('success', 'Registro alterado com sucesso.');

            } else if (isset($request->goal_earn)) {

                $request->validate([
                    'goal_earn' => 'required',
                ]);
                
                $valor = str_replace([' ', ',', '.', 'R', '$'], '', $request->goal_earn);
    
                $goal = Goal::where('id', $meta)->first();
    
                if($goal) {
                    
                    $goal->update([
                        'goal_earn' => $valor,
                        'month' => $month_save,
                    ]);
    
                } else {
                    $goal = new Goal();
                    $goal->user_id = $user->id;
                    $goal->goal_earn = $valor;
                    $goal->month = $month_save;
                    $goal->save();
                    
                }

                return to_route('metas-entrada')->with('success', 'Registro alterado com sucesso.');
            }
            
        } catch (\Exception $e) {
            return to_route('metas-saida')->with('problem', 'Erro ao alterar registro: ' . $e->getMessage());
        }
   }

   public function destroy(Goal $meta)
   {
        try {
            $meta->delete();

            return to_route('metas-saida')->with('success', 'Registro excluído com sucesso.');
        } catch (\Exception $e) {

            return back()->withErrors(['Erro ao excluir registro: ' . $e->getMessage()]);
        }
   }

   public function earn()
   {
        $registros = Goal::all();

        return view('application.metas.entradas', compact('registros'));
   }

   public function spend()
   {
        $registros = Goal::orderBy('month', 'asc')->get();

        return view('application.metas.saidas', compact('registros'));
   }
}
