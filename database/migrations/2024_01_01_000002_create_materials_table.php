<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Kaos Polos, Sablon, DTF, Bordir, etc
            $table->string('category'); // kaos_polos, sablon, dtf, bordir, hang_tag, label_leher, label_samping, plastik_packing, stiker, jahit, qc, packing, operasional
            $table->decimal('price', 15, 2)->default(0);
            $table->string('unit')->default('pcs'); // pcs, pack, meter, etc
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
