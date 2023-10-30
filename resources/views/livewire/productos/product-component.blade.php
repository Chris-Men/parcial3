<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h6 class="text-center text-dark">{{ $pageTitle }} | {{ $componentName }}</h6>
            </div>
            <div class="card-body">
                <a style="background: #3b3f5c" class="btn btn-sm mb-2 mtmobile text-white" href="javascript:void(0)"
                    data-toggle="modal" data-target="#theModal">Nuevo producto
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered bg-white table-striped">
                        <thead>
                            <tr>
                                <th class="text-center text-dark">ID</th>
                                <th class="text-center text-dark">Nombre</th>
                                <th class="text-center text-dark">Descripcion</th>
                                <th class="text-center text-dark">Reporte Unico</th>
                                <th class="text-center text-dark">Precio</th>
                                <th class="text-center text-dark">Stock</th>
                                <th class="text-center text-dark">Categoria</th>
                                <th class="text-center text-dark">Qr</th>
                                <th class="text-center text-dark">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                                <tr>
                                    <td class="text-center text-dark">{{ $p->id }}</td>
                                    <td class="text-center text-dark">{{ $p->name }}</td>
                                    <td class="text-center text-dark">{{ $p->descripcion }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-danger btn-sm"
                                            href="{{ url("/pdf/productos/{$p->id}") }}">
                                            <i class="fas fa-fw fa-file"></i>
                                            Generar reporte
                                        </a>
                                    </td>
                                    <td class="text-center text-dark">${{ number_format($p->price, 2) }}</td>
                                    <td class="text-center text-white">
                                        <span
                                            class="badge bg-success {{ $p->stock >= 10 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $p->stock }}
                                        </span>
                                    </td>
                                    <td class="text-center text-dark">{{ $p->namecategoria }}</td>
                                    <td class="text-center text-dark">
                                        {!! QrCode::size(100)->generate($p->name); !!}
                                        <p>{{ $p->id }}</p>
                                    </td>                                    
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger"
                                            wire:click.prevent="Destroy('{{ $p->id }}')">Delete</button>
                                        <button wire:click.prevent="Edit({{ $p->id }})" data-toggle="modal"
                                            data-target="#theModal" class="btn btn-sm btn-outline-success">
                                            Editar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.productos.form')
</div>


<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('add-producto', () => {
            new swal(
                'Bien!',
                'EL PRODUCTO SE AGREGO CORRECTAMENTE!',
                'success'
            )
        });
        Livewire.on('update-producto', () => {
            new swal(
                'Bien!',
                'El PRODUCTO SE ACTUALIZO CORRECTAMENTE!',
                'success'
            )
        });
        Livewire.on('producto-delete', () => {
            new swal(
                'Bien!',
                'EL PRODUCTO SE ELIMINO CORRECTAMENTE!',
                'success'
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
