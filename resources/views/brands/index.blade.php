<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('brands.index') }}
        </h2>
        @if(current_user()->hasRole(['Super Admin', 'Admin']))
            <div class="float-end ms-3">
                <a href="{{ route('brands.create') }}" class="btn btn-hb">{{ __('New Brand') }}</a>
            </div>
        @endif
        @php
            $route = route('brands.index');
            $placeholder = __('Search Brand');
        @endphp
        @include('partials.search')
    </x-slot>
    <div class="container-fluid">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col" style="width:10%">{{ __('Actions') }}</th>
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
                            {{ __('No records found') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $brands->onEachSide(1)->appends($_GET)->links() }}
    </div>
</x-app-layout>
