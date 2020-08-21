<input type="text" wire:model="csearch" class="form-control form-control-sm">
<table class="table table-bordered mt-2">
    <thead>
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
                    <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                </td>
            </tr>            
        @endforeach
    </tbody>
</table>