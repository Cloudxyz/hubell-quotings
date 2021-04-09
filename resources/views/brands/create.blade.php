<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('brands.create') }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <form action="{{ route('brands.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-hb">{{ __('Create Brand') }}</button>
        </form>
    </div>
</x-app-layout>
