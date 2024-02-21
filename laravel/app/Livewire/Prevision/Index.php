<?php

namespace App\Livewire\Prevision;

use App\Models\Categories;
use App\Models\Ledger;
use App\Models\Previsao;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $previsoes;
    public $categories;
    public $message;

    //Campos
    public $catInput = 0;
    public $valueInput;
    
    public $month;
    public $modal = true;
    public $edit;

    public function mount()
    {
        $user = Auth::user();

        $this->month = date('m-Y'); // Obtém o mês e o ano atual

        $this->previsoes = Previsao::where('previsoes.user_id', $user->id)
        ->leftJoin('categories as cat', 'previsoes.category_id', '=', 'cat.id')
        ->select('previsoes.*', 'cat.titulo as categoria')
        ->get();

        foreach ($this->previsoes as $previsao) { 
            $gastos = Ledger::where('category_id', $previsao->category_id)
            ->where('user_id', $user->id)
            ->where(DB::raw('DATE_FORMAT(ledger.date, "%m-%Y")'), '=', $this->month)
            ->get();
            
            $previsao->value_now = $gastos->sum('value');
            $previsao->percent = round(($previsao->value_now / $previsao->top_value) * 100, 2);
            if($previsao->percent > 100){
                $previsao->percent = 100;
            }
            $previsao->save();
        }

        $this->categories = Categories::where('user_id', $user->id)
            ->where('type', 'saida')->get();

        $this->edit = false;
    }

    public function render()
    {
        return view('livewire.prevision.index');
    }

    public function store()
    {
        $this->message = null;
        
        try {
            $this->validate([
                'catInput' => 'required',
                'valueInput' => 'required',
            ]);

            $user = Auth::user();

            $valor = str_replace([' ', ',', '.', 'R', '$'], '', $this->valueInput);

            if(!Previsao::where('category_id', $this->catInput)->exists()){
                Previsao::create([
                    'user_id' => $user->id,
                    'category_id' => $this->catInput,
                    'top_value' => $valor,
                ]);

                $this->modal = false;
            }else{
                $this->message = 'Esta Categoria já está ativa!';
            }

            $this->reset(['catInput', 'valueInput']); // Limpa os campos após a inserção

            $this->mount();

            
        } catch (\Exception $e) {
            $this->message = 'Erro: '.$e->getMessage();

            $this->mount();
        }
    }

    public function destroy($id)
    {  
        try {

            Previsao::where('id', $id)->delete();

            $this->mount();
            
        } catch (\Exception $e) {
            $this->message = 'Erro: '.$e->getMessage();
        }
    }

    public function modaller()
    {
        $this->modal = true;
        $this->mount();
    }
}
