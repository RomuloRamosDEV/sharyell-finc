<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Ledger;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        return view('application.dashboard');
    }
}
