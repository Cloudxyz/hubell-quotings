<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('brands.edit', $brand->id) }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <form action="{{ route('brands.update', [$brand->id]) }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $brand->name }}">
                </div>
            </div>
            <button type="submit" class="btn btn-hb">Actualizar</button>
        </form>
    </div>
</x-app-layout>
