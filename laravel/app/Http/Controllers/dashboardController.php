<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Ledger;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        $registros = Ledger::where('ledger.user_id', $user->id)
            // ->where('ledger.type', 'livre')
            ->leftJoin('categories', 'ledger.category_id', '=', 'categories.id')
            ->select('categories.titulo as cat_title', 'ledger.*')
            ->get();

        $categories = Categories::where('user_id', $user->id)->get();
        // $cat_counted = count($categories);
        
        // $pieChartModel = 
        //     (new PieChartModel())
        //         ->setTitle('Gastos Livre')
        //         ->addSlice('Comida', 100, '#f6ad55')
        //         ->addSlice('Shopping', 250, '#fc8181')
        //         ->addSlice('Viagem', 300, '#90cdf4')
        //     ; 

        $pieChartModel = (new PieChartModel())->setTitle('Gastos Livre');

        foreach ($categories as $key => $category) {
            $pieChartModel->addSlice($category->titulo, 200, '#ff00ff');
        }

        return view('application.dashboard', compact('pieChartModel'));
    }
}
