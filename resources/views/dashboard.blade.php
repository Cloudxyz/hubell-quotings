<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instructions to quote') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="d-flex justify-content-center text-danger">
                        Aqui van las instrucciones de como cotizar
                    </div>
                    <br />
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('images/instrucciones.png') }}" class="block h-100 w-auto fill-current text-gray-600 mb-5">
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('quotings.create') }}" class="btn btn-hb">{{ __('New Quoting') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
