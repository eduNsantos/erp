<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => 'unique:products,code|required|max:7',
            'name' => 'unique:products,name|required|max:120',
            'description' => 'unique:products,description|required|max:120',
            'unit_id' => 'required',
            'brand_id' => 'required',
            'product_category_id' => 'required',
            'product_group_id' => 'required',
            'product_status_id' => 'required',
            'original_product_id' => 'required_if:is_generic,1'
        ];
    }

    public function messages()
    {
        return [
            'original_product_id.required_if' => 'O campo produto original é obrigatório quando produto genérico estiver marcado.'
        ];
    }
}
