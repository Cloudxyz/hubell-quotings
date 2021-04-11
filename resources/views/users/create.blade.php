<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('users.create') }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="firstname" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('name') }}" required>
                </div>
                <div class="col">
                    <label for="lastname" class="form-label">{{ __('Lastname') }}</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
                </div>
                <div class="col">
                    <label for="phone" class="form-label">{{ __('Telephone') }}</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                </div>
                <div class="col">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
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
                    <input type="text" class="form-control" id="client_number" name="client_number" value="{{ old('client_number') }}" required>
                </div>
                <div class="col">
                    <label for="country" class="form-label">{{ __('Country') }}</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="state" class="form-label">{{ __('State') }}</label>
                    <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}">
                </div>
                <div class="col">
                    <label for="city" class="form-label">{{ __('City') }}</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                </div>
                <div class="col">
                    <label for="street" class="form-label">{{ __('Street') }}</label>
                    <input type="text" class="form-control" id="" name="street" value="{{ old('street') }}">
                </div>
                <div class="col">
                    <label for="zip" class="form-label">{{ __('Zip') }}</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') }}">
                </div>
            </div>
            @if (current_user()->hasRole(['Super Admin', 'Admin']))
                <div class="mb-3">
                    <label for="roles" class="form-label">{{ __('Roles') }}</label>
                    <br />
                    {!! generateColumnsRoles($roles, 4) !!}
                </div>
            @endif
            <button type="submit" class="btn btn-hb">{{ __('Create User') }}</button>
        </form>
    </div>
</x-app-layout>
