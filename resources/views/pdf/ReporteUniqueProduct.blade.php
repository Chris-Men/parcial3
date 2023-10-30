<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>@yield('title', 'Producto unico')</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h6>Detalles del producto # {{ $productos->id }}</h6>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered bg-white table-sm">
                    <thead>
                        <tr>
                            <th class="text-center text-dark">Nombre</th>
                            <th class="text-center text-dark">Descripcion</th>
                            <th class="text-center text-dark">Precio</th>
                            <th class="text-center text-dark">Stock</th>
                            <th class="text-center text-dark">Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center text-dark">{{ $productos->name }}</td>
                            <td class="text-center text-dark">{{ $productos->descripcion }}</td>
                            <td class="text-center text-dark">${{ number_format($productos->price, 2) }}</td>
                            <td class="text-center text-dark">{{ $productos->stock }}</td>
                            <td class="text-center text-dark">{{ $productos->categorias->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>


</body>

</html>
