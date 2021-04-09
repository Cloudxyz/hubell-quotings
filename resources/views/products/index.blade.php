<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('products.index') }}
        </h2>
        @if(current_user()->hasRole(['Super Admin', 'Admin']))
            <div class="float-end ms-3">
                <a id="smallButton" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-danger">
                    Importar Productos
                </a>
                <a href="{{ route('products.create') }}" class="btn btn-hb">Nuevo Producto</a>
            </div>
        @endif
        <form class="float-end" action="{{ route('products.index') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar Producto..." name="s" value={{ $search }}>
                <button class="btn btn-hb" type="submit">Buscar</button>
                @if($search)
                    <a href="{{ route('products.index') }}" class="btn btn-danger">Limpiar</a>
                @endif
            </div>
        </form>
    </x-slot>
    <div class="container-fluid">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">División</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Material</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Descripción Español</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Moneda</th>
                    <th scope="col" style="width:10%">Empaque Min.</th>
                    <th scope="col">ABC</th>
                    <th scope="col" style="width:10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->division }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->material }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->description_es }}</td>
                        <td>{{ $product->amount }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->min_package }}</td>
                        <td>{{ $product->abc }}</td>
                        <td>
                            @include('components.table.actions', [
                                'params' => [$product->id],
                                'showRoute' => 'products.show',
                                'editRoute' => 'products.edit',
                                'deleteRoute' => 'products.destroy',
                                'skipShow' => current_user()->hasRole(['Super Admin', 'Admin']),
                                'skipEdit' => current_user()->hasRole(['Super Admin', 'Admin']),
                                'skipDelete' => current_user()->hasRole(['Super Admin', 'Admin'])
                            ])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">
                            No se encontraron registros
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->onEachSide(1)->appends($_GET)->links() }}
    </div>
</x-app-layout>

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('products.import') }}">
            <div class="modal-body">
                <h3 class="text-center border-0 mt-5 mb-3"><strong>¿Estas seguro que quieres importar los productos?</strong></h3>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Importar</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>
