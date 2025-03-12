<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('img', 255);
            $table->integer('price');
            $table->integer('sale_price')->nullable();
            $table->integer('instock'); // số lượng tồn kho
            $table->float('rating')->default(0);
            $table->unsignedBigInteger('category_id'); // Mã danh mục
            $table->timestamps();
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onUpdate('restrict')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
