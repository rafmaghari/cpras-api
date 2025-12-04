<?php

namespace App\Http\Requests;

use App\Http\DTO\Invoice\InvoiceDTO;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
        $rules = [
            'vendor_id' => ['required', 'integer', 'exists:vendors,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:255'],
        ];

        // For update, make fields optional
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['vendor_id'] = ['sometimes', 'integer', 'exists:vendors,id'];
            $rules['amount'] = ['sometimes', 'numeric', 'min:0'];
            $rules['status'] = ['sometimes', 'string', 'max:255'];
        }

        return $rules;
    }

    public function toDTO(): InvoiceDTO
    {
        return new InvoiceDTO(
            vendor_id: $this->vendor_id,
            amount: $this->amount,
            status: $this->status,
        );
    }
}

