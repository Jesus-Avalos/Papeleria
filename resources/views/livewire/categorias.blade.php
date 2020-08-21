<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="form-group">
                <h2>Nombre de la categoría:</h2>
                <input type="text" class="form-control" wire:model="nombre" placeholder="Escriba el nombre...">
                @error('nombre') <div class="alert alert-danger">{{ $message }}</div> @enderror
                <div class="text-center mt-3">
                    @if ($action == 2)
                        <button class="btn btn-secondary" wire:click="doAction(1)">Cancel</button>
                        <button class="btn btn-success" wire:click="StoreOrUpdate()">Actualizar</button>
                    @else
                        <button class="btn btn-success" wire:click="StoreOrUpdate()">Agregar</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
            @include('commons.search')
            <table class="table table-bordered table-sm text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($info) == 0)
                        <tr>
                            <td colspan="2" class="text-center">Sin registros</td>
                        </tr>
                    @else
                        @foreach($info as $item)
                            <tr>
                                <td>{{ $item->nombre }}</td>
                                <td>
                                    @include('commons.actions')
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div align="center">
                {{ $info->links() }}
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function confirmDelete(id){
            swal.fire({
                title: 'Estas seguro?',
                text: "No podrás revertirlo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminalo!'
            }).then((result) => {
                if (result.value) {
                    window.livewire.emit('deleteRow',id);
                }
            })
        }
    </script>
    
@endpush