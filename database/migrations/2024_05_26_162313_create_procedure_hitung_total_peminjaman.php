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
        DB::statement('DROP PROCEDURE IF EXISTS hitungTotalPeminjamanBerdasarkanTanggal');

        // DB::statement('
        //     CREATE PROCEDURE hitungTotalPeminjamanBulanIni()
        //     BEGIN
        //         DECLARE total INT;
                
        //         SELECT COUNT(*) INTO total FROM peminjaman 
        //         WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE());
                
        //         SELECT CONCAT("Total peminjaman bulan ini: ", total) AS hasil;
        //     END
        // ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP PROCEDURE IF EXISTS hitungTotalPeminjamanBerdasarkanTanggal');
    }
};
