<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'idtransaksi';
    protected $fillable = [
    	'idpesanan',	
        'total',	
        'bayar',	
        'kembalian',	
        'Kurang'
    ];

    public function pesanan(){
        return $this->belongsTo(pesanan::class,'idpesanan');
    }
}
