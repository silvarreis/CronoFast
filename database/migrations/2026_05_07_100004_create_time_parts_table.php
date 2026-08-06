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
        Schema::create('time_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internal_reference_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('employee_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('operation_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('machine_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('center_work',length: 14);
            $table->decimal('margin_value', 5, 2);
            $table->integer('production_pace');
            $table->integer('num_repetition');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_parts');
    }
};
