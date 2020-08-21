@section('title')
    Clientes
@endsection
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-3">
            @include('livewire.clientes.form')
            @include('commons.submit')
        </div>
        <div class="col-12 col-md-9">
            @include('commons.search')
            <table class="table table-bordered table-sm text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($info) == 0)
                        <tr>
                            <td colspan="6" class="text-center">Sin registros</td>
                        </tr>
                    @else
                        @foreach($info as $item)
                            <tr>
                                <td>{{ $item->nombre }}</td>
                                <td>{{ $item->direccion }}</td>
                                <td>{{ $item->telefono }}</td>
                                <td>{{ $item->email }}</td>
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