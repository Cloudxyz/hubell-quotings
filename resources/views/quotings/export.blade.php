<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cotización Hubbell</title>
        <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
    </head>
    <body class="set-font">
        <div>
            <img src="{{ asset('images/logo-large.png') }}" alt="Cotizador Hubbell" class="logo">
            <div class="info">
                <strong>Creado por:</strong> {{ $quoting->user->name }}<br/>
                <strong>Cliente:</strong> {{ $quoting->client }}<br/>
                <strong>Fecha:</strong> {{ $quoting->created_at }}
            </div>
        </div>
        <h2 class="title">
            Cotización
        </h2>
        <div class="container-fluid">
            <table class="table" cellspacing="0" cellpadding="0">
                <thead class="table-dark">
                    <tr>
                        <th class="col">Contacto</th>
                        <th class="col">Dirección</th>
                        <th class="col">Zona</th>
                        <th class="col">Proyecto</th>
                        <th class="col">Duración</th>
                        <th class="col">Vendedor</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $products = json_decode($quoting->products);
                    @endphp
                    <tr>
                        <td>{{ $quoting->contact }}</td>
                        <td>{{ $quoting->address }}</td>
                        <td>{{ $quoting->zone }}</td>
                        <td>{{ $quoting->project }}</td>
                        <td>{{ $quoting->duration }}</td>
                        <td>{{ $quoting->seller }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container-fluid">
            <h2>
                Productos
            </h2>
            <table class="table table-products" cellspacing="0" cellpadding="0">
                <thead class="table-dark">
                    <tr>
                        <th class="col">División</th>
                        <th class="col">Marca</th>
                        <th class="col">Material</th>
                        <th class="col">Descripción</th>
                        <th class="col">Descripción Español</th>
                        <th class="col">Cantidad</th>
                        <th class="col">Precio</th>
                        <th class="col">Monto</th>
                        <th class="col">Moneda</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $products = json_decode($quoting->products);
                        $i = 1;
                    @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->division }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->material }}</td>
                            <td class="col-text-left">{{ $product->description }}</td>
                            <td class="col-text-left">{{ $product->description_es }}</td>
                            <td>{{ $product->quantity }} PZ</td>
                            <td>${{ $product->amount }}</td>
                            <td>${{ $product->total }}</td>
                            <td>{{ $product->unit }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        <div class="text-danger">
            <strong>La cotización es sólo con fines de carácter informativo, no sustituye una cotización formal proporcionada por Hubbell Products México <br />
            *La cotización esta sujeta a cambios de precio, tiempos de entrega, empaques, etc. sin previo aviso</strong>
        </div>
    </body>
</html>