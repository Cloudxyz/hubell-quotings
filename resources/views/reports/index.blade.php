<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline-flex">
            {{ Breadcrumbs::render('reports.index') }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Producto Más Cotizado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>AQUI VA EL PRODUCTO BITCH</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
