<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cliente;

class Ventas extends Component
{
    public $categoria_id,$search,$csearch;
    public $listaProductos = [];
    public $descuento = 0;
    public $descMode = false;
    public $subtotal = 0;
    public $total = 0;
    public $cId,$cNombre;
    public $nombre,$direccion,$telefono,$email;

    public function mount(){
        $record = Cliente::where('nombre','Cliente Mostrador')->first();
        $this->cId = $record->id;
        $this->cNombre = $record->nombre;
    }

    public function hydrate(){
        $this->upTotales();
    }

    public function chgMode(){ $this->descMode = !$this->descMode; }

    public function upTotales(){
        $data = 0;
        foreach ($this->listaProductos as $value) {
            $data += $value['cantidad'] * $value['precio'];
        }
        if($this->descuento > $data) $this->descuento = $data;
        $this->subtotal = $data;
        $this->total = $data - $this->descuento;
    }

    public function render()
    {
        if($this->categoria_id <= 0){
            if(strlen($this->search) <= 0)
                $info = Producto::select('id','nombre')->get();
            else   
                $info = Producto::where('nombre','like','%'.$this->search.'%')->select('id','nombre')->get();
        }else{
            if(strlen($this->search) <= 0)
                $info = Producto::where('categoria_id',$this->categoria_id)
                    ->select('id','nombre')->get();
            else   
                $info = Producto::where('nombre','like','%'.$this->search.'%')
                    ->where('categoria_id',$this->categoria_id)
                    ->select('id','nombre')->get();
        }

        if(strlen($this->csearch) < 0)
            $clientes = Cliente::select('id','nombre')->get();
        else
            $clientes = Cliente::where('nombre','like','%'.$this->csearch.'%')
                ->select('nombre','id')->get();
        
        $categorias = Categoria::select('id','nombre')->get();

        return view('livewire.ventas',[
            'info' => $info,
            'categorias' => $categorias,
            'clientes' => $clientes
        ]);
    }

    public function addProducto($id){
        $record = Producto::find($id);
        $arr = [
            'id' => $record->id,
            'nombre' => $record->nombre,
            'precio' => $record->precio_venta,
            'cantidad' => 1
        ];
        if(!in_array($arr,$this->listaProductos)){
            array_push($this->listaProductos,$arr);
        }
        $this->upTotales();
    }

    public function deleteRow($key){
        unset($this->listaProductos[$key]);
        $this->upTotales();
    }
}
