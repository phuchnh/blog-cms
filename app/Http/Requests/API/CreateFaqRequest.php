<?php

namespace App\Http\Requests\API;

use Illuminate\Support\Arr;

class CreateFaqRequest extends ApiBaseRequest
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
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        //
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = \App\Models\Faq::$rules;
        Arr::pull($rules, 'type');
        return $rules;
    }
}
