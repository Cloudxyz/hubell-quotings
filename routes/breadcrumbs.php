<?php

// Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->push('Users', route('users.index'));
});

// Users > Crear Usuario
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Crear Usuario', route('users.create'));
});

// Users > Ver Usuario
Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push('Ver Usuario', route('users.show', $user));
});

// Users > Editar Usuario
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push('Actualizar Usuario', route('users.edit', $user));
});

// Products
Breadcrumbs::for('products.index', function ($trail) {
    $trail->push('Productos', route('products.index'));
});

// Products > Crear Producto
Breadcrumbs::for('products.create', function ($trail) {
    $trail->parent('products.index');
    $trail->push('Crear Producto', route('products.create'));
});

// Products > Ver Producto
Breadcrumbs::for('products.show', function ($trail, $product) {
    $trail->parent('products.index');
    $trail->push('Ver Producto', route('products.show', $product));
});

// Products > Editar Producto
Breadcrumbs::for('products.edit', function ($trail, $product) {
    $trail->parent('products.index');
    $trail->push('Actualizar Producto', route('products.edit', $product));
});

// Brands
Breadcrumbs::for('brands.index', function ($trail) {
    $trail->push('Marcas', route('brands.index'));
});

// Brands > Crear Marca
Breadcrumbs::for('brands.create', function ($trail) {
    $trail->parent('brands.index');
    $trail->push('Crear Marca', route('brands.create'));
});

// Brands > Ver Marca
Breadcrumbs::for('brands.show', function ($trail, $product) {
    $trail->parent('brands.index');
    $trail->push('Ver Marca', route('brands.show', $product));
});

// Brands > Editar Marca
Breadcrumbs::for('brands.edit', function ($trail, $product) {
    $trail->parent('brands.index');
    $trail->push('Actualizar Marca', route('brands.edit', $product));
});

// Quotings
Breadcrumbs::for('quotings.index', function ($trail) {
    $trail->push('Quotings', route('quotings.index'));
});

// Quotings > Crear Cotización
Breadcrumbs::for('quotings.create', function ($trail) {
    $trail->parent('quotings.index');
    $trail->push('Crear Cotización', route('quotings.create'));
});

// Quotings > Ver Cotización
Breadcrumbs::for('quotings.show', function ($trail, $quoting) {
    $trail->parent('quotings.index');
    $trail->push('Ver Cotización', route('quotings.show', $quoting));
});

// Quotings > Editar Cotización
Breadcrumbs::for('quotings.edit', function ($trail, $quoting) {
    $trail->parent('quotings.index');
    $trail->push('Actualizar Cotización', route('quotings.edit', $quoting));
});