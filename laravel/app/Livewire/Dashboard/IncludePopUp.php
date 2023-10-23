<?php

namespace App\Livewire\Dashboard;

use App\Models\Categories;
use Livewire\Component;

class IncludePopUp extends Component
{
    public $categories;

    public function render()
    {
        $this->categories = Categories::all();

        return view('livewire.dashboard.include-pop-up');
    }
}
