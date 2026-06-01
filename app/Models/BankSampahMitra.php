<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BankSampahMitra extends Model
{
    protected $table = 'bank_sampah_mitra';
    protected $fillable = ['kode','nama','ketua','alamat','telepon','aktif'];
    protected $casts = ['aktif' => 'boolean'];

    public function rekapBankSampah() { return $this->hasMany(RekapBankSampah::class); }
    public function scopeAktif($query) { return $query->where('aktif', true); }
}
