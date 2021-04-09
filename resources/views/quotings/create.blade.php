<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('quotings.create') }}
        </h2>
    </x-slot>
    @php
        $client = current_user()->profile->client_number;
        $contact = current_user()->profile->phone;
        $address = current_user()->profile->street.' '.current_user()->profile->zip.', '.current_user()->profile->city.', '.current_user()->profile->state.', '.current_user()->profile->country;
    @endphp
    <div class="container-fluid mb-5">
        <form action="{{ route('quotings.products.add') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="client" class="form-label">{{ __('Client') }}</label>
                    @if (current_user()->hasRole(['Super Admin', 'Admin']))
                        <input type="text" class="form-control" id="client" name="client" 
                            value="{{ (session()->get('client')) ? session()->get('client') : old('client') }}">
                    @else
                        <input type="text" class="form-control" id="client" name="client" 
                            value="{{ (session()->get('client')) ? session()->get('client') : $client }}" readonly>
                    @endif
                </div>
                <div class="col">
                    <label for="contact" class="form-label">{{ __('Contact') }}</label>
                    @if (current_user()->hasRole(['Super Admin', 'Admin']))
                        <input type="text" class="form-control" id="contact" name="contact" 
                            value="{{ (session()->get('contact')) ? session()->get('contact') : old('client') }}">
                    @else
                        <input type="text" class="form-control" id="contact" name="contact"
                            value="{{ (session()->get('contact')) ? session()->get('contact') : $contact }}">
                    @endif
                </div>
                <div class="col">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    @if (current_user()->hasRole(['Super Admin', 'Admin']))
                        <input type="text" class="form-control" id="address" name="address" 
                            value="{{ (session()->get('address')) ? session()->get('address') : old('client') }}">
                    @else
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ (session()->get('address')) ? session()->get('address') : $address }}">
                    @endif
                </div>
                <div class="col">
                    <label for="zone" class="form-label">{{ __('Zone') }}</label>
                    <input type="text" class="form-control" id="zone" name="zone"
                        value="{{ (session()->get('zone')) ? session()->get('zone') : old('zone') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="project" class="form-label">{{ __('Project') }}</label>
                    <input type="text" class="form-control" id="project" name="project"
                        value="{{ (session()->get('project')) ? session()->get('project') : old('project') }}">
                </div>
                <div class="col">
                    <label for="duration" class="form-label">{{ __('Duration') }}</label>
                    <input type="text" class="form-control" id="duration" name="duration"
                        value="{{ (session()->get('duration')) ? session()->get('duration') : old('duration') }}">
                </div>
                <div class="col">
                    <label for="seller" class="form-label">{{ __('Seller') }}</label>
                    <input type="text" class="form-control" id="seller" name="seller"
                        value="{{ (session()->get('seller')) ? session()->get('seller') : old('seller') }}">
                </div>
                <div class="col">
                    <label for="date" class="form-label">{{ __('Date') }}</label>
                    <div class="form-control">{{ date("F j, Y, g:i a") }}</div>
                </div>
                <div class="col">
                    <label for="material" class="form-label">Número de Catálogo</label>
                    <input type="text" class="form-control" id="material" name="material" value="{{ old('material') }}">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-hb">{{ __('Search Product') }}</button>
            </div>
        </form>
        <p class="text-danger">
            <strong>El cotizador es sólo con fines de carácter informativo, no sustituye una cotización formal proporcionada por Hubbell Products México <br />
            *Este cotizador esta sujeto a cambios de precio, tiempos de entrega, empaques, etc. sin previo aviso</strong>
        </p>
    </div>
    @if(session()->exists('products'))
        <div class="container-fluid">
            <div class="title-header h3">
                <strong>{{ __('Products') }}</strong>
            </div>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Catalogue') }}</th>
                        <th scope="col">{{ __('Description') }}</th>
                        <th scope="col">{{ __('Description Spanish') }}</th>
                        <th scope="col">{{ __('Brand') }}</th>
                        <th scope="col">{{ __('Delivery time') }}</th>
                        <th scope="col">{{ __('Min Package') }}</th>
                        <th scope="col">{{ __('Amount') }}</th>
                        <th scope="col">{{ __('List Price') }}</th>
                        <th scope="col">{{ __('Dto.') }}</th>
                        <th scope="col">{{ __('Total') }}</th>
                        <th scope="col">{{ __('Unit') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $products = json_decode(session()->get('products'));
                        $i = 1;
                    @endphp
                    @foreach ($products as $product)
                        @php
                            $quantity = (isset($product->quantity))?$product->quantity:$product->input_min;
                            $total = (isset($product->total))?$product->total:$product->amount;
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $product->material }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->abc }}</td>
                            <td>{{ $product->min_package }}</td>
                            <td>
                                <input type="number" name="quantity" min="{{ $product->input_min }}" class="w-100" value="{{ $quantity }}" data-route={{ route('quotings.update.product') }} data-material={{ $product->material }}>
                            </td>
                            <td>${{ $product->amount }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>${{ $total }}</td>
                            <td>{{ $product->unit }}</td>
                            <td>
                                <a href="{{ route('quotings.products.remove', [$product->id]) }}" class="remove_product text-danger mr-2 icons"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        @php
                            $i ++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('quotings.store') }}" class="btn btn-hb float-right">{{ __('Generate Quoting') }}</a>
        </div>
    @endif
</x-app-layout>
