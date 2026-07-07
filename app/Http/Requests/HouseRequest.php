<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HouseRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'house_code' => ['required', Rule::unique('houses', 'house_code')->ignore($id)],
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
            'house_code' => 'Kode Rumah',
        ];
    }
}
