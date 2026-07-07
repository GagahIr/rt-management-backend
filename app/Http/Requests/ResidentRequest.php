<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        $id = $this->route('id');

        return [
            'full_name' => ['required', 'string'],
            'phone_number' => ['required', Rule::unique('residents', 'phone_number')->ignore($id)],
            'status' => ['required'],

            'id_photo' => [
                $isUpdate ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'house_status' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute Harus Diisi',
            'unique' => ':attribute Sudah Pernah Digunakan',
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => 'Nama Lengkap',
            'phone_number' => 'Nomor Telepon',
        ];
    }
}
