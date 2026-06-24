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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_part_id')->constrained('time_parts')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('lap_number');
            $table->string('total_time', length: 11);
            $table->string('lap_time', length: 11)->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->index(['time_part_id', 'lap_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};
