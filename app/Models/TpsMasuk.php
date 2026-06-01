<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TpsMasuk extends Model
{
    protected $table = 'tps_masuk';
    protected $fillable = ['tanggal','total_kg','keterangan','user_id'];
    protected $casts = ['tanggal' => 'date','total_kg' => 'decimal:2'];

    public function user() { return $this->belongsTo(User::class); }
    public function scopeBulan($query, $bulan, $tahun) {
        return $query->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan);
    }
}
