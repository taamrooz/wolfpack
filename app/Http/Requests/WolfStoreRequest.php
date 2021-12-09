<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WolfStoreRequest extends FormRequest
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
            'name' => 'required',
            'gender' => 'in:male,female',
            'birthdate' => 'date_format:Y-m-d|before:today',
            'lat' => 'integer|min:-90|max:90|required',
            'lng' => 'integer|min:-180|max:180|required',
            'pack_id' => 'sometimes|exists:App\Pack,id'
        ];
    }
}
