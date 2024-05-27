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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruangan_id')->constrained('ruangan')->onDelete('cascade');
            $table->string('mahasiswa_nim');
            $table->foreign('mahasiswa_nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->text('tujuan');
            $table->timestamps();
            $table->unique('created_at', 'index_created_at');
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropUnique('index_created_at'); // Nama indeks unik yang ada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->unique('created_at', 'index_created_at');
        });

        Schema::dropIfExists('peminjaman');
    }
};
