<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meja extends Model
{
    use HasFactory;
    protected $table  = 'meja';
    protected $fillable = [
        'NoMeja',
        'status'
    ];

    public function pesanan(){
        return $this->hasMany(pesanan::class,'meja_id');
    }
}
