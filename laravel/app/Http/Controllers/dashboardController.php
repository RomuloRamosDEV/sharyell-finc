<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        $pieChartModel = 
            (new PieChartModel())
                ->setTitle('Gastos por Tipo')
                ->addSlice('Comida', 100, '#f6ad55')
                ->addSlice('Shopping', 250, '#fc8181')
                ->addSlice('Viagem', 300, '#90cdf4')
            ; 

        return view('application.dashboard', compact('pieChartModel'));
    }
}
