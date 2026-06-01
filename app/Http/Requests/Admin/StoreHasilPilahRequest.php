<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreHasilPilahRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'tanggal'                 => ['required', 'date', 'date_format:Y-m-d'],
            'items'                   => ['required', 'array', 'min:1'],
            'items.*.nama_sampah_id'  => ['required', 'integer', 'exists:nama_sampah,id'],
            'items.*.berat_kg'        => ['required', 'numeric', 'min:0.01', 'max:99999'],
        ];
    }
    public function messages(): array
    {
        return [
            'items.required'                  => 'Minimal harus ada 1 item hasil pilah.',
            'items.*.nama_sampah_id.required' => 'Nama sampah wajib dipilih.',
            'items.*.nama_sampah_id.exists'   => 'Nama sampah tidak valid.',
            'items.*.berat_kg.required'       => 'Berat wajib diisi.',
            'items.*.berat_kg.min'            => 'Berat minimal 0.01 kg.',
        ];
    }
}
