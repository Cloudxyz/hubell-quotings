<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('users.edit', $user->id) }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <form action="{{ route('users.update', [$user->id]) }}" class="mb-5" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="firstname" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                        value="{{ $user->name }}">
                </div>
                <div class="col">
                    <label for="lastname" class="form-label">{{ __('Lastname') }}</label>
                    <input type="text" class="form-control" id="lastname" name="lastname"
                        value="{{ $user->profile->lastname }}">
                </div>
                <div class="col">
                    <label for="phone" class="form-label">{{ __('Telephone') }}</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ $user->profile->phone }}">
                </div>
                <div class="col">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="col">
                    <label for="client_number" class="form-label">{{ __('No. Cliente') }}</label>
                        @if (current_user()->hasRole(['Super Admin', 'Admin']))
                            <input type="text" class="form-control" id="client_number" name="client_number"
                            value="{{ $user->profile->client_number }}">
                        @else
                            <div class="form-control" style="height: 40px">{{ $user->profile->client_number }}</div>
                        @endif
                    </div>
                <div class="col">
                    <label for="country" class="form-label">{{ __('Country') }}</label>
                    <input type="text" class="form-control" id="country" name="country"
                        value="{{ $user->profile->country }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="state" class="form-label">{{ __('State') }}</label>
                    <input type="text" class="form-control" id="state" name="state"
                        value="{{ $user->profile->state }}">
                </div>
                <div class="col">
                    <label for="city" class="form-label">{{ __('City') }}</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $user->profile->city }}">
                </div>
                <div class="col">
                    <label for="street" class="form-label">{{ __('Street') }}</label>
                    <input type="text" class="form-control" id="street" name="street"
                        value="{{ $user->profile->street }}">
                </div>
                <div class="col">
                    <label for="zip" class="form-label">{{ __('Zip') }}</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="{{ $user->profile->zip }}">
                </div>
            </div>
            @if (current_user()->hasRole(['Super Admin', 'Admin']))
                <div class="mb-3">
                    <label for="roles" class="form-label">{{ __('Roles') }}</label>
                    <br />
                    {!! generateColumnsRoles($roles, 4, $user, false) !!}
                </div>
            @endif
            <button type="submit" class="btn btn-hb">{{ __('Update User') }}</button>
        </form>
        @if (current_user()->hasRole(['Super Admin', 'Admin']))
            <div class="title-header h3">
                <strong>{{ __('Discounts') }}</strong>
            </div>
            <form action="{{ route('discounts.store', [$user->id]) }}" class="mb-3" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label for="brand" class="form-label">{{ __('Brand') }}</label>
                        <select class="form-select" id="brand" name="brand">
                            <option selected>{{ __('Select Brand') }}</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="discount" class="form-label">{{ __('Descuento') }}</label>
                        <input type="number" class="form-control" id="discount" name="discount" value="0" min="0">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-hb">{{ __('Add Discount') }}</button>
                </div>
            </form>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Brand') }}</th>
                        <th scope="col">{{ __('Descuento') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user->discounts as $discount)
                        <tr>
                            <td>{{ $discount->id }}</td>
                            <td>{{ $discount->brand->name }}</td>
                            <td>{{ $discount->discount }}%</td>
                            <td>
                                @include('components.table.actions', [
                                'params' => [$discount->id],
                                'showRoute' => false,
                                'editRoute' => false,
                                'deleteRoute' => 'discounts.destroy',
                                'skipShow' => false,
                                'skipEdit' => false,
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
        @endif
    </div>
</x-app-layout>
