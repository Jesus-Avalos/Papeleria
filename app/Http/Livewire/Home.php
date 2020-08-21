<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $acciones = ['Ventas','Compras','Creditos','Inventario','Clientes','Proveedores','Reportes'];
    
    public function render()
    {
        return view('livewire.home');
    }
}
