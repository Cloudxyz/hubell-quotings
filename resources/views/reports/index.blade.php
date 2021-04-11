<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('reports.index') }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3 title-reports">
            <i class="bi bi-star-fill"></i>&nbsp;&nbsp;{{ __('Top 5 Products') }}
        </h2>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">{{ __('Division') }}</th>
                    <th scope="col">{{ __('Brand') }}</th>
                    <th scope="col">{{ __('Material') }}</th>
                    <th scope="col">{{ __('Description') }}</th>
                    <th scope="col">{{ __('Description Spanish') }}</th>
                    <th scope="col">{{ __('Amount') }}</th>
                    <th scope="col">{{ __('Unit') }}</th>
                    <th scope="col" style="width:10%">{{ __('Min Package') }}</th>
                    <th scope="col">{{ __('ABC') }}</th>
                    <th scope="col" style="width:10%">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
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
                                'skipDelete' => false
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
    </div>
    <div class="container-fluid">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3 title-reports">
            <i class="bi bi-star-fill"></i>&nbsp;&nbsp;{{ __('Top 5 Clients') }}
        </h2>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width:20%">{{ __('Name') }}</th>
                    <th scope="col" style="width:10%">{{ __('Email') }}</th>
                    <th scope="col" style="width:10%"># {{ __('Client') }}</th>
                    <th scope="col" style="width:10%">{{ __('Telephone') }}</th>
                    <th scope="col" style="width:25%">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->profile->client_number }}</td>
                        <td>{{ $client->profile->phone }}</td>
                        <td>
                            @include('components.table.actions', [
                            'params' => [$client->id],
                            'showRoute' => 'users.show',
                            'editRoute' => 'users.edit',
                            'deleteRoute' => 'users.destroy',
                            'skipShow' => current_user()->hasRole(['Super Admin', 'Admin']),
                            'skipEdit' => current_user()->hasRole(['Super Admin', 'Admin']),
                            'skipDelete' => false
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
    </div>
</x-app-layout>
