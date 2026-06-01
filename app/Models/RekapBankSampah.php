<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RekapBankSampah extends Model
{
    protected $table = 'rekap_bank_sampah';
    protected $fillable = ['tanggal','bank_sampah_mitra_id','nama_sampah_id','berat_kg','harga_per_kg','total_harga','user_id'];
    protected $casts = ['tanggal'=>'date','berat_kg'=>'decimal:2','harga_per_kg'=>'decimal:2','total_harga'=>'decimal:2'];

    public function bankSampahMitra() { return $this->belongsTo(BankSampahMitra::class); }
    public function namaSampah() { return $this->belongsTo(NamaSampah::class); }
    public function user() { return $this->belongsTo(User::class); }
}
