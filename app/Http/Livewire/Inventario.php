<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Inventario extends Component
{
    public $acciones = ['Categorias','Productos'];

    public function render()
    {
        return view('livewire.inventario');
    }
}
