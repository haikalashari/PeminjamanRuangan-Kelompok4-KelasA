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
        DB::unprepared('DROP FUNCTION IF EXISTS avg_peminjaman_bulan_ini_function');

        DB::unprepared('
            CREATE FUNCTION avg_peminjaman_bulan_ini_function()
            RETURNS DECIMAL(10, 2)
            DETERMINISTIC
            BEGIN
                DECLARE jumlah_peminjaman INT;
                DECLARE jumlah_hari INT;
                DECLARE rata_rata DECIMAL(10, 2);
                
                SELECT COUNT(*) INTO jumlah_peminjaman
                FROM peminjaman
                WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
                AND YEAR(created_at) = YEAR(CURRENT_DATE());

                SELECT DAY(LAST_DAY(CURRENT_DATE())) INTO jumlah_hari;
                
                SET rata_rata = jumlah_peminjaman / jumlah_hari;
                
                RETURN rata_rata;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS avg_peminjaman_bulan_ini_function');
    }
};
