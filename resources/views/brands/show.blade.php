<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('brands.show', $brand->id) }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <div class="form-control" style="height: 40px">{{ $brand->name }}</div>
            </div>
        </div>
        <a href="{{ route('brands.edit', [$brand->id]) }}" class="btn btn-primary">{{ __('Edit Brand') }}</a>
    </div>
</x-app-layout>
