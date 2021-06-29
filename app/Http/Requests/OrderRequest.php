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

    public function messages()
    {
        return [
            "quantity.gt" => "Quantity is invalid!",
            "quantity.numeric" => "Quantity is invalid!",
            "product_id.gt" => "Quantity is invalid!",
            "product_id.numeric" => "Quantity is invalid!",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|gt:0|numeric',
            'quantity' => 'required|gt:0|numeric'
        ];
    }
}
