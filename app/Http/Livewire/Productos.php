<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Categoria;

class Productos extends Component
{
    use WithPagination;

    public $search,$selected_id;
    public $codigo,$nombre,$descripcion,$categoria_id,$precio_venta,$precio_compra,$stock;
    public $action = 1;

    protected $listeners = ['deleteRow' => 'destroy'];

    public function render()
    {
        if (strlen($this->search) > 0) {
            $info = Producto::with('categoria')
                ->where('codigo','like','%'.$this->search.'%')
                ->orWhere('nombre','like','%'.$this->search.'%')
                ->orWhere('descripcion','like','%'.$this->search.'%')
                ->paginate(10);
        } else {
            $info = Producto::with('categoria')->orderBy('id','desc')->paginate(10);
        }
        $categorias = Categoria::select('nombre','id')->get();

        return view('livewire.productos',[
            'info' => $info,
            'categorias' => $categorias
        ]);
    }

    public function edit($id){
        $record = Producto::find($id);
        $this->selected_id = $record->id;
        $this->codigo = $record->codigo;
        $this->nombre = $record->nombre;
        $this->descripcion = $record->descripcion;
        $this->categoria_id = $record->categoria_id;
        $this->precio_venta = $record->precio_venta;
        $this->precio_compra = $record->precio_compra;
        $this->stock = $record->stock;
        $this->action = 2;
    }

    public function StoreOrUpdate(){
        $this->validate([
            'categoria_id' => 'not_in:Elegir'
        ]);

        $this->validate([
            'nombre' => 'required',
            'categoria_id' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'stock' => 'required'
        ]);

        if($this->selected_id <= 0){
            $this->validate(['nombre'=>'unique:productos']);
            $record = Producto::create([
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'descripcion' => $this->descripcion,
                'categoria_id' => $this->categoria_id,
                'precio_compra' => $this->precio_compra,
                'precio_venta' => $this->precio_venta,
                'stock' => $this->stock
            ]);
            $this->emit('msgok','Creado correctamente');
        }else{
            $record = Producto::find($this->selected_id);
            $this->validate(['nombre'=>'unique:productos,nombre,'.$record->id]);
            $record->update([
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'descripcion' => $this->descripcion,
                'categoria_id' => $this->categoria_id,
                'precio_compra' => $this->precio_compra,
                'precio_venta' => $this->precio_venta,
                'stock' => $this->stock
            ]);
            $this->emit('msgok','Actualizado correctamente');
        }

        $this->resetAll();
    }

    public function destroy($id){
        $record = Producto::where('id',$id)->delete();
        $this->resetAll();
        $this->emit('msgok','Eliminado correctamente');
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function doAction($action){
        $this->action = $action;
        $this->resetAll();
    }

    public function resetAll() {
        $this->nombre = '';
        $this->descripcion = '';
        $this->codigo = '';
        $this->categoria_id = '';
        $this->precio_venta = '';
        $this->precio_compra = '';
        $this->stock= '';
        $this->search= '';
        $this->action = 1;
        $this->selected_id = null;
    }
}
