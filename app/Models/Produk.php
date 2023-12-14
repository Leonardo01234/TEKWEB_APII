<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 
class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'produk_id';
    protected $fillable = [
        'kategori_id', 'nama_produk', 'harga_produk', 'gambar_produk', 'deskripsi_produk'
    ];
    static function getproduk()
    {
        $return = DB::table('produk')
        ->join('kategori','produk.kategori_id','=','kategori.kategori_id');
        return $return; 
    }   
}
