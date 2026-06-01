<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = ['judul','deskripsi','url_foto','tanggal','urutan'];
    protected $casts = ['tanggal' => 'date'];

    public function getFotoUrlAttribute(): string
    {
        if (str_starts_with($this->url_foto, 'http')) return $this->url_foto;
        return Storage::url($this->url_foto);
    }
}
