<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('products.show', $product->id) }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <label for="division" class="form-label">División</label>
                <div class="form-control" style="height: 40px">{{ $product->division }}</div>
            </div>
            <div class="col">
                <label for="lastname" class="form-label">Marca</label>
                <div class="form-control" style="height: 40px">{{ $product->brand }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="material" class="form-label">Material</label>
                <div class="form-control" style="height: 40px">{{ $product->material }}</div>
            </div>
            <div class="col">
                <label for="amount" class="form-label">Cantidad</label>
                <div class="form-control" style="height: 40px">{{ $product->amount }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="unit" class="form-label">Moneda</label>
                <div class="form-control" style="height: 40px">{{ $product->unit }}</div>
            </div>
            <div class="col">
                <label for="min_package" class="form-label">Empaque Mínimo</label>
                <div class="form-control" style="height: 40px">{{ $product->min_package }}</div>
            </div>
            <div class="col">
                <label for="abc" class="form-label">ABC</label>
                <div class="form-control" style="height: 40px">{{ $product->abc }}</div>
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <div class="form-control" style="height: 40px">{{ $product->description }}</div>
        </div>
        <a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-hb">Editar</a>
    </div>
</x-app-layout>
