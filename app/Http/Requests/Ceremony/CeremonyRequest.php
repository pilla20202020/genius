<?php

namespace App\Http\Requests\Ceremony;

use Illuminate\Foundation\Http\FormRequest;

class CeremonyRequest extends FormRequest
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
        $rules = [
            'title'=>'required',
            'time'=>'required',
        ];

        return $rules;
    }
}
