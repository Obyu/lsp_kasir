<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $primaryKey = 'idpelanggan';
    protected $fillable =[
        'Namapelanggan',
        'Jeniskelamin',
        'Nohp',
        'alamat'
    ];

    public function pesanan(){
        return $this->hasMany(pesanan::class,'idpelanggan');
    }
}
