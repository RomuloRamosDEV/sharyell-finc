<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesRequest;
use App\Models\Categories;

use Illuminate\Support\Facades\Auth;


class CategoriasController extends Controller
{
   public function index()
   {
        $user = Auth::user();

        $categorias = Categories::where('user_id', $user->id)
        ->join('colors', 'categories.color', '=', 'colors.id')
        ->select('colors.titulo as color_titulo', 'colors.color as color_cor', 'categories.*')
        ->get();

        return view('application.categories.index', compact('categorias'));
   }

    public function create()
    {
        return view('application.categories.form');
    }

    public function edit(Categories $categoria)
    {
        return view('application.categories.form', compact('categoria'));
    }

    public function destroy(Categories $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso.');
    }
}
