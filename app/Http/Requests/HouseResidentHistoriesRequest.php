<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseResidentHistoriesRequest extends FormRequest
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
            'id_house' => ['required'],
            'id_resident' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
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
            'id_house' => 'Rumah',
            'id_resident' => 'Warga',
        ];
    }
}
