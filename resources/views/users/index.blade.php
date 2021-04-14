<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('users.index') }}
        </h2>
        @if(current_user()->hasRole(['Super Admin', 'Admin']))
            <div class="float-end ms-3">
                <a id="smallButton" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-danger">
                    {{ __('Import Users') }}
                </a>
                <a href="{{ route('users.create') }}" class="btn btn-hb">{{ __('New User') }}</a>
            </div>
        @endif
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

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('users.import') }}">
            <div class="modal-body">
                <h3 class="text-center border-0 mt-5 mb-3"><strong>{{ __('Are you sure you want to import the users?') }}</strong></h3>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Import') }}</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>
