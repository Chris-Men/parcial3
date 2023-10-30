@include('commom.modalHeader')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h6>CREAR NUEVO PRODUCTO | ACTUALIZAR PRODUCTO</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" wire:model.lazy="name" class="form-control" placeholder="nombre producto">
                        @error('name')
                            <span class="text-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Descripcion</label>
                        <textarea class="form-control" wire:model.lazy="descripcion" placeholder="ingresa una descripcion"></textarea>
                        @error('descripcion')
                            <span class="text-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="text" wire:model.lazy="price" class="form-control"
                            placeholder="nombre producto">
                        @error('price')
                            <span class="text-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="text" wire:model.lazy="stock" class="form-control"
                            placeholder="nombre producto">
                        @error('stock')
                            <span class="text-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" wire:model.lazy="categoria_id">
                            <option value="Elegir">Elegir</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c['id'] }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <span class="text-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('commom.modalFooter')
