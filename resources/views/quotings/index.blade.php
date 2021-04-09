<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('quotings.index') }}
        </h2>
        <div class="float-end ms-3">
            <a href="{{ route('quotings.create') }}" class="btn btn-hb">Nueva Cotización</a>
        </div>
        <form class="float-end" action="{{ route('quotings.index') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar Cotización..." name="s" value={{ $search }}>
                <button class="btn btn-hb" type="submit">Buscar</button>
                @if($search)
                    <a href="{{ route('quotings.index') }}" class="btn btn-danger">Limpiar</a>
                @endif
            </div>
        </form>
    </x-slot>
    <div class="container-fluid">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Creado por</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Contacto</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Zona</th>
                    <th scope="col">Proyecto</th>
                    <th scope="col">Duración</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Productos</th>
                    <th scope="col">Fecha</th>
                    <th scope="col" style="width:10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quotings as $quoting)
                    @php
                        $products = json_decode($quoting->products);
                    @endphp
                    <tr>
                        <td>{{ $quoting->user->name }}</td>
                        <td>{{ $quoting->client }}</td>
                        <td>{{ $quoting->contact }}</td>
                        <td>{{ $quoting->address }}</td>
                        <td>{{ $quoting->zone }}</td>
                        <td>{{ $quoting->project }}</td>
                        <td>{{ $quoting->duration }}</td>
                        <td>{{ $quoting->seller }}</td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#productsModal{{ $quoting->id }}" class="btn btn-primary">
                                <i class="bi bi-arrow-up-right-square-fill mr-2"></i>Ver Productos
                            </a>
                            <!-- Modal Products -->
                            <div class="modal fade" id="productsModal{{ $quoting->id }}" tabindex="-1" aria-labelledby="productsModal{{ $quoting->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-products">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="text-center w-100 h2 mb-3 mt-3">
                                                <strong>Productos de la Cotización</strong>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-hover" style="font-size: 14px;">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col">División</th>
                                                        <th scope="col">Marca</th>
                                                        <th scope="col">Material</th>
                                                        <th scope="col">Descripción</th>
                                                        <th scope="col">Descripción Español</th>
                                                        <th scope="col">Cantidad</th>
                                                        <th scope="col">Precio</th>
                                                        <th scope="col">Monto</th>
                                                        <th scope="col">Moneda</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($products as $product)
                                                        <tr>
                                                            <td>{{ $product->division }}</td>
                                                            <td>{{ $product->brand }}</td>
                                                            <td>{{ $product->material }}</td>
                                                            <td>{{ $product->description }}</td>
                                                            <td>{{ $product->description_es }}</td>
                                                            <td>{{ $product->quantity }} PZ</td>
                                                            <td>${{ $product->amount }}</td>
                                                            <td>${{ $product->total }}</td>
                                                            <td>{{ $product->unit }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $quoting->created_at }}</td>
                        <td>
                            <a href="{{ route('quotings.export', [$quoting->id]) }}" class="text-primary icons" target="_blank"><i class="bi bi-file-earmark-arrow-down-fill"></i></a>
                            @include('components.table.actions', [
                                'params' => [$quoting->id],
                                'showHistorial' => 'quotings.quotings',
                                'showRoute' => 'quotings.show',
                                'editRoute' => 'quotings.edit',
                                'deleteRoute' => 'quotings.destroy',
                                'skipHistorial' => false,
                                'skipShow' => false,
                                'skipEdit' => true,
                                'skipDelete' => current_user()->hasRole(['Super Admin', 'Admin'])
                            ])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">
                            No se encontraron registros
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $quotings->onEachSide(1)->appends($_GET)->links() }}
    </div>
</x-app-layout>
