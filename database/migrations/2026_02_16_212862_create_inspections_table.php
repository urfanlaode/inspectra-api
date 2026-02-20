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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->string('inspection_no')->unique();
            $table
                ->foreignId('service_type_id')
                ->constrained()
                ->onDelete('restrict');
            $table
                ->foreignId('scope_of_work_id')
                ->constrained()
                ->onDelete('restrict');
            $table
                ->foreignId('location_id')
                ->constrained()
                ->onDelete('restrict');
            $table
                ->foreignId('customer_id')
                ->constrained()
                ->onDelete('restrict');
            $table->boolean('is_customer_charged')->default(true);
            $table->string('dc_code')->nullable();
            $table->date('estimated_completion_date')->nullable();
            $table
                ->enum('status', [
                    'draft',
                    'new',
                    'ready_for_review',
                    'completed',
                ])
                ->default('new');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
