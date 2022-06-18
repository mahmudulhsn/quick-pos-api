<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
    public function rules()
    {
        $rules =  [
            'name' => ['required', 'string'],
            'phone' => ['required', Rule::unique('customers')],
            'email' => ['nullable', 'email', Rule::unique('customers')],
            'address' => ['required', 'string'],
        ];

        if ($this->customer) {
            $rules['email'] = ['email', Rule::unique('customers')->ignore($this->customer)];
            $rules['phone'] = ['required', Rule::unique('customers')->ignore($this->customer)];
        }

        return $rules;
    }
}
