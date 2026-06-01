<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoTpsRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'nama'            => ['required', 'string', 'max:150'],
            'kelurahan'       => ['required', 'string', 'max:100'],
            'kota'            => ['required', 'string', 'max:100'],
            'alamat'          => ['required', 'string', 'max:500'],
            'telepon'         => ['nullable', 'string', 'max:20'],
            'email'           => ['nullable', 'email', 'max:100'],
            'jam_operasional' => ['nullable', 'string', 'max:100'],
            'kepala_tps'      => ['nullable', 'string', 'max:100'],
            'deskripsi'       => ['nullable', 'string', 'max:2000'],
            'berdiri_sejak'   => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
        ];
    }
}
