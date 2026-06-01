<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreHargaSampahRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'nama_sampah_id' => ['required', 'integer', 'exists:nama_sampah,id', 'unique:harga_sampah,nama_sampah_id'],
            'harga_per_kg'   => ['required', 'numeric', 'min:0'],
        ];
    }
    public function messages(): array
    {
        return ['nama_sampah_id.unique' => 'Harga untuk nama sampah ini sudah ada. Gunakan fitur edit.'];
    }
}
