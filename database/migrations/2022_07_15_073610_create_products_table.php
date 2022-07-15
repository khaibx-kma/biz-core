<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('product_code', 10)->unique();
            $table->string('ref_code', 10)->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('image')->nullable(true);
            $table->string('decription', 2048)->nullable(true);
            $table->string('status',20)->nullable(true);
            $table->string('created_by', 50)->nullable(true);
            $table->string('modified_by', 50)->nullable(true);
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
};
