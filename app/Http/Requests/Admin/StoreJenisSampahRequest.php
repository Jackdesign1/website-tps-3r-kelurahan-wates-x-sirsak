<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreJenisSampahRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'kode'  => ['required', 'string', 'max:10', 'unique:jenis_sampah,kode'],
            'nama'  => ['required', 'string', 'max:100'],
            'warna' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }
}
