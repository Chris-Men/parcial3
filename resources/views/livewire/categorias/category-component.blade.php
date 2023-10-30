<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h6 class="text-center text-dark">{{ $pageTitle }} | {{ $componentName }}</h6>
            </div>
            <div class="card-body">
                <a style="background: #3b3f5c" class="btn btn-sm mb-2 mtmobile text-white" href="javascript:void(0)"
                    data-toggle="modal" data-target="#theModal">Nueva categoria
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered bg-white table-striped">
                        <thead>
                            <tr>
                                <th class="text-center text-dark">ID</th>
                                <th class="text-center text-dark">Nombre</th>
                                <th class="text-center text-dark">Descripcion</th>
                                <th class="text-center text-dark">Reporte Unico</th>
                                <th class="text-center text-dark">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $c)
                                <tr>
                                    <td class="text-center text-dark">{{ $c->id }}</td>
                                    <td class="text-center text-dark">{{ $c->name }}</td>
                                    <td class="text-center text-dark">{{ $c->description }}</td>
                                    <td class="text-center text-dark">
                                        <a class="btn btn-outline-danger btn-sm"
                                            href="{{ url("/pdf/categorias/{$c->id}") }}">
                                            <i class="fas fa-fw fa-file"></i>
                                            Generar reporte
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger"
                                            wire:click.prevent="Destroy('{{ $c->id }}')">Delete</button>
                                        <button wire:click.prevent="Edit({{ $c->id }})" data-toggle="modal"
                                            data-target="#theModal" class="btn btn-sm btn-outline-success">
                                            Editar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.categorias.form')
</div>


<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('add-categoria', () => {
            new swal(
                'Bien!',
                'LA CATEGORIA SE AGREGO CORRECTAMENTE!',
                'success'
            )
        });
        Livewire.on('update-categoria', () => {
            new swal(
                'Bien!',
                'LA CATEGORIA SE ACTUALIZO CORRECTAMENTE!',
                'success'
            )
        });
        Livewire.on('categoria-delete', () => {
            new swal(
                'Bien!',
                'LA CATEGORIA SE ELIMINO CORRECTAMENTE!',
                'success'
            )
        });
        Livewire.on('not-product', () => {
            Swal.fire(
                'UPSSS!',
                'NO PUEDES ELIMINAR ESTA CATEGORÍA YA QUE TIENE PRODUCTOS ASOCIADOS A ELLA!',
                'error'
            )
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        Livewire.on('diente-add', msg => {
            $('#theModal').modal('hide');
        });
        Livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide');
            setTimeout(function() {
                location.reload();
            }, 800);
        });
        Livewire.on('update-diente', msg => {
            $('#theModal').modal('hide')
        });
    });
</script>
