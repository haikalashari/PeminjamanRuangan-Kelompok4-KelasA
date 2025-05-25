<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $with = ['status'];

    public function status()
    {
        return $this->hasMany(StatusRuangan::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

}
