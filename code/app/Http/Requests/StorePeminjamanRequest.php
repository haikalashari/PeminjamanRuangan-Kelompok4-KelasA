<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeminjamanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'ruangan_id' => 'required',
                'mahasiswa_nim' => 'required',
                'tanggal' => 'required|date|after_or_equal:today',
                'sesi' => 'required|in:pagi,siang,sore',
                'tujuan' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'ruangan_id.required' => 'Ruangan harus dipilih.',
            'mahasiswa_nim.required' => 'NIM mahasiswa harus diisi.',
            'tanggal.required' => 'Tanggal peminjaman harus diisi.',
            'tanggal.date' => 'Tanggal peminjaman harus berupa tanggal yang valid.',
            'tanggal.after_or_equal' => 'Tanggal peminjaman tidak boleh sebelum hari ini.',
            'sesi.required' => 'Sesi peminjaman harus dipilih.',
            'sesi.in' => 'Sesi peminjaman tidak valid.',
            'tujuan.required' => 'Tujuan peminjaman harus diisi.',
        ];
    }
}
