<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusRuangan extends Model
{
    use HasFactory;
    protected $table = 'status_ruangan';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
