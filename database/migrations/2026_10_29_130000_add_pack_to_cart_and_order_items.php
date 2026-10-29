<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Une ligne du panier / commande peut être un produit OU un pack.
     * Pour un pack, pack_items contient les produits + couleurs choisis :
     * [{product_id, product_color_id, quantity, product_name, color_name, image}]
     */
    public function up(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->change();
            $table->unsignedBigInteger('product_color_id')->nullable()->change();
            $table->foreignId('pack_id')->nullable()->after('product_color_id')->constrained()->cascadeOnDelete();
            $table->json('pack_items')->nullable()->after('pack_id');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->change();
            $table->unsignedBigInteger('product_color_id')->nullable()->change();
            $table->foreignId('pack_id')->nullable()->after('product_color_id')->constrained()->nullOnDelete();
            $table->json('pack_items')->nullable()->after('pack_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pack_id');
            $table->dropColumn('pack_items');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pack_id');
            $table->dropColumn('pack_items');
        });
    }
};
