<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('client');
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('zone')->nullable();
            $table->string('project')->nullable();
            $table->string('duration')->nullable();
            $table->string('seller')->nullable();
            $table->json('products');
            $table->softDeletes();
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
        Schema::dropIfExists('quotings');
    }
}
