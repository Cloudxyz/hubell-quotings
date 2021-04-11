<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('quotings.index') }}
        </h2>
        <div class="float-end ms-3">
            <a href="{{ route('quotings.create') }}" class="btn btn-hb">{{ __('New Quoting') }}</a>
        </div>
        @php
            $route = route('quotings.index');
            $placeholder = __('Search Quoting');
        @endphp
        @include('partials.search')
    </x-slot>
    <div class="container-fluid">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">{{ __('Created by') }}</th>
                    <th scope="col">{{ __('Client') }}</th>
                    <th scope="col">{{ __('Contact') }}</th>
                    <th scope="col">{{ __('Address') }}</th>
                    <th scope="col">{{ __('Zone') }}</th>
                    <th scope="col">{{ __('Project') }}</th>
                    <th scope="col">{{ __('Duration') }}</th>
                    <th scope="col">{{ __('Seller') }}</th>
                    <th scope="col">{{ __('Total USD') }}</th>
                    <th scope="col">{{ __('Total MXN') }}</th>
                    <th scope="col">{{ __('Products') }}</th>
                    <th scope="col">{{ __('Date') }}</th>
                    <th scope="col" style="width:10%">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quotings as $quoting)
                    @php
                        $products = json_decode($quoting->products);
                    @endphp
                    <tr>
                        <td>{{ $quoting->user->name }}</td>
                        <td>{{ $quoting->client }}</td>
                        <td>{{ $quoting->contact }}</td>
                        <td>{{ $quoting->address }}</td>
                        <td>{{ $quoting->zone }}</td>
                        <td>{{ $quoting->project }}</td>
                        <td>{{ $quoting->duration }}</td>
                        <td>{{ $quoting->seller }}</td>
                        <td>${{ number_format($quoting->total_usd, 2) }}</td>
                        <td>${{ number_format($quoting->total_mxn, 2) }}</td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#productsModal{{ $quoting->id }}" class="btn btn-primary">
                                <i class="bi bi-arrow-up-right-square-fill mr-2"></i>{{ __('View Products') }}
                            </a>
                            <!-- Modal Products -->
                            <div class="modal fade" id="productsModal{{ $quoting->id }}" tabindex="-1" aria-labelledby="productsModal{{ $quoting->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-products">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="text-center w-100 h2 mb-3 mt-3">
                                                <strong>{{ __('Quote Products') }}</strong>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-hover" style="font-size: 14px;">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col">{{ __('Division') }}</th>
                                                        <th scope="col">{{ __('Brand') }}</th>
                                                        <th scope="col">{{ __('Material') }}</th>
                                                        <th scope="col">{{ __('Description') }}</th>
                                                        <th scope="col">{{ __('Description Spanish') }}</th>
                                                        <th scope="col">{{ __('Amount') }}</th>
                                                        <th scope="col">{{ __('Price') }}</th>
                                                        <th scope="col">{{ __('Total') }}</th>
                                                        <th scope="col">{{ __('Unit') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($products as $product)
                                                        <tr>
                                                            <td>{{ $product->division }}</td>
                                                            <td>{{ $product->brand }}</td>
                                                            <td>{{ $product->material }}</td>
                                                            <td>{{ $product->description }}</td>
                                                            <td>{{ $product->description_es }}</td>
                                                            <td>{{ $product->quantity }} PZ</td>
                                                            <td>${{ $product->amount }}</td>
                                                            <td>${{ $product->total }}</td>
                                                            <td>{{ $product->unit }}</td>
                                                        </tr>
                                                    @endforeach
                                                    @if($quoting->total_usd)
                                                        <tr>
                                                            <td colspan="13" class="text-right">
                                                                <strong>Total USD:</strong> $<span class="total-usd">{{ number_format($quoting->total_usd, 2) }}</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if($quoting->total_mxn)
                                                        <tr>
                                                            <td colspan="13" class="text-right">
                                                                <strong>Total MXN:</strong> $<span class="total-mxn">{{ number_format($quoting->total_mxn, 2) }}</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $quoting->created_at }}</td>
                        <td>
                            <a href="{{ route('quotings.export', [$quoting->id]) }}" class="text-primary icons" target="_blank"><i class="bi bi-file-earmark-arrow-down-fill"></i></a>
                            @include('components.table.actions', [
                                'params' => [$quoting->id],
                                'showHistorial' => 'quotings.quotings',
                                'showRoute' => 'quotings.show',
                                'editRoute' => 'quotings.edit',
                                'deleteRoute' => 'quotings.destroy',
                                'skipHistorial' => false,
                                'skipShow' => false,
                                'skipEdit' => true,
                                'skipDelete' => current_user()->hasRole(['Super Admin', 'Admin'])
                            ])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">
                            {{ __('No records found') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $quotings->onEachSide(1)->appends($_GET)->links() }}
    </div>
</x-app-layout>
