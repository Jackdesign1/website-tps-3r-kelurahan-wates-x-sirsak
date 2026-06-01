<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HargaSampah extends Model
{
    protected $table = 'harga_sampah';
    protected $fillable = ['nama_sampah_id','harga_per_kg','aktif'];
    protected $casts = ['harga_per_kg' => 'decimal:2','aktif' => 'boolean'];

    public function namaSampah() { return $this->belongsTo(NamaSampah::class); }
    public function scopeAktif($query) { return $query->where('aktif', true); }
    public function getHargaFormattedAttribute(): string { return 'Rp '.number_format($this->harga_per_kg,0,',','.'); }
}
