<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proveedor;

class Proveedores extends Component
{
    use WithPagination;
    
    public $search,$selected_id;
    public $nombre,$direccion,$telefono,$email;
    public $action = 1;

    protected $listeners = [
        'deleteRow' => 'destroy'
    ];

    public function render()
    {
        if(strlen($this->search) > 0)
            $info = Proveedor::where('nombre','like','%'.$this->search.'%')->paginate(10);
        else
            $info = Proveedor::orderBy('id','desc')->paginate(10);

        return view('livewire.proveedores', [
            'info' => $info
        ]);
    }

    public function StoreOrUpdate(){
        $this->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|min:10'
        ]);

        if($this->selected_id <= 0){
            $this->validate(['email' => 'nullable|email|unique:proveedores']);
            $record = Proveedor::create([
                'nombre' => $this->nombre,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'email' => $this->email
            ]);
            $this->emit('msgok','Creado correctamente');
        }else{
            $record = Proveedor::find($this->selected_id);
            $this->validate(['email' => 'nullable|email|unique:proveedores,email,' . $record->id]);
            $record->update([
                'nombre' => $this->nombre,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'email' => $this->email
            ]);
            $this->emit('msgok','Actualizado correctamente');
        }
        $this->resetAll();
    }

    public function doAction($action){
        $this->action = $action;
        $this->resetAll();
    }

    public function edit($id) {
        $record = Proveedor::find($id);
        $this->nombre = $record->nombre;
        $this->direccion = $record->direccion;
        $this->telefono = $record->telefono;
        $this->email = $record->email;
        $this->selected_id = $record->id;
        $this->action = 2;
    }

    public function resetAll(){
        $this->nombre = '';
        $this->direccion = '';
        $this->telefono = '';
        $this->email = '';
        $this->selected_id = '';
        $this->action = 1;
    }

    public function destroy($id) {
        Proveedor::where('id',$id)->delete();
        $this->emit('msgok','Eliminado correctamente');
    }
}
