<?php

namespace App\Http\Requests;

use App\Enums\PublikasiKategori;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class InfografisRequest extends FormRequest
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
            'penanggung_jawab_id' => 'required|in:' . implode(',', $users),
            'title' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string|max:255',
            'published_at_submit' => 'nullable|date',
            'is_published' => 'nullable',
            'img' => $this->isMethod('PUT') ? 'nullable|image|mimes:jpeg,png,jpg|max:10000' : 'required|image|mimes:jpeg,png,jpg|max:10000',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'kategori.required' => 'Kategori wajib dipilih',
            'penanggung_jawab_id.required' => 'Penanggung jawab wajib dipilih',
            'title.required' => 'Judul tidak boleh kosong',
            'title.max' => 'Judul terlalu panjang',
            'deskripsi_singkat.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi_singkat.max' => 'Deskripsi terlalu panjang',
            'img.required' => 'Foto berita utama harus diupload',
            'img.image' => 'Format foto yang diupload harus sesuai (jpeg, png, jpg)',
            'img.mimes' => 'Format foto yang diupload harus sesuai (jpeg, png, jpg)',
            'img.max' => 'Maksimal ukuran file yang diupload harus kurang dari 10MB',
            'published_at_submit.date' => 'Format tanggal publikasi tidak valid',
        ];
    }
}
