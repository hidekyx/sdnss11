<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $role = Role::get()->pluck('id')->toArray();
        $rules = [
            'role_id' => 'required|in:' . implode(',', $role),
            'name' => 'required|string',
            'no_hp' => 'nullable|numeric',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ];

        switch ($this->method()) {
            case 'POST':
                $rules = array_merge($rules, [
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string|min:8',
                    'nip' => 'nullable|numeric|unique:users',
                    'nrk' => 'nullable|numeric|unique:users',
                ]);
                break;

            case 'PUT':
                $rules = array_merge($rules, [
                    'email' => [
                        'required',
                        'email',
                        Rule::unique('users')->ignore($this->id)
                    ],
                    'nip' => [
                        'nullable',
                        'numeric',
                        Rule::unique('users')->ignore($this->id)
                    ],
                    'nrk' => [
                        'nullable',
                        'numeric',
                        Rule::unique('users')->ignore($this->id)
                    ],
                ]);
                break;

            case 'PATCH':
                $rules = [
                    'password' => 'required|string|min:8|confirmed',
                    'password_confirmation' => 'required|string|min:8',
                ];
                break;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'role_id.required' => 'Role wajib dipilih',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal harus 8 karakter',
            'no_hp.required' => 'No HP tidak boleh kosong',
            'no_hp.numeric' => 'No HP tidak valid',
            'nip.numeric' => 'NIP harus berupa angka',
            'nip.unique' => 'NIP telah terdaftar',
            'nrk.numeric' => 'NRK harus berupa angka',
            'nrk.unique' => 'NRK telah terdaftar',
            'tempat_lahir.string' => 'Tempat lahir tidak valid',
            'tanggal_lahir.date' => 'Tanggal lahir tidak valid',
            'alamat.string' => 'Alamat tidak valid',
            'avatar.image' => 'Foto tidak valid',
            'avatar.mimes' => 'Format foto yang diupload harus sesuai (jpeg, png, jpg)',
            'avatar.max' => 'Maksimal ukuran file yang diupload harus kurang dari 2MB',
            'password.different' => 'Password tidak boleh sama dengan sebelumnya',
            'password.confirmed' => 'Password konfirmasi tidak sesuai',
            'password_confirmation.required' => 'Password konfirmasi tidak boleh kosong',
            'password_confirmation.confirmed' => 'Password konfirmasi tidak sesuai',
        ];
    }
}
