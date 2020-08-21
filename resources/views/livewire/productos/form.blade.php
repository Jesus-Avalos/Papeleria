<div class="form-group">
    <h5>Código del producto:</h5>
    <input type="text" class="form-control" wire:model="codigo" placeholder="Escriba el codigo...">
    @error('codigo') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group">
    <h5>Nombre del producto:</h5>
    <input type="text" class="form-control" wire:model="nombre" placeholder="Escriba el nombre...">
    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group">
    <h5>Descripción:</h5>
    <textarea rows="2" class="form-control" wire:model="descripcion" placeholder="Escriba la descripción..." style="resize:none"></textarea>
    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group">
    <h5>Categoría:</h5>
    <select wire:model="categoria_id" class="form-control">
        <option value="Elegir">Elegir...</option>
        @foreach ($categorias as $cat)
            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
        @endforeach
    </select>
    @error('categoria_id') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group">
    <h5>Precio compra:</h5>
    <input type="number" step="any" min="0" class="form-control" wire:model="precio_compra" placeholder="Escriba el precio de compra...">
    @error('precio_compra') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group">
    <h5>Precio venta:</h5>
    <input type="number" step="any" min="0" class="form-control" wire:model="precio_venta" placeholder="Escriba el precio de venta...">
    @error('precio_venta') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group">
    <h5>Stock:</h5>
    <input type="number" class="form-control" min="0" wire:model="stock" placeholder="Ingresa el stock">
    @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
</div>
@include('commons.submit')