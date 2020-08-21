<div class="form-group">
    <h5>Nombre:</h5>
    <input type="text" class="form-control" wire:model="nombre" placeholder="Escriba el nombre...">
    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group">
    <h5>Dirección:</h5>
    <input type="text" class="form-control" wire:model="direccion" placeholder="Escriba la dirección...">
    @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group">
    <h5>Teléfono:</h5>
    <input type="text" class="form-control" wire:model="telefono" placeholder="Escriba el teléfono...">
    @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group">
    <h5>Email:</h5>
    <input type="email" class="form-control" wire:model="email" placeholder="Escriba el email...">
    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
</div>