<?php

namespace App\Http\Requests;

use App\Enums\PublikasiKategori;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BeritaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {

        $kategori = array_keys(PublikasiKategori::listKategori());
        $users = User::get()->pluck('id')->toArray();

        $rules = [
            'kategori' => 'required|in:' . implode(',', $kategori),
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
            'caption' => 'nullable|string|max:255',
            'published_at_submit' => 'nullable|date',
            'is_published' => 'nullable',
            'quote' => 'nullable|string',
            'quote_by' => 'nullable|in:' . implode(',', $users),
            'img' => $this->isMethod('PUT') ? 'nullable|image|mimes:jpeg,png,jpg|max:10000' : 'required|image|mimes:jpeg,png,jpg|max:10000',
            'img_2' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'img_3' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'img_4' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'img_5' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'img_6' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'img_7' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'kategori.required' => 'Kategori wajib dipilih',
            'quote_by.in' => 'User kutipan tidak ditemukkan',
            'title.required' => 'Judul tidak boleh kosong',
            'title.max' => 'Judul terlalu panjang',
            'content.required' => 'Konten tidak boleh kosong',
            'img.required' => 'Foto berita utama harus diupload',
            'img.image' => 'Format foto yang diupload harus sesuai (jpeg, png, jpg)',
            'img.mimes' => 'Format foto yang diupload harus sesuai (jpeg, png, jpg)',
            'img.max' => 'Maksimal ukuran file yang diupload harus kurang dari 10MB',
            'img_2.image' => 'Format foto kedua yang diupload harus sesuai (jpeg, png, jpg)',
            'img_2.mimes' => 'Format foto kedua yang diupload harus sesuai (jpeg, png, jpg)',
            'img_2.max' => 'Maksimal ukuran foto kedua yang diupload harus kurang dari 10MB',
            'img_3.image' => 'Format foto ketiga yang diupload harus sesuai (jpeg, png, jpg)',
            'img_3.mimes' => 'Format foto ketiga yang diupload harus sesuai (jpeg, png, jpg)',
            'img_3.max' => 'Maksimal ukuran foto ketiga yang diupload harus kurang dari 10MB',
            'img_4.image' => 'Format foto keempat yang diupload harus sesuai (jpeg, png, jpg)',
            'img_4.mimes' => 'Format foto keempat yang diupload harus sesuai (jpeg, png, jpg)',
            'img_4.max' => 'Maksimal ukuran foto keempat yang diupload harus kurang dari 10MB',
            'img_5.image' => 'Format foto keempat yang diupload harus sesuai (jpeg, png, jpg)',
            'img_5.mimes' => 'Format foto keempat yang diupload harus sesuai (jpeg, png, jpg)',
            'img_5.max' => 'Maksimal ukuran foto keempat yang diupload harus kurang dari 10MB',
            'img_6.image' => 'Format foto keempat yang diupload harus sesuai (jpeg, png, jpg)',
            'img_6.mimes' => 'Format foto keempat yang diupload harus sesuai (jpeg, png, jpg)',
            'img_6.max' => 'Maksimal ukuran foto keempat yang diupload harus kurang dari 10MB',
            'img_7.image' => 'Format foto keempat yang diupload harus sesuai (jpeg, png, jpg)',
            'img_7.mimes' => 'Format foto keempat yang diupload harus sesuai (jpeg, png, jpg)',
            'img_7.max' => 'Maksimal ukuran foto keempat yang diupload harus kurang dari 10MB',
            'published_at_submit.date' => 'Format tanggal publikasi tidak valid',
        ];
    }
}
