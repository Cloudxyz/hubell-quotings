<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('products.index') }}
        </h2>
        @if(current_user()->hasRole(['Super Admin', 'Admin']))
            <div class="float-end ms-3">
                <a id="smallButton" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-danger">
                    {{ __('Import Products') }}
                </a>
                <a href="{{ route('products.create') }}" class="btn btn-hb">{{ __('New Product') }}</a>
            </div>
        @endif
        @php
            $route = route('products.index');
            $placeholder = __('Search Product');
        @endphp
        @include('partials.search')
    </x-slot>
    <div class="container-fluid">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Division') }}</th>
                    <th scope="col">{{ __('Brand') }}</th>
                    <th scope="col">{{ __('Material') }}</th>
                    <th scope="col">{{ __('Description') }}</th>
                    <th scope="col">{{ __('Description Spanish') }}</th>
                    <th scope="col">{{ __('Amount') }}</th>
                    <th scope="col">{{ __('Unit') }}</th>
                    <th scope="col" style="width:10%">{{ __('Min Package') }}</th>
                    <th scope="col">{{ __('ABC') }}</th>
                    @if(current_user()->hasRole(['Super Admin', 'Admin']))
                        <th scope="col" style="width:10%">{{ __('Actions') }}</th>
                    @endif
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
                            {{ __('No records found') }}
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
                <h3 class="text-center border-0 mt-5 mb-3"><strong>{{ __('Are you sure you want to import the products?') }}</strong></h3>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Import') }}</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>
