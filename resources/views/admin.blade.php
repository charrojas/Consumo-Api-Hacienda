@extends('app')

@section('contenido')
    <div class="container">

        <div class="row">

            <div class="col-sm-4">
                <div class="card shadow mt-4 border-dark"
                    style="width: 200%;max-width: 1000px;max-height: 1000px;height: 100%;;left: 50%;">

                    <div class="card-body">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-manual" type="button">Tipo
                                    de cambio</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-exoneracion"
                                    type="button">Exoneraciones</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-cabys"
                                    type="button">CABYS</button>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="tab-manual">

                                <!-- Inicia detalle manual -->

                                <div class="my-3">
                                    <h5 for="">Tipo de cambio del dolar.</h5>
                                    <hr>
                                </div>

                                <div class="col">
                                    <label for="">Venta:</label>
                                    <span>{{ $tipoCambio['venta']['valor'] }}</span>
                                </div>

                                <div class="col">
                                    <label for="">Compra:</label>
                                    <span>{{ $tipoCambio['compra']['valor'] }}</span>
                                </div>

                                <!-- Fin detalle manual -->

                            </div>

                            <div class="tab-pane" id="tab-exoneracion">

                                <!-- Inicia detalle exoneración -->

                                <div class="my-3">

                                    <div class="my-3">
                                        <h5 for="">EXONERACIONES</h5>
                                        <hr>
                                    </div>
                                </div>

                                <form id="form-exoneracion" method="POST" action="{{ route('obtenerDatos') }}">
                                    @csrf
                                    <div class="row">
                                        <label for="autorizacion">Código de exoneración:</label>
                                        <div class="col-md-8">
                                            <input class="form-control" name="autorizacion" id="autorizacion" required>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-outline-primary" type="submit"
                                                data-bs-target="#tab-exoneracion">Buscar</button>
                                        </div>
                                    </div>
                                </form>

                                <div id="resultado-exoneracion">

                                    @isset($datos)
                                        <div class="my-3">
                                            <label>Número de Documento:</label>
                                            <span>{{ $datos['numeroDocumento'] }}</span>
                                        </div>
                                        <div class="my-3">
                                            <label>Fecha de Emisión:</label>
                                            <span>{{ $datos['fechaEmision'] }}</span>
                                        </div>
                                        <div class="my-3">
                                            <label>Fecha de vencimiento:</label>
                                            <span>{{ $datos['fechaVencimiento'] }}</span>
                                        </div>
                                        <div class="my-3">
                                            <label>Porcentaje de Exoneración:</label>
                                            <span>{{ $datos['porcentajeExoneracion'] }}</span>
                                        </div>
                                        <div class="my-3">
                                            <label>Tipo de documento:</label>
                                            <span>{{ $datos['tipoDocumento']['descripcion'] }}</span>
                                        </div>
                                        <div class="my-3">
                                            <label>Nombre de la Institución:</label>
                                            <span>{{ $datos['nombreInstitucion'] }}</span>
                                        </div>
                                    @endisset
                                </div>

                            </div>

                            <div class="tab-pane" id="tab-cabys">
                                <div class="my-3">
                                    <div class="my-3">
                                        <h5 for="">CABYS</h5>
                                        <hr>
                                    </div>

                                    <form id="form-cabys" method="POST" action="{{ route('buscarPorNombre') }}">
                                        @csrf
                                        <div class="row">
                                            <label for="nombre">Buscar por nombre:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="nombre" id="nombre" required>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-outline-primary" type="submit"
                                                    data-bs-target="#tab-cabys">Buscar</button>
                                            </div>
                                        </div>

                                    </form>
                                    <div class="card mt-4 shadow border-dark">
                                        <div class="table-responsive">
                                            <div class="table-container">
                                                <table id="tabla_detalles" class="table table-bordered table-hover">
                                                    <thead class="bg-dark text-light">
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Descripción</th>
                                                            <th>Impuesto</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @isset($resultados)
                                                            @foreach ($resultados as $producto)
                                                                <tr>
                                                                    <td>{{ $producto['codigo'] }}</td>
                                                                    <td>{{ $producto['descripcion'] }}</td>
                                                                    <td>{{ $producto['impuesto'] }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endisset
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            document.getElementById('form-exoneracion').addEventListener('submit', function(event) {
                event.preventDefault();

                var form = event.target;
                var formData = new FormData(form);

                fetch(form.action, {
                        method: form.method,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams(formData)
                    })
                    .then(response => response.json())
                    .then(data => {

                        document.getElementById('resultado-exoneracion').innerHTML = buildResultHTML(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            function buildResultHTML(data) {

                var html = '';

                if (data) {
                    html += '<div class="my-3">';
                    html += '<label>Número de Documento:</label>';
                    html += '<span>' + data.numeroDocumento + '</span>';
                    html += '</div>';
                    html += '<div class="my-3">';
                    html += '<label>Fecha de Emisión:</label>';
                    html += '<span>' + data.fechaEmision + '</span>';
                    html += '</div>';
                    html += '<div class="my-3">';
                    html += '<label>Fecha de vencimiento:</label>';
                    html += '<span>' + data.fechaVencimiento + '</span>';
                    html += '</div>';
                    html += '<div class="my-3">';
                    html += '<label>Porcentaje de Exoneración:</label>';
                    html += '<span>' + data.porcentajeExoneracion + '</span>';
                    html += '</div>';
                    html += '<div class="my-3">';
                    html += '<label>Tipo de documento:</label>';
                    html += '<span>' + data.tipoDocumento.descripcion + '</span>';
                    html += '</div>';
                    html += '<div class="my-3">';
                    html += '<label>Nombre de la Institución:</label>';
                    html += '<span>' + data.nombreInstitucion + '</span>';
                    html += '</div>';
                }

                return html;
            }
        </script>

        <script>
            document.getElementById('form-cabys').addEventListener('submit', function(event) {
                event.preventDefault();

                var form = event.target;
                var formData = new FormData(form);

                fetch(form.action, {
                        method: form.method,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('tabla_detalles').innerHTML = buildTableHTML(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            function buildTableHTML(data) {
                var html = '';

                if (data && data.length > 0) {
                    html += '<thead class="bg-dark text-light">'
                    html += '<th>Código</th>';
                    html += '<th>Descripción</th>';
                    html += '<th>Impuesto</th>';
                    html += '</thead>';
                    data.forEach(producto => {
                        html += '<tr>';
                        html += '<td>' + producto.codigo + '</td>';
                        html += '<td>' + producto.descripcion + '</td>';
                        html += '<td>' + producto.impuesto + '</td>';
                        html += '</tr>';
                    });
                }

                return html;
            }
        </script>


    @endsection
