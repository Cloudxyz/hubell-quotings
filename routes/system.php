<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\QuotingsController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'system', 'middleware' => 'auth'], function () {

    Route::group(['middleware' => ['role:Super Admin|Admin']], function () {
        //users
        Route::get('users', [UsersController::class, 'index'])->name('users.index');
        Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('users/show/{id}', [UsersController::class, 'show'])->name('users.show');
        Route::get('users/destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
        
        //discount
        Route::post('discounts/store/{id}', [DiscountsController::class, 'store'])->name('discounts.store');
        Route::get('discounts/destroy/{id}', [DiscountsController::class, 'destroy'])->name('discounts.destroy');
        
        //products
        Route::get('products/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('products/store', [ProductsController::class, 'store'])->name('products.store');
        Route::get('products/show/{id}', [ProductsController::class, 'show'])->name('products.show');
        Route::get('products/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
        Route::post('products/update/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::get('products/destroy/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
        Route::get('products/import', [ProductsController::class, 'import'])->name('products.import');
        
        //brands
        Route::get('brands', [BrandsController::class, 'index'])->name('brands.index');
        Route::get('brands/create', [BrandsController::class, 'create'])->name('brands.create');
        Route::post('brands/store', [BrandsController::class, 'store'])->name('brands.store');
        Route::get('brands/show/{id}', [BrandsController::class, 'show'])->name('brands.show');
        Route::get('brands/edit/{id}', [BrandsController::class, 'edit'])->name('brands.edit');
        Route::post('brands/update/{id}', [BrandsController::class, 'update'])->name('brands.update');
        Route::get('brands/destroy/{id}', [BrandsController::class, 'destroy'])->name('brands.destroy');
        Route::get('brands/import', [BrandsController::class, 'import'])->name('brands.import');

        //reports
        Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
    });
    
    //products
    Route::get('products', [ProductsController::class, 'index'])->name('products.index');

    //users
    Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('users/update/{id}', [UsersController::class, 'update'])->name('users.update');
    
    //quoting
    Route::get('quotings', [QuotingsController::class, 'index'])->name('quotings.index');
    Route::get('quotings/create', [QuotingsController::class, 'create'])->name('quotings.create');
    Route::post('quotings/products/add', [QuotingsController::class, 'add'])->name('quotings.products.add');
    Route::post('quotings/products/update', [QuotingsController::class, 'updateProduct'])->name('quotings.update.product');
    Route::get('quotings/products/remove/{id}', [QuotingsController::class, 'remove'])->name('quotings.products.remove');
    Route::get('quotings/store', [QuotingsController::class, 'store'])->name('quotings.store');
    Route::get('quotings/show/{id}', [QuotingsController::class, 'show'])->name('quotings.show');
    Route::get('quotings/edit/{id}', [QuotingsController::class, 'edit'])->name('quotings.edit');
    Route::post('quotings/update/{id}', [QuotingsController::class, 'update'])->name('quotings.update');
    Route::get('quotings/destroy/{id}', [QuotingsController::class, 'destroy'])->name('quotings.destroy');
    Route::get('quotings/historial/{id}', [QuotingsController::class, 'historial'])->name('quotings.historial');
    Route::get('quotings/export/{id}', [QuotingsController::class, 'export'])->name('quotings.export');

});
