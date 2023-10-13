<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        return view('app.dashboard');
    }
}
