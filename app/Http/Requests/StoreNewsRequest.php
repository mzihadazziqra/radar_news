<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|min:5',
            'category_id' => 'required|integer|exists:categories,id',
            'content' => 'required|string|min:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }

    public function messages() : array
    {
        return [
            'title.required' => 'Judul berita tidak boleh kosong.',
            'title.max' => 'Judul berita maksimal 255 karakter.',
            'title.min' => 'Judul berita minimal 5 karakter.',
            'category_id.required' => 'Kategori harus dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'content.required' => 'Konten berita tidak boleh kosong.',
            'content.min' => 'Konten berita minimal 20 karakter.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diizinkan adalah jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
