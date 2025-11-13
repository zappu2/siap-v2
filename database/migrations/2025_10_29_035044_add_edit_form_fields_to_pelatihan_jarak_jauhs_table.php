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
        Schema::table('pelatihan_jarak_jauhs', function (Blueprint $table) {
            // Basic Information fields
            $table->string('nama')->nullable();
            $table->text('display_name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('course_category')->nullable();
            $table->integer('kategori_order')->default(1);
            $table->string('id_number')->nullable();
            
            // Content fields
            $table->text('summary')->nullable();
            $table->integer('summary_format')->default(1);
            $table->integer('news_items')->default(3);
            
            // Schedule fields
            $table->date('tanggal_akhir')->nullable();
            
            // Advanced settings
            $table->integer('group_mode')->default(0);
            $table->boolean('visible')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihan_jarak_jauhs', function (Blueprint $table) {
            $table->dropColumn([
                'nama',
                'display_name', 
                'short_name',
                'course_category',
                'kategori_order',
                'id_number',
                'summary',
                'summary_format',
                'news_items',
                'tanggal_akhir',
                'group_mode',
                'visible',
            ]);
        });
    }
};
