<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('users.index') }}
        </h2>
        <div class="float-end ms-3">
            <a href="{{ route('users.create') }}" class="btn btn-hb">Nuevo Usuario</a>
        </div>
        <form class="float-end" action="{{ route('users.index') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar Usuario..." name="s" value={{ $search }}>
                <button class="btn btn-hb" type="submit">Buscar</button>
                @if($search)
                    <a href="{{ route('users.index') }}" class="btn btn-danger">Limpiar</a>
                @endif
            </div>
        </form>
    </x-slot>
    <div class="container-fluid">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width:10%">#</th>
                    <th scope="col" style="width:20%">Nombre</th>
                    <th scope="col" style="width:10%">Email</th>
                    <th scope="col" style="width:10%"># Cliente</th>
                    <th scope="col" style="width:10%">Teléfono</th>
                    <th scope="col" style="width:20%">Roles</th>
                    <th scope="col" style="width:25%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @forelse ($users as $user)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->profile->client_number }}</td>
                        <td>{{ $user->profile->phone }}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $role)
                                {{ ucwords($role) }},
                            @endforeach
                        </td>
                        <td>
                            @include('components.table.actions', [
                            'params' => [$user->id],
                            'showRoute' => 'users.show',
                            'editRoute' => 'users.edit',
                            'deleteRoute' => 'users.destroy',
                            'skipShow' => current_user()->hasRole(['Super Admin', 'Admin']),
                            'skipEdit' => current_user()->hasRole(['Super Admin', 'Admin']),
                            'skipDelete' => current_user()->hasRole(['Super Admin', 'Admin'])
                            ])
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            No se encontraron registros
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->onEachSide(1)->appends($_GET)->links() }}
    </div>
</x-app-layout>
