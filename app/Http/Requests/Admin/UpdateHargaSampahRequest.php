<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHargaSampahRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'nama_sampah_id' => ['required', 'integer', 'exists:nama_sampah,id', 'unique:harga_sampah,nama_sampah_id,' . $this->route('hargaSampah')],
            'harga_per_kg'   => ['required', 'numeric', 'min:0'],
        ];
    }
}
