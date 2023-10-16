<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        $user = Auth::user();

        $categories = Categories::where('categories.user_id', $user->id)
        ->leftJoin('colors', 'colors.id', '=', 'categories.color')
        ->join('ledger', 'ledger.category_id', '=', 'categories.id')
        ->select('colors.color as hex', 'ledger.value as value',
        'categories.*')
        ->get();
        
        $total = $categories->groupBy('titulo')->map(function ($category) {
            $category->value = $category->sum('value');
            return $category; // Retorna a categoria completa com o valor atualizado
        });
        
        // dd($total['Restaurante']->value);

        $pieChartModel = (new PieChartModel())->setTitle('Gastos Livre');

        $categories = $categories->unique('titulo');

        foreach ($categories as $category) {
            if (isset($total[$category->titulo])) {
                $pieChartModel->addSlice($category->titulo, $total[$category->titulo]->value, $category->hex);
            }
        }

        return view('application.dashboard', compact('pieChartModel'));
    }
}
