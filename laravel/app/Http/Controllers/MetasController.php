<?php

namespace App\Http\Controllers;

class MetasController extends Controller
{
   public function index()
   {
        return view('application.metas.index');
   }

   public function edit()
   {
        return view('application.metas.index');
   }

   public function update()
   {
        return view('application.metas.index');
   }

   public function earn()
   {
        return view('application.metas.entradas');
   }

   public function spend()
   {
        return view('application.metas.saidas');
   }
}
