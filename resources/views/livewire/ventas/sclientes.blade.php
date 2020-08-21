<div class="input-group">
    <input type="text" wire:model="csearch" class="form-control form-control-sm" placeholder="Buscar cliente...">
    <div class="input-group-append">
        <button class="btn btn-sm btn-success" wire:click="$set('action',2)"><i class="fas fa-plus"></i></button>
    </div>
</div>
<table class="table table-sm table-bordered mt-2 text-center">
    <thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th><i class="fas fa-wrench"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $item)
            <tr>
                <td>{{ $item->nombre }}</td>
                <td>
                    <button class="btn btn-sm btn-success" data-dismiss="modal" wire:click="setCliente({{ $item->id }}, '{{ $item->nombre }}')"><i class="fas fa-check"></i></button>
                </td>
            </tr>            
        @endforeach
    </tbody>
</table>
{{ $clientes->links() }}