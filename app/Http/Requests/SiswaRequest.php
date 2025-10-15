<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'nama' => 'required|string',
            'no_hp' => 'nullable|numeric',
            'jenis_kelamin' => 'required|string|in:L,P',
            'agama' => 'required|string|in:Islam,Kristen,Katholik,Hindu,Buddha,Khonghucu',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir_submit' => 'nullable|date',
            'alamat_detail' => 'nullable|string',
            'alamat_rt' => 'nullable|string',
            'alamat_rw' => 'nullable|string',
            'alamat_dusun' => 'nullable|string',
            'alamat_kelurahan' => 'nullable|string',
            'alamat_kecamatan' => 'nullable|string',
            'alamat_kode_pos' => 'nullable|string',
        ];

        switch ($this->method()) {
            case 'POST':
                $rules = array_merge($rules, [
                    'nipd' => 'required|numeric|unique:siswa',
                    'nisn' => 'required|numeric|unique:siswa',
                    'nik' => 'required|numeric|unique:siswa',
                ]);
                break;

            case 'PUT':
                $rules = array_merge($rules, [
                    'nipd' => [
                        'nullable',
                        'numeric',
                        Rule::unique('siswa')->ignore($this->id)
                    ],
                    'nisn' => [
                        'nullable',
                        'numeric',
                        Rule::unique('siswa')->ignore($this->id)
                    ],
                    'nik' => [
                        'nullable',
                        'numeric',
                        Rule::unique('siswa')->ignore($this->id)
                    ],
                ]);
                break;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'no_hp.numeric' => 'No HP tidak valid',
            'nipd.numeric' => 'NIPD harus berupa angka',
            'nipd.unique' => 'NIPD telah terdaftar',
            'nisn.numeric' => 'NISN harus berupa angka',
            'nisn.unique' => 'NISN telah terdaftar',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.unique' => 'NIK telah terdaftar',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'jenis_kelamin.string' => 'Jenis kelamin tidak valid',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',
            'agama.required' => 'Agama tidak boleh kosong',
            'agama.string' => 'Agama tidak valid',
            'agama.in' => 'Agama tidak valid',
            'tempat_lahir.string' => 'Tempat lahir tidak valid',
            'tanggal_lahir_submit.date' => 'Tanggal lahir tidak valid',
            'alamat_detail.string' => 'Alamat detail tidak valid',
            'alamat_rt.string' => 'Alamat RT tidak valid',
            'alamat_rw.string' => 'Alamat RW tidak valid',
            'alamat_dusun.string' => 'Alamat dusun tidak valid',
            'alamat_kelurahan.string' => 'Alamat kelurahan tidak valid',
            'alamat_kecamatan.string' => 'Alamat kecamatan tidak valid',
            'alamat_kode_pos.string' => 'Alamat kode pos tidak valid',
            'avatar.image' => 'Foto tidak valid',
            'avatar.mimes' => 'Format foto yang diupload harus sesuai (jpeg, png, jpg)',
            'avatar.max' => 'Maksimal ukuran file yang diupload harus kurang dari 2MB',
        ];
    }
}
