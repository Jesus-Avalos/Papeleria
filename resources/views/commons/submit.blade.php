<div class="text-center my-3">
    @if ($action == 2)
        <button class="btn btn-secondary" wire:click="doAction(1)">Cancel</button>
        <button class="btn btn-success" wire:click="StoreOrUpdate()">Actualizar</button>
    @else
        <button class="btn btn-success" wire:click="StoreOrUpdate()">Agregar</button>
    @endif
</div>