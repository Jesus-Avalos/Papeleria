<!-- Modal -->
<div class="modal fade" id="clientesModal" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($action == 1)
                    @include('livewire.ventas.sclientes')
                @else
                    @include('livewire.clientes.form')
                    <hr>
                    <div class="row m-2 justify-content-end">
                        <button type="button" class="btn btn-secondary mr-2" wire:click="$set('action',1)">Cancelar</button>
                        <button type="button" class="btn btn-primary" wire:click="StoreCliente">Registrar</button>
                    </div>
                @endif

            </div>
            @if ($action == 1)
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>   
            @endif
        </div>
    </div>
</div>