<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NamaSampah extends Model
{
    protected $table = 'nama_sampah';
    protected $fillable = ['jenis_sampah_id','nama','aktif'];
    protected $casts = ['aktif' => 'boolean'];

    public function jenisSampah() { return $this->belongsTo(JenisSampah::class); }
    public function hargaSampah() { return $this->hasOne(HargaSampah::class); }
    public function hasilPilah() { return $this->hasMany(HasilPilah::class); }
    public function rekapBankSampah() { return $this->hasMany(RekapBankSampah::class); }
    public function scopeAktif($query) { return $query->where('aktif', true); }
}
