<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('products.edit', $product->id) }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <form action="{{ route('quotings.update', [$product->id]) }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="division" class="form-label">{{ __('Division') }}</label>
                    <input type="text" class="form-control" id="division" name="division"
                        value="{{ $product->division }}">
                </div>
                <div class="col">
                    <label for="brand" class="form-label">{{ __('Brand') }}</label>
                    <input type="text" class="form-control" id="brand" name="brand"
                        value="{{ $product->brand }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="material" class="form-label">{{ __('Material') }}</label>
                    <input type="text" class="form-control" id="material" name="material"
                        value="{{ $product->material }}">
                </div>
                <div class="col">
                    <label for="amount" class="form-label">{{ __('Amount') }}</label>
                    <input type="text" class="form-control" id="amount" name="amount"
                        value="{{ $product->amount }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="unit" class="form-label">{{ __('Unit') }}</label>
                    <input type="text" class="form-control" id="unit" name="unit"
                        value="{{ $product->unit }}">
                </div>
                <div class="col">
                    <label for="min_package" class="form-label">{{ __('Min Package') }}</label>
                    <input type="text" class="form-control" id="min_package" name="min_package"
                        value="{{ $product->min_package }}">
                </div>
                <div class="col">
                    <label for="abc" class="form-label">{{ __('ABC') }}</label>
                    <input type="text" class="form-control" id="abc" name="abc"
                        value="{{ $product->abc }}">
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Description') }}</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-hb">{{ __('Update Quoting') }}</button>
            </div>
        </form>
    </div>
</x-app-layout>
