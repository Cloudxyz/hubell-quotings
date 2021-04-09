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
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>
                <div class="col">
                    <label for="lastname" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
                </div>
                <div class="col">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                </div>
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col">
                    <label for="password_confirmation" class="form-label">Repetir Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="col">
                    <label for="client_number" class="form-label">Número de Cliente</label>
                    <input type="text" class="form-control" id="client_number" name="client_number" value="{{ old('client_number') }}">
                </div>
                <div class="col">
                    <label for="country" class="form-label">País</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="state" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}">
                </div>
                <div class="col">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                </div>
                <div class="col">
                    <label for="street" class="form-label">Calle</label>
                    <input type="text" class="form-control" id="street" name="street" value="{{ old('street') }}">
                </div>
                <div class="col">
                    <label for="zip" class="form-label">C.P.</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') }}">
                </div>
            </div>
            @if (current_user()->hasRole(['Super Admin', 'Admin']))
                <div class="mb-3">
                    <label for="roles" class="form-label">Roles</label>
                    <br />
                    {!! generateColumnsRoles($roles, 4) !!}
                </div>
            @endif
            <button type="submit" class="btn btn-hb">Crear Usuario</button>
        </form>
    </div>
</x-app-layout>
