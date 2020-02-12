<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'register_number' => 'required|unique:clients,register_number',
            'corporate_name' => 'required|unique:clients,corporate_name',
            'fantasy_name' => 'required|unique:clients,fantasy_name',
        ];
    }
}
