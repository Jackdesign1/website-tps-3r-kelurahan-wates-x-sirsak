<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class JenisSampah extends Model
{
    protected $table = 'jenis_sampah';
    protected $fillable = ['kode','nama','warna','aktif'];
    protected $casts = ['aktif' => 'boolean'];

    public function namaSampah() { return $this->hasMany(NamaSampah::class); }
    public function scopeAktif($query) { return $query->where('aktif', true); }

    public static function getAktifCached()
    {
        return Cache::remember('jenis_sampah_aktif', 3600, fn() => self::aktif()->orderBy('nama')->get());
    }
    public static function clearCache(): void { Cache::forget('jenis_sampah_aktif'); }
}
