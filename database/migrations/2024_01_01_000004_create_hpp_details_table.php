<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hpp_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            // Material costs per pcs
            $table->decimal('kaos_price', 15, 2)->default(0); // Kaos Polos
            $table->decimal('sablon_price', 15, 2)->default(0);
            $table->decimal('dtf_price', 15, 2)->default(0);
            $table->decimal('bordir_price', 15, 2)->default(0);
            $table->decimal('hang_tag_price', 15, 2)->default(0);
            $table->decimal('label_leher_price', 15, 2)->default(0);
            $table->decimal('label_samping_price', 15, 2)->default(0);
            $table->decimal('plastik_price', 15, 2)->default(0);
            $table->decimal('stiker_price', 15, 2)->default(0);
            
            // Labour costs per pcs
            $table->decimal('jahit_price', 15, 2)->default(0);
            $table->decimal('qc_price', 15, 2)->default(0);
            $table->decimal('packing_price', 15, 2)->default(0);
            
            // Operational cost per pcs
            $table->decimal('operasional_price', 15, 2)->default(0);
            
            // Total HPP calculation
            $table->decimal('hpp_per_pcs', 15, 2)->default(0);
            $table->decimal('total_hpp', 15, 2)->default(0); // hpp_per_pcs * quantity
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hpp_details');
    }
};
