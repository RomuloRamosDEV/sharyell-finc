<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FirstAccessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MetasController;
use App\Http\Controllers\PrevisoesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\RegistrosController;

use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

//ROTAS AUTENTICADAS
Route::middleware('auth')->group(function () {

    Route::get('primeiro-acesso', [FirstAccessController::class, 'index'])->name('first-access');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rotas de inclusão de valores direto da Dashboard
    Route::post('/dashboard/earn', [DashboardController::class, 'earnAdd'])->name('dashboard-earn');
    Route::post('/dashboard/spend', [DashboardController::class, 'spendAdd'])->name('dashboard-spend');
    Route::post('/dashboard/setGoal', [DashboardController::class, 'setGoal'])->name('dashboard-goal');

    //CRUD de Categorias
    Route::resource('categorias', CategoriasController::class);

    //CRUD de Metas por usuário
    Route::get('metas/saidas', [MetasController::class, 'spend'])->name('metas-saida');
    Route::get('metas/entradas', [MetasController::class, 'earn'])->name('metas-entrada');
    Route::resource('metas', MetasController::class);

    //Previsões
    Route::get('previsoes', [PrevisoesController::class, 'index'])->name('previsoes-index');
    Route::get('previsoes/{previsao}/editar', [PrevisoesController::class, 'edit'])->name('previsoes-edit');
    Route::patch('previsoes/{previsao}/update', [PrevisoesController::class, 'update'])->name('previsoes-update');

    //CRUD de Registros por usuário
    Route::get('registros/saidas', [RegistrosController::class, 'regSpend'])->name('registros-saida');
    Route::post('registros/saidas/pesquisa', [RegistrosController::class, 'regSearch'])->name('registros-pesquisa-saida');
    Route::get('registros/entradas', [RegistrosController::class, 'regEarn'])->name('registros-entrada');
    Route::post('registros/entradas/pesquisa', [RegistrosController::class, 'regSearchEarn'])->name('registros-pesquisa-entrada');
    Route::resource('registros', RegistrosController::class);
});


//Rotas de Login
require __DIR__.'/auth.php';
