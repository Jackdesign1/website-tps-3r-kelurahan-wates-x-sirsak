<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HasilPilah extends Model
{
    protected $table = 'hasil_pilah';
    protected $fillable = ['tanggal','nama_sampah_id','berat_kg','harga_per_kg','total_harga','user_id'];
    protected $casts = ['tanggal'=>'date','berat_kg'=>'decimal:2','harga_per_kg'=>'decimal:2','total_harga'=>'decimal:2'];

    public function namaSampah() { return $this->belongsTo(NamaSampah::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function getTotalHargaFormattedAttribute(): string { return 'Rp '.number_format($this->total_harga,0,',','.'); }
    public function scopeBulan($query, $bulan, $tahun) {
        return $query->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan);
    }
}
