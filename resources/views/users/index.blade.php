<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('users.index') }}
        </h2>
        <div class="float-end ms-3">
            <a href="{{ route('users.create') }}" class="btn btn-hb">{{ __('New User') }}</a>
        </div>
        @php
            $route = route('users.index');
            $placeholder = __('Search User');
        @endphp
        @include('partials.search')
    </x-slot>
    <div class="container-fluid">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width:10%">#</th>
                    <th scope="col" style="width:20%">{{ __('Name') }}</th>
                    <th scope="col" style="width:10%">{{ __('Email') }}</th>
                    <th scope="col" style="width:10%"># {{ __('Client') }}</th>
                    <th scope="col" style="width:10%">{{ __('Telephone') }}</th>
                    <th scope="col" style="width:20%">{{ __('Roles') }}</th>
                    <th scope="col" style="width:25%">{{ __('Actions') }}</th>
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
                            {{ __('No records found') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->onEachSide(1)->appends($_GET)->links() }}
    </div>
</x-app-layout>
