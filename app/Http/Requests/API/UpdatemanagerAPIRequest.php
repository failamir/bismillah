<?php

namespace App\Http\Requests\API;

use App\Models\manager;
use InfyOm\Generator\Request\APIRequest;

class UpdatemanagerAPIRequest extends APIRequest
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
        $rules = manager::$rules;
        
        return $rules;
    }
}
