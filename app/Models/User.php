<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['password' => 'hashed'];

    public function tpsMasuk() { return $this->hasMany(TpsMasuk::class); }
    public function hasilPilah() { return $this->hasMany(HasilPilah::class); }
    public function rekapBankSampah() { return $this->hasMany(RekapBankSampah::class); }
}
