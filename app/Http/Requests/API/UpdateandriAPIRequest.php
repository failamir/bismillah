<?php

namespace App\Http\Requests\API;

use App\Models\andri;
use InfyOm\Generator\Request\APIRequest;

class UpdateandriAPIRequest extends APIRequest
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
        $rules = andri::$rules;
        
        return $rules;
    }
}
