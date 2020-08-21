<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;

class Categorias extends Component
{
    use WithPagination;

    public $nombre;
    public $search, $selected_id;
    public $action = 1;

    protected $listeners = [
        'deleteRow' => 'destroy'
    ];

    public function render()
    {
        if(strlen($this->search) > 0)
            $info = Categoria::where('nombre','like','%'.$this->search.'%')->paginate(10);
        else
            $info = Categoria::orderBy('id','desc')->paginate(10);

        return view('livewire.categorias', [
            'info' => $info
        ]);
    }

    public function edit($id){
        $record = Categoria::find($id);
        $this->selected_id = $record->id;
        $this->nombre = $record->nombre;
        $this->action = 2;
    }

    public function StoreOrUpdate(){
        $this->validate([
            'nombre' => 'required|unique:categorias'
        ]);

        if($this->selected_id <= 0){
            $record = Categoria::create([
                'nombre' => $this->nombre
            ]);
            $this->emit('msgok','Creado correctamente');
        }else{
            $record = Categoria::find($this->selected_id);
            $record->update([
                'nombre' => $this->nombre
            ]);
            $this->emit('msgok','Actualizado correctamente');
        }

        $this->resetAll();
    }

    public function destroy($id){
        $record = Categoria::where('id',$id)->delete();
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
        $this->search= '';
        $this->action = 1;
        $this->selected_id = null;
    }
}
