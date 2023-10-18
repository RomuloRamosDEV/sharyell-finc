<?php

namespace App\Livewire\Dashboard;

use App\Models\Categories;
use App\Models\Ledger;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $categories;
    public $categories_fixo;
    public $categories_investimentos;
    public $monthSpent;

    public $start_date;
    public $end_date;

    public function mount()
    {
        $user = Auth::user();

        $this->categories = Categories::where('categories.user_id', $user->id)
            ->where('categories.type', 'saida')
            ->leftJoin('colors', 'colors.id', '=', 'categories.color')
            ->join('ledger', 'ledger.category_id', '=', 'categories.id')
            ->where('ledger.type', 'livre')
            ->select('colors.color as hex', 'ledger.value as value',
            'categories.*')
            ->get();

        $this->categories_fixo = Categories::where('categories.user_id', $user->id)
            ->where('categories.type', 'saida')
            ->leftJoin('colors', 'colors.id', '=', 'categories.color')
            ->join('ledger', 'ledger.category_id', '=', 'categories.id')
            ->where('ledger.type', 'fixo')
            ->select('colors.color as hex', 'ledger.value as value',
            'categories.*')
            ->get();

        $this->categories_investimentos = Categories::where('categories.user_id', $user->id)
            ->where('categories.type', 'investimento')
            ->leftJoin('colors', 'colors.id', '=', 'categories.color')
            ->join('ledger', 'ledger.category_id', '=', 'categories.id')
            ->select('colors.color as hex', 'ledger.value as value',
            'categories.*')
            ->get();

        $this->monthSpent = Ledger::selectRaw('DATE_FORMAT(created_at, "%m-%Y") as month, SUM(value) as total_spent')
            ->groupBy('month')
            ->get();
    
    }

    public function render()
    {
        //Chamada para gráfico principal de GASTO LIVRE
        $total = $this->categories->groupBy('titulo')->map(function ($category) {
            $category->value = $category->sum('value');
            return $category; // Retorna a categoria completa com o valor atualizado
        });
        
        $pieChartModel = (new PieChartModel())->setTitle(' ')->withDataLabels()->setAnimated(true)->setOpacity(0.85);

        $this->categories = $this->categories->unique('titulo');

        foreach ($this->categories as $category) {
            if (isset($total[$category->titulo])) {
                $pieChartModel->addSlice($category->titulo, $total[$category->titulo]->value, $category->hex);
            }
        }

        //Chamada para gráfico principal de GASTO FIXO
        $total_fixo = $this->categories_fixo->groupBy('titulo')->map(function ($category_fixo) {
            $category_fixo->value = $category_fixo->sum('value');
            return $category_fixo; // Retorna a categoria completa com o valor atualizado
        });

        $pieChartModelFixo = (new PieChartModel())->setTitle(' ')->withDataLabels()->setAnimated(true)->setOpacity(0.85);

        $this->categories_fixo = $this->categories_fixo->unique('titulo');

        foreach ($this->categories_fixo as $cat_fixo) {
            if (isset($total_fixo[$cat_fixo->titulo])) {
                $pieChartModelFixo->addSlice($cat_fixo->titulo, $total_fixo[$cat_fixo->titulo]->value, $cat_fixo->hex);
            }
        }

        
        //Grafico dos meses de gastos
        $lineChartModel = (new LineChartModel())->setTitle(' ')->withDataLabels()->setAnimated(true)->multiLine();

        foreach ($this->monthSpent as $month) {
            $lineChartModel->addSeriesPoint('Linha', $month->month, $month->total_spent)->addColor('#b70000');
        }


        //Chamada para gráfico Investimentos
        $total_investido = $this->categories_investimentos->groupBy('titulo')->map(function ($category_invest) {
            $category_invest->value = $category_invest->sum('value');
            return $category_invest; // Retorna a categoria completa com o valor atualizado
        });

        $pieChartModelInvest = (new PieChartModel())->withDataLabels()->setAnimated(true)->setOpacity(0.85);

        $this->categories_investimentos = $this->categories_investimentos->unique('titulo');

        foreach ($this->categories_investimentos as $cat_invest) {
            if (isset($total_investido[$cat_invest->titulo])) {
                $pieChartModelInvest->addSlice($cat_invest->titulo, $total_investido[$cat_invest->titulo]->value, $cat_invest->hex);
            }
        }

        return view('livewire.dashboard.index', compact('pieChartModel', 'pieChartModelFixo', 'lineChartModel', 'pieChartModelInvest'));
    }

    public function filterDate() {
        $user = Auth::user();

        if (isset($this->start_date) and isset($this->end_date)) {

            $this->categories = Categories::where('categories.user_id', $user->id)
                ->where('categories.type', 'saida')
                ->leftJoin('colors', 'colors.id', '=', 'categories.color')
                ->join('ledger', 'ledger.category_id', '=', 'categories.id')
                ->where('ledger.type', 'livre')
                ->where('ledger.created_at', '>', $this->start_date)->where('ledger.created_at', '<', $this->end_date)
                ->select('colors.color as hex', 'ledger.value as value',
                'categories.*')
                ->get();

            $this->categories_fixo = Categories::where('categories.user_id', $user->id)
                ->where('categories.type', 'saida')
                ->leftJoin('colors', 'colors.id', '=', 'categories.color')
                ->join('ledger', 'ledger.category_id', '=', 'categories.id')
                ->where('ledger.type', 'fixo')
                ->where('ledger.created_at', '>', $this->start_date)->where('ledger.created_at', '<', $this->end_date)
                ->select('colors.color as hex', 'ledger.value as value',
                'categories.*')
                ->get();

        } elseif (isset($this->start_date)) {

            $this->categories = Categories::where('categories.user_id', $user->id)
                ->where('categories.type', 'saida')
                ->leftJoin('colors', 'colors.id', '=', 'categories.color')
                ->join('ledger', 'ledger.category_id', '=', 'categories.id')
                ->where('ledger.type', 'livre')
                ->where('ledger.created_at', '>', $this->start_date)
                ->select('colors.color as hex', 'ledger.value as value',
                'categories.*')
                ->get();

            $this->categories_fixo = Categories::where('categories.user_id', $user->id)
                ->where('categories.type', 'saida')
                ->leftJoin('colors', 'colors.id', '=', 'categories.color')
                ->join('ledger', 'ledger.category_id', '=', 'categories.id')
                ->where('ledger.type', 'fixo')
                ->where('ledger.created_at', '>', $this->start_date)
                ->select('colors.color as hex', 'ledger.value as value',
                'categories.*')
                ->get();
        }


    }
}
