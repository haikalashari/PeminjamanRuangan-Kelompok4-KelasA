<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER after_peminjaman_insert
            AFTER INSERT ON peminjaman
            FOR EACH ROW
            BEGIN
                INSERT INTO peminjaman_log (ruangan_id, mahasiswa_nim, created_at, updated_at)
                VALUES (NEW.ruangan_id, NEW.mahasiswa_nim, NEW.created_at, NEW.updated_at);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_peminjaman_insert');
    }
};
