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
//         Schema::create('products', function (Blueprint $table) {
//     $table->id();
//     $table->foreignId('category_id')->constrained()->cascadeOnDelete();
//     $table->string('name');
//     $table->string('slug')->unique();
//     $table->text('description')->nullable();
//     $table->decimal('price', 8, 2);
//     $table->decimal('old_price', 8, 2)->nullable();
//     $table->boolean('is_active')->default(true);
//     $table->boolean('is_featured')->default(false);
//     $table->timestamps();
// });


Schema::create('products', function (Blueprint $table) {
    $table->id();

    $table->foreignId('category_id')->constrained()->cascadeOnDelete();

    $table->string('name');
    $table->string('slug')->unique();
    $table->string('sku')->unique()->nullable();

    $table->text('description')->nullable();

    $table->decimal('price', 8, 2);
    $table->decimal('old_price', 8, 2)->nullable();


    $table->boolean('is_active')->default(true);
    $table->boolean('is_featured')->default(false);

    $table->timestamps();
    $table->softDeletes();
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
