<?php

namespace App\Http\Requests\Bed;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class BedRequest extends FormRequest
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
                            Rule::unique('bed','name')
                            ->whereNull('deleted_at')
                            ->ignore($this->id)             
            ]
            ];
    
    }
    public function messages(){
        return [
            'name.required' => 'Please fill view Name',
            'name.name'     => 'This name is already exit'
        ];
    }
}
