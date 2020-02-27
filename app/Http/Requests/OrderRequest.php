<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Support\Facades\Validator;
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
            'client_id' => 'required|exists:clients,id',
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required'
        ];
    }

    public function messages()
    {
        $messages = [];

        foreach ($this->request->get('product_id') as $key => $value) {
            $item = $key + 1;
            $messages["product_id.$key.required"] = 'Produto não especificado';
            $messages["product_id.$key.exists"] = 'produto não encontrado no banco de dados ('. $this->request->get('description')[$key].')';
            $messages["quantity.$key.required"] = 'Quantidade do '. $item  . 'º produto não informada';
        }

        return $messages; 
    }
}
