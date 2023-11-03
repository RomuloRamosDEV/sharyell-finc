<?php

namespace App\Livewire\Dashboard;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class ExcludePopUp extends Component
{
    public $categories;

    public $category_id = 0;

    public function render()
    {
        $user = Auth::user();
        
        $this->categories = Categories::where('type', 'saida')->where('user_id', $user->id)->get();

        return view('livewire.dashboard.exclude-pop-up');
    }
}
