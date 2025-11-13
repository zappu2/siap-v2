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
        Schema::table('kategori_pelatihans', function (Blueprint $table) {
            $table->string('id_number')->nullable()->after('nama');
            $table->string('kode_satker')->nullable()->after('id_number');
            $table->string('kota')->nullable()->after('kode_satker');
            $table->string('description_format')->default('1')->after('deskripsi');
            $table->integer('parent')->default(0)->after('description_format');
            $table->integer('sort_order')->default(780000)->after('parent');
            $table->integer('course_count')->default(0)->after('sort_order');
            $table->string('path')->default('/1')->after('course_count');
            $table->string('theme')->nullable()->after('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_pelatihans', function (Blueprint $table) {
            $table->dropColumn([
                'id_number', 'kode_satker', 'kota', 'description_format', 
                'parent', 'sort_order', 'course_count', 'path', 'theme'
            ]);
        });
    }
};
