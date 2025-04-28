<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('playstations', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_ps'); // contoh: PS4, PS5
            $table->integer('harga_per_jam'); // harga sewa per jam
            $table->text('deskripsi')->nullable(); // opsional
            $table->enum('status', ['tersedia', 'dipakai', 'rusak'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('playstations');
    }
};
