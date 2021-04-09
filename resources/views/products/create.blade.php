<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('products.create') }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="division" class="form-label">División</label>
                    <input type="text" class="form-control" id="division" name="division" value="{{ old('division') }}">
                </div>
                <div class="col">
                    <label for="brand" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="material" class="form-label">Material</label>
                    <input type="text" class="form-control" id="material" name="material" value="{{ old('material') }}">
                </div>
                <div class="col">
                    <label for="amount" class="form-label">Cantidad</label>
                    <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="unit" class="form-label">Moneda</label>
                    <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit') }}">
                </div>
                <div class="col">
                    <label for="min_package" class="form-label">Empaque Mínimo</label>
                    <input type="text" class="form-control" id="min_package" name="min_package" value="{{ old('min_package') }}">
                </div>
                <div class="col">
                    <label for="abc" class="form-label">ABC</label>
                    <input type="text" class="form-control" id="abc" name="abc" value="{{ old('abc') }}">
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="description_es" class="form-label">Descripción Español</label>
                <textarea name="description_es" id="description_es" cols="30" rows="5" class="form-control">{{ old('description_es') }}</textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-hb">Crear Producto</button>
            </div>
        </form>
    </div>
</x-app-layout>
