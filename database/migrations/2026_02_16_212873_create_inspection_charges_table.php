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
        Schema::create('inspection_charges', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('inspection_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('order_no');
            $table->foreignId('uom_id')->constrained()->onDelete('restrict');
            $table->decimal('qty', 15, 2);
            $table->decimal('price', 15, 2);
            $table->decimal('amount', 15, 2)->storedAs('qty * price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_charges');
    }
};
