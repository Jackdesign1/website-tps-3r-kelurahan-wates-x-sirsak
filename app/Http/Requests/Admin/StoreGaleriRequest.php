<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreGaleriRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'judul'     => ['required', 'string', 'max:200'],
            'deskripsi' => ['nullable', 'string', 'max:500'],
            'tanggal'   => ['required', 'date'],
            'urutan'    => ['nullable', 'integer', 'min:0'],
            'url_foto'  => ['nullable', 'url', 'required_without:foto'],
            'foto'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048', 'required_without:url_foto'],
        ];
    }
    public function messages(): array
    {
        return [
            'foto.required_without'    => 'Upload foto atau isi URL foto.',
            'url_foto.required_without' => 'Isi URL foto atau upload file foto.',
            'foto.max'                 => 'Ukuran foto maksimal 2MB.',
            'foto.mimes'               => 'Format foto harus jpg, jpeg, png, atau webp.',
        ];
    }
}
