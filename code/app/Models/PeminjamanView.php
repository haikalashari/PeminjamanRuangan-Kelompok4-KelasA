<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanView extends Model
{
    use HasFactory;
    protected $table = 'v_peminjaman';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $with = ['ruangan', 'mahasiswa'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }
}
