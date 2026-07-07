<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentTypesRequest extends FormRequest
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
            'name' => ['required', Rule::unique('payment_types', 'name')->ignore($id)],
            'amount' => ['required'],
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
            'name' => 'Tupe Iuran',
        ];
    }
}
