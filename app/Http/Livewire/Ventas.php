<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Venta;

class Ventas extends Component
{
    use WithPagination;

    public $categoria_id,$search,$csearch;
    public $listaProductos = [];
    public $descMode = false, $action = 1;
    public $descuento = 0, $subtotal = 0, $total = 0;
    public $cId,$cNombre;
    public $nombre,$direccion,$telefono,$email;

    public function StoreVenta(){
        if(count($this->listaProductos) > 0){
            $record = Venta::create([
                'descuento' => $this->descuento,
                'articulos' => count($this->listaProductos),
                'total' => $this->total,
                'cliente_id' => $this->cId
            ]);
            $datos = [];
            foreach($this->listaProductos as $key => $item){
                $datos[$item['id']] = [
                    'subtotal' => $item['cantidad'] * $item['precio'],
                    'cantidad' => $item['cantidad']
                ];
            }
            $record->productos()->sync($datos);
            session()->flash('message', 'Venta registrada correctamente.');
            return redirect()->to('/home');
        }
    }

    public function StoreCliente(){
        $this->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|min:10',
            'email' => 'email|nullable|unique:clientes'
        ]);

        $record = Cliente::create([
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email
        ]);
        $this->cId = $record->id;
        $this->cNombre = $record->nombre;

        $this->resetClienteFields();

        $this->emit('msgok','Creado correctamente');
    }

    public function resetClienteFields(){
        $this->nombre = '';
        $this->direccion = '';
        $this->telefono = '';
        $this->email = '';
        $this->action = 1;
    }

    public function setCliente($id,$nombre){
        $this->cId = $id;
        $this->cNombre = $nombre;
    }

    public function mount(){
        $record = Cliente::where('nombre','Cliente Mostrador')->first();
        $this->cId = $record->id;
        $this->cNombre = $record->nombre;
    }

    public function hydrate(){
        $this->upTotales();
    }

    public function upTotales(){
        $data = 0;
        foreach ($this->listaProductos as $value) {
            $data += (($value['cantidad'] > 0) ? $value['cantidad'] : 1) * $value['precio'];
        }
        if($this->descuento > $data) $this->descuento = $data;
        $this->subtotal = $data;
        $this->total = $data - (($this->descuento > 0) ? $this->descuento : 0);
    }

    public function render(){
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
            $clientes = Cliente::select('id','nombre')->orderBy('id','desc')->paginate(10);
        else
            $clientes = Cliente::where('nombre','like','%'.$this->csearch.'%')
                ->select('nombre','id')->orderBy('id','desc')->paginate(10);
        
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
