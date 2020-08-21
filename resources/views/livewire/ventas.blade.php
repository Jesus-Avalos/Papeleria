<div class="row mx-2 justify-content-around" style="flex:1 1 auto">
    @include('livewire.ventas.modal')
    <div class="col-12 col-md-6 border border-dark rounded p-3 mb-2">
        <div class="row">
            <div class="col col-sm-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text"><i class="fas fa-user"></i></label>
                    </div>
                    <input type="text" class="form-control" wire:model="cNombre" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#clientesModal"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered text-center table-sm">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 50%">Producto</th>
                    <th>Cantidad</th>
                    <th>Precio U.</th>
                    <th>Subtotal</th>
                    <th><i class="fas fa-wrench"></i></th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($listaProductos))
                    @foreach($listaProductos as $index => $item)
                        <tr>
                            <td>{{ $item['nombre'] }}</td>
                            <td>
                                <input type="number" 
                                    class="form-control form-control-sm text-center txtCantidad{{ $index }}" min="1"
                                    onblur="validateCantidad(this.value,{{ $index }})" 
                                    wire:model.number="listaProductos.{{ $index }}.cantidad">
                            </td>
                            <td>$ {{ $item['precio'] }}</td>
                            <td>
                                $ {{ $item['precio'] * (($item['cantidad'] > 0)? $item['cantidad']:1)}}
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" wire:click="deleteRow({{ $index }})"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">Sin registros</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-12 col-md-5 border border-dark rounded p-3 bg-dark" style="flex:1">
        <div class="row">
            <div class="col col-md-6" wire:ignore>
                <select class="selectControl w-100 form-control">
                    <option value="">Todas las categorías...</option>
                    @foreach ($categorias as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col col-md-6">
                <input type="text" wire:model="search" class="form-control" placeholder="Buscar producto...">
            </div>
        </div>
        <div class="w-100 overflow-auto mt-2 border border-dark rounded" style="height: 400px; background-color:  #e8df9a;">
            <div class="row justify-content-around m-2">
                @foreach ($info as $item)
                    <div class="col-4 col-sm-3 mb-2">
                        <div class="card">
                            <img src="{{ asset('storage/iconos/icono-noimage.png') }}" 
                                class="card-img-top h-50" alt="..." wire:click="addProducto({{ $item->id }})"
                                style="cursor:pointer">
                            <div class="card-body p-2 text-center">
                                <p class="card-text text-truncate">{{ $item->nombre }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="w-100 mt-2 border border-dark rounded" style="height:200px; background-color:  #e8df9a;">
            <div class="row text-center mt-3">
                <div class="col-3"><b>Articulos:</b></div>
                <div class="col-3"><b>Total:</b></div>
                <div class="col-3"><b>Descuento:</b></div>
                <div class="col-3"><b>Total a pagar:</b></div>
            </div>
            <div class="row text-center">
                <div class="col-3">{{ (count($listaProductos)) ?: 0 }}</div>
                <div class="col-3">$ {{ $subtotal }}</div>
                <div class="col-3 input-group">
                    <input type="number" step="any" min="0" 
                        onblur="validaDescuento(this.value)"
                        wire:model="descuento" {{ (!$descMode) ? 'readonly' : '' }} 
                        class="form-control form-control-sm w-50 text-center">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-{{ ($descMode) ? 'success' : 'secondary' }}" wire:click="$toggle('descMode')"><i class="fas fa-{{ ($descMode) ? 'edit' : 'lock' }}"></i></button>
                    </div>
                </div>
                <div class="col-3"><b class="text-success">$ {{ $total }}</b></div>
            </div>
            <div class="row justify-content-end mt-5">
                <div class="col-4 text-right mr-2" >
                    <button class="btn btn-lg btn-success" wire:click="StoreVenta"><h3>Pagar</h3></button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.selectControl').select2({
            theme: 'bootstrap',
            language: {
                noResults: function() {
                    return "No hay resultado";        
                },
                searching: function() {
                    return "Buscando..";
                }
            },
        });
        $('.selectControl').on('change', function (e) {
            @this.set('categoria_id', e.target.value);
        });
    });

    function validaDescuento(value){
        let valor = (value) ? value : -1;
        if(valor<0) @this.set('descuento',0);
    }

    function validateCantidad(value, key){
        let valor = (value) ? value : -1;
        if(valor<0) @this.set('listaProductos.'+key+'.cantidad', 1);
    }

    window.livewire.on('msgok',msg=>{
        $('#clientesModal').modal('hide');
    })
</script>
@endpush

@section('title')
    Ventas
@endsection