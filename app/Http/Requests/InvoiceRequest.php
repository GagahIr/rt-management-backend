<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
        return [
            'house_id' => ['required', 'exists:houses,id'],
            'resident_id' => ['required', 'exists:residents,id'],
            'payment_type_id' => ['required', 'exists:payment_types,id'],
            'amount' => ['required', 'numeric'],
            'period_month' => ['required', 'numeric', 'min:1', 'max:12'],
            'period_year' => ['required', 'numeric'],
            'status' => ['nullable', 'in:Belum lunas,Lunas'],
            'duration_months' => ['nullable', 'numeric', 'min:1']
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute Harus Diisi',
        ];
    }

    public function attributes(): array
    {
        return [
            'house_id' => 'Rumah',
            'resident_id' => 'Penghuni',
            'payment_type_id' => 'Jenis Pembayaran',
            'amount' => 'Jumlah Tagihan',
            'period_month' => 'Bulan Periode',
            'period_year' => 'Tahun Periode',
            'status' => 'Status Pembayaran',
            'duration_months' => 'Durasi (Bulan)',
        ];
    }
}
