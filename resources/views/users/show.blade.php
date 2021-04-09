<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('users.show', $user->id) }}
        </h2>
    </x-slot>
    <div class="container-fluid mb-5">
        <div class="row mb-3">
            <div class="col">
                <label for="name" class="form-label">Nombre</label>
                <div class="form-control" style="height: 40px">{{ $user->name }}</div>
            </div>
            <div class="col">
                <label for="lastname" class="form-label">Apellido</label>
                <div class="form-control" style="height: 40px">{{ $user->profile->lastname }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="phone" class="form-label">Teléfono</label>
                <div class="form-control" style="height: 40px">{{ $user->profile->phone }}</div>
            </div>
            <div class="col">
                <label for="email" class="form-label">Email</label>
                <div class="form-control" style="height: 40px">{{ $user->email }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="client_number" class="form-label">Número de Cliente</label>
                <div class="form-control" style="height: 40px">{{ $user->profile->client_number }}</div>
            </div>
            <div class="col">
                <label for="country" class="form-label">País</label>
                <div class="form-control" style="height: 40px">{{ $user->profile->country }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="state" class="form-label">Estado</label>
                <div class="form-control" style="height: 40px">{{ $user->profile->state }}</div>
            </div>
            <div class="col">
                <label for="city" class="form-label">Ciudad</label>
                <div class="form-control" style="height: 40px">{{ $user->profile->city }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="street" class="form-label">Calle</label>
                <div class="form-control" style="height: 40px">{{ $user->profile->street }}</div>
            </div>
            <div class="col">
                <label for="zip" class="form-label">C.P.</label>
                <div class="form-control" style="height: 40px">{{ $user->profile->zip }}</div>
            </div>
        </div>
        @if (current_user()->hasRole('Super Admin'))
            <div class="mb-3">
                <label for="roles" class="form-label">Roles</label>
                <br />
                {!! generateColumnsRoles($user->roles, 4, $user, true) !!}
            </div>
        @endif
        <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-hb">Editar Usuario</a>
    </div>
    <div class="title-header h3">
        <strong>Descuentos</strong>
    </div>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Marca</th>
                <th scope="col">Descuento</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user->discounts as $discount)
                <tr>
                    <td>{{ $discount->id }}</td>
                    <td>{{ $discount->brand->name }}</td>
                    <td>{{ $discount->discount }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">
                        No se encontraron registros
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-app-layout>
