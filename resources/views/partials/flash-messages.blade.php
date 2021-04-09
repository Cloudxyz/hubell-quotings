@if (Session::has('success'))
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="alert alert-success app-alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="alert alert-danger app-alert-danger" role="alert">
            {!! Session::get('error') !!}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="alert alert-danger app-alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    </div>
@endif
