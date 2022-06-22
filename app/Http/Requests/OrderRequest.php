<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        return [
            "order_id" => ["required", "string"],
            "billing_address" => ["required"],
            "shipping_address"  => ["required"],
            "order_details"  => ["required", "array"],
            "sub_total" => ["required", "numeric"],
            "discount" => ["required", "numeric"],
            "total"  => ["required", "numeric"],
            "customer_id"  => ["required", "numeric"],
            "status"  => ["required", "string"],
            "delivery_charge"  => ["required", "numeric"]
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            "order_id" =>  rand(1000, 9999) . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 3) . rand(1000, 9999)
        ]);
    }
}
