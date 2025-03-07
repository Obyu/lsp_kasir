<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;
    protected $table  = 'pesanan';
    protected $primaryKey = 'idpesanan';
    protected $fillable = [
        'idmenu',
        'kode_pesanan',
        'idpelanggan',
        'jumlah',
        'iduser',
        'meja_id'
    ];

    public function menu()
    {
        return $this->belongsTo(menu::class,'idmenu');
    }
    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class,'idpelanggan');
    }
    public function User()
    {
        return $this->belongsTo(User::class,'iduser');
    }
    public function meja()
    {
        return $this->belongsTo(meja::class,'meja_id');
    }
    public function transaksi()
    {
        return $this->hasMany(transaksi::class,'idpesanan', 'idpesanan');
    }

    public static function Kodepesanan(){
        $Lastorder = self::latest('kode_pesanan')->first();
        
        if (!$Lastorder) {
            return 'K-001';
        }

        $LastNumber = (int) str_replace('K-' , '' , $Lastorder->kode_pesanan);
        $NewNumber  = str_pad($LastNumber + 1, 3, '0', STR_PAD_LEFT);

        return 'K-' . $NewNumber;
    }

    public function total(){
        return $this->pesanan->menu->harga * $this->pesanan->jumlah;
    }
}
