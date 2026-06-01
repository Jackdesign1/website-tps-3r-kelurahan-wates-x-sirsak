<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreTpsMasukRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'tanggal'    => ['required', 'date', 'date_format:Y-m-d'],
            'total_kg'   => ['required', 'numeric', 'min:0.01', 'max:999999'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ];
    }
    public function messages(): array
    {
        return [
            'tanggal.required'  => 'Tanggal wajib diisi.',
            'total_kg.required' => 'Total kg wajib diisi.',
            'total_kg.min'      => 'Total kg minimal 0.01.',
        ];
    }
}
