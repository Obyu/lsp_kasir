<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $primaryKey = 'idmenu';
    protected $fillable = [
        'Namamenu',
        'Harga',
    ];

    public function pesanan(){
        return $this->hasMany(pesanan::class, 'idmenu');
    }
}
