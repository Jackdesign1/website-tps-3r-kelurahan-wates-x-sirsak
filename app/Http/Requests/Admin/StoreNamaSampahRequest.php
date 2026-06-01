<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreNamaSampahRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'jenis_sampah_id' => ['required', 'integer', 'exists:jenis_sampah,id'],
            'nama'            => ['required', 'string', 'max:100'],
        ];
    }
}
