<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StructureRequest extends FormRequest
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
        $rules = [];
        for ($i = 0; $i < count($this->feedstock_product_id); $i++) {
            $rules['feedstock_product_id.'.$i] = 'required';
            $rules['feedstock_quantity.'.$i] = 'required';
        }

        if ($this->no_package) {
            for ($i = 0; $i < count($this->package_product_id); $i++) {
                $rules['package_product_id.'.$i] = 'required_unless:no_package,1';
                $rules['package_quantity.'.$i] = 'required_unless:no_package,1';
            }
        }

        $rules = array_merge($rules, [
            'product_id' => 'required',
            'name' => 'required|unique:structures,name',
        ]);

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        for ($i = 0; $i < count($this->feedstock_product_id); $i++) {
            $messages['feedstock_product_id.'.$i.'.required'] = 'O campo matéria-prima ' . ((int)$i + 1) . ' é obrigatório';
            $messages['feedstock_quantity.'.$i.'.required'] = 'O campo quantidade matéria-prima ' . ((int)$i + 1) . ' é obrigatório';
        }

        if ($this->no_package) {
            for ($i = 0; $i < count($this->package_product_id); $i++) {
                $messages['package_product_id.'.$i.'.required_if'] = 'O campo embalagem ' . ((int)$i + 1) . ' é obrigatório';
                $messages['package_quantity.'.$i.'.required_if'] = 'O campo quantidade embalagem ' . ((int)$i + 1) . ' é obrigatório';
            }
        }

        return $messages;
    }
}
