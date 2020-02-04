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
            'code' => 'unique:products,code|required',
            'name' => 'unique:products,name|required',
            'unit_id' => 'required',
            'brand_id' => 'required',
            'product_category_id' => 'required',
            'product_group_id' => 'required',
            'product_status_id' => 'required'
        ];
    }
}
