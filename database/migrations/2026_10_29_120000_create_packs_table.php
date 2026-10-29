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
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 8, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('pack_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pack_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            $table->unique(['pack_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pack_product');
        Schema::dropIfExists('packs');
    }
};
