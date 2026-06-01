<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBankSampahMitraRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'kode'    => ['required', 'string', 'max:20', 'unique:bank_sampah_mitra,kode,' . $this->route('bankSampahMitra')],
            'nama'    => ['required', 'string', 'max:150'],
            'ketua'   => ['nullable', 'string', 'max:100'],
            'alamat'  => ['nullable', 'string', 'max:500'],
            'telepon' => ['nullable', 'string', 'max:20'],
        ];
    }
}
