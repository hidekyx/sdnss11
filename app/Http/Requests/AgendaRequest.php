<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $users = User::get()->pluck('id')->toArray();

        $rules = [
            'penanggung_jawab_id' => 'required|in:' . implode(',', $users),
            'date_submit' => 'required|date',
            'time_1' => 'required|date_format:H:i',
            'time_2' => 'required|date_format:H:i',
            'title' => 'required|string|max:500',
            'location' => 'required|string|max:255',
            'is_published' => 'nullable',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'penanggung_jawab_id.required' => 'Penanggung jawab wajib dipilih',
            'title.required' => 'Judul tidak boleh kosong',
            'title.max' => 'Judul terlalu panjang',
            'location.required' => 'Lokasi tidak boleh kosong',
            'location.max' => 'Lokasi terlalu panjang',
            'date_submit.required' => 'Tanggal tidak boleh kosong',
            'time_1.required' => 'Waktu mulai tidak boleh kosong',
            'time_2.required' => 'Waktu selesai tidak boleh kosong',
        ];
    }
}
