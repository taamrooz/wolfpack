<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WolfUpdateRequest extends FormRequest
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
            'name' => 'sometimes',
            'gender' => 'sometimes|in:male,female',
            'birthdate' => 'sometimes|date_format:Y-m-d|before:today',
            'lat' => 'integer|min:-90|max:90|sometimes',
            'lng' => 'integer|min:-180|max:180|sometimes',
            'pack_id' => 'sometimes|exists:App\Pack,id'
        ];
    }
}
