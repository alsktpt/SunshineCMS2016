<?php

namespace App\Http\Requests;

use Gate;
use App\Http\Requests\Request;

class CollectionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Gate::denies('enter-backend')) 
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'uri' => 'required',
            'title' => 'required',
            'status' => 'required'
        ];
    }
}
