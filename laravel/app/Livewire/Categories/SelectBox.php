<?php

namespace App\Livewire\Categories;

use App\Models\Categories;
use App\Models\Colors;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SelectBox extends Component
{
    public $categoria;

    public $colors;
    public $cor = null;
    public $user;

    public $inputTitulo;
    public $inputType = 0;
    public $inputColor = 0;
    public $message;

    public function mount()
    {
        if(isset($this->categoria)){
            $this->inputTitulo = $this->categoria->titulo;
            $this->inputType = $this->categoria->type;
            $this->inputColor = $this->categoria->color;
        }
    }

    public function render()
    {
        $this->user = Auth::user();
        $this->colors = Colors::all();

        return view('livewire.categories.select-box');
    }

    public function store()
    {   
        if (empty($this->inputTitulo) || empty($this->inputColor) || empty($this->inputType)) {
            $this->message = 'Todos os campos são obrigatórios.';
            return;
        }
        
        $this->message = null;

        $categoria = new Categories();
        $categoria->user_id = $this->user->id;
        $categoria->titulo = $this->inputTitulo;
        $categoria->color = $this->inputColor;
        $categoria->type = $this->inputType;

        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function update()
    {   
        if (empty($this->inputTitulo) || empty($this->inputColor) || empty($this->inputType)) {
            $this->message = 'Todos os campos são obrigatórios.';
            return;
        }
        
        $this->message = null;

        $categoria = Categories::find($this->categoria->id);
        $categoria->titulo = $this->inputTitulo;
        $categoria->color = $this->inputColor;
        $categoria->type = $this->inputType;

        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function changeColor()
    {
        $this->cor = Colors::where('id', $this->inputColor)->first();
    }
}
