@include('commom.modalHeader')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h6 class="text-left text-uppercase text-success">crear | actualizar categoria</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="badge">Nombre de la categoria</label>
                        <input type="text" wire:model.lazy="name" class="form-control"
                            placeholder="nombre de la categoria">
                        @error('name')
                            <span class="text-danger text-center">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="badge">Descripcion de la categoria</label>
                        <textarea wire:model.lazy="description" class="form-control" placeholder="Descripcion de la categoria">

                        </textarea>
                        @error('name')
                            <span class="text-danger text-center">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('commom.modalFooter')
