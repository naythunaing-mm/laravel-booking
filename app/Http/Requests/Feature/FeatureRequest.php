<?php

namespace App\Http\Requests\Feature;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class FeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
            return [
                'name'  => ['required',
                            Rule::unique('special_feature','name')
                            ->whereNull('deleted_at')
                            ->ignore($this->id)             
            ]
            ];
    
    }
    public function messages(){
        return [
            'name.required' => 'Please fill feature Name',
            'name.name'     => 'This name is already exit'
        ];
    }
}
