<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
