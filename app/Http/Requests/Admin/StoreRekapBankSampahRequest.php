<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreRekapBankSampahRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'tanggal'               => ['required', 'date', 'date_format:Y-m-d'],
            'bank_sampah_mitra_id'  => ['required', 'integer', 'exists:bank_sampah_mitra,id'],
            'nama_sampah_id'        => ['required', 'integer', 'exists:nama_sampah,id'],
            'berat_kg'              => ['required', 'numeric', 'min:0.01', 'max:99999'],
        ];
    }
}
