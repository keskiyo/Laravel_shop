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
            $table->integer('category_id');
            $table->string('code', 100);
            $table->string('name', 100);
            $table->string('manufacturer', 150);
            $table->string('article')->unique();
            $table->double('price')->default(0);
            $table->string('img')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('article');
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
