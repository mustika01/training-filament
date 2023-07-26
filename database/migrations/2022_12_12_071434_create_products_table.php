<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('brand_id')->constrained();
            // $table->foreignId('category_id')->constrained();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->decimal('price');
            $table->decimal('old_price');
            $table->decimal('cost');
            $table->integer('sku');
            $table->integer('barcode');
            $table->integer('quantity');
            $table->integer('security');
            // $table->enum()
            $table->boolean('is_visible');
            $table->dateTime('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
