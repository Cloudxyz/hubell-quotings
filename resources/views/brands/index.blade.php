<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('brands.index') }}
        </h2>
        @if(current_user()->hasRole(['Super Admin', 'Admin']))
            <div class="float-end ms-3">
                <a href="{{ route('brands.create') }}" class="btn btn-hb">Nueva Marca</a>
            </div>
        @endif
        <form class="float-end" action="{{ route('brands.index') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar Marca..." name="s" value={{ $search }}>
                <button class="btn btn-hb" type="submit">Buscar</button>
                @if($search)
                    <a href="{{ route('brands.index') }}" class="btn btn-danger">Limpiar</a>
                @endif
            </div>
        </form>
    </x-slot>
    <div class="container-fluid">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col" style="width:10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            @include('components.table.actions', [
                            'params' => [$brand->id],
                            'showRoute' => 'brands.show',
                            'editRoute' => 'brands.edit',
                            'deleteRoute' => 'brands.destroy',
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
        {{ $brands->onEachSide(1)->appends($_GET)->links() }}
    </div>
</x-app-layout>
