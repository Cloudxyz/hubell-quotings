<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('division')->nullable();
            $table->string('brand')->nullable();
            $table->string('material')->unique();
            $table->text('description')->nullable();
            $table->text('description_es')->nullable();
            $table->string('amount')->nullable();
            $table->string('unit')->nullable();
            $table->string('per')->nullable();
            $table->string('uom')->nullable();
            $table->string('min_package')->nullable();
            $table->string('abc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
