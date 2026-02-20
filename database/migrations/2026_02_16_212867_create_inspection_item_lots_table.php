<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inspection_item_lots', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('inspection_item_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('lot_id')->constrained()->onDelete('restrict');
            $table->unsignedInteger('qty_required');
            $table->unsignedInteger('available_qty_snapshot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_item_lots');
    }
};
