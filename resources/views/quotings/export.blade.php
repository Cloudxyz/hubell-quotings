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
                <strong>{{ __('Created by') }}:</strong> {{ $quoting->user->name }}<br/>
                <strong>{{ __('Client') }}:</strong> {{ $quoting->client }}<br/>
                <strong>{{ __('Date') }}:</strong> {{ $quoting->created_at }}
            </div>
        </div>
        <h2 class="title">
            {{ __('Quoting') }}
        </h2>
        <div class="container-fluid">
            <table class="table" cellspacing="0" cellpadding="0">
                <thead class="table-dark">
                    <tr>
                        <th class="col">{{ __('Contact') }}</th>
                        <th class="col">{{ __('Address') }}</th>
                        <th class="col">{{ __('Zone') }}</th>
                        <th class="col">{{ __('Project') }}</th>
                        <th class="col">{{ __('Duration') }}</th>
                        <th class="col">{{ __('Seller') }}</th>
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
                {{ __('Products') }}
            </h2>
            <table class="table table-products" cellspacing="0" cellpadding="0">
                <thead class="table-dark">
                    <tr>
                        <th class="col">{{ __('Division') }}</th>
                        <th class="col">{{ __('Brand') }}</th>
                        <th class="col">{{ __('Material') }}</th>
                        <th class="col">{{ __('Description') }}</th>
                        <th class="col">{{ __('Description Spanish') }}</th>
                        <th class="col">{{ __('Amount') }}</th>
                        <th class="col">{{ __('Price') }}</th>
                        <th class="col">{{ __('Total') }}</th>
                        <th class="col">{{ __('Unit') }}</th>
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
                    @if($quoting->total_usd)
                        <tr>
                            <td colspan="9" class="col-text-right">
                                <strong>Total USD:</strong> $<span class="total-usd">{{ number_format($quoting->total_usd, 2) }}</span>
                            </td>
                        </tr>
                    @endif
                    @if($quoting->total_mxn)
                        <tr>
                            <td colspan="9" class="col-text-right">
                                <strong>Total MXN:</strong> $<span class="total-mxn">{{ number_format($quoting->total_mxn, 2) }}</span>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <br />
        <div class="text-danger">
            <strong>{{ __('The quote is for informational purposes only, it does not replace a formal quote provided by Hubbell Products Mexico.') }} <br />
            {{ __('* The quote is subject to price changes, delivery times, packaging, etc. without prior notice') }}</strong>
        </div>
    </body>
</html>