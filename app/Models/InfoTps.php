<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InfoTps extends Model
{
    protected $table = 'info_tps';
    protected $fillable = ['nama','kelurahan','kota','alamat','telepon','email','jam_operasional','kepala_tps','deskripsi','berdiri_sejak'];

    public static function getInstance(): self
    {
        return self::firstOrCreate([], [
            'nama' => 'TPS Kelurahan Wates',
            'kelurahan' => 'Wates',
            'kota' => 'Mojokerto',
            'alamat' => 'Jl. Raya Wates No. 1, Kelurahan Wates',
        ]);
    }
}
