<?php

// Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->push(__('Users'), route('users.index'));
});

// Users > Crear Usuario
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push(__('Create User'), route('users.create'));
});

// Users > Ver Usuario
Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push(__('View User'), route('users.show', $user));
});

// Users > Actualizar Usuario
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push(__('Update User'), route('users.edit', $user));
});

// Products
Breadcrumbs::for('products.index', function ($trail) {
    $trail->push(__('Products'), route('products.index'));
});

// Products > Crear Producto
Breadcrumbs::for('products.create', function ($trail) {
    $trail->parent('products.index');
    $trail->push(__('Create Product'), route('products.create'));
});

// Products > Ver Producto
Breadcrumbs::for('products.show', function ($trail, $product) {
    $trail->parent('products.index');
    $trail->push(__('View Product'), route('products.show', $product));
});

// Products > Actualizar Producto
Breadcrumbs::for('products.edit', function ($trail, $product) {
    $trail->parent('products.index');
    $trail->push(__('Update Product'), route('products.edit', $product));
});

// Brands
Breadcrumbs::for('brands.index', function ($trail) {
    $trail->push(__('Brands'), route('brands.index'));
});

// Brands > Crear Marca
Breadcrumbs::for('brands.create', function ($trail) {
    $trail->parent('brands.index');
    $trail->push(__('Create Brand'), route('brands.create'));
});

// Brands > Ver Marca
Breadcrumbs::for('brands.show', function ($trail, $product) {
    $trail->parent('brands.index');
    $trail->push(__('View Brand'), route('brands.show', $product));
});

// Brands > Actualizar Marca
Breadcrumbs::for('brands.edit', function ($trail, $product) {
    $trail->parent('brands.index');
    $trail->push(__('Update Brand'), route('brands.edit', $product));
});

// Quotings
Breadcrumbs::for('quotings.index', function ($trail) {
    $trail->push(__('Quotings'), route('quotings.index'));
});

// Quotings > Crear Cotización
Breadcrumbs::for('quotings.create', function ($trail) {
    $trail->parent('quotings.index');
    $trail->push(__('Create Quoting'), route('quotings.create'));
});

// Quotings > Ver Cotización
Breadcrumbs::for('quotings.show', function ($trail, $quoting) {
    $trail->parent('quotings.index');
    $trail->push(__('View Quoting'), route('quotings.show', $quoting));
});

// Quotings > Actualizar Cotización
Breadcrumbs::for('quotings.edit', function ($trail, $quoting) {
    $trail->parent('quotings.index');
    $trail->push(__('Update Quoting'), route('quotings.edit', $quoting));
});

// Reports
Breadcrumbs::for('reports.index', function ($trail) {
    $trail->push(__('Reports'), route('reports.index'));
});