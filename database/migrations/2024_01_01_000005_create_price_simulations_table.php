<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_simulations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->decimal('margin_percent', 8, 2); // Margin keuntungan dalam persen
            $table->decimal('hpp_per_pcs', 15, 2);
            $table->decimal('price_per_pcs', 15, 2); // Harga jual per pcs
            $table->decimal('profit_per_pcs', 15, 2); // Keuntungan per pcs
            $table->decimal('total_profit', 15, 2); // Total keuntungan
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_simulations');
    }
};
