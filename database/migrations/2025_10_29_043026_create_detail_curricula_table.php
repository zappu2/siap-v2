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
        Schema::create('detail_curricula', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kurikulum_pelatihan_id')->constrained()->onDelete('cascade');
            $table->string('kelompok_pelatihan');
            $table->text('detail_mata_pelatihan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_curricula');
    }
};
