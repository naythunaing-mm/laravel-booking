<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
class viewListingRequest extends FormRequest
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
            'name' => ['required',
                       'max:10',
                       'min:5',
                       Rule::unique('view','name')
                       ->whereNull('deleted_at')
                       ->ignore($this->id)          
                    ],
                        
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Please fill view Name',
            'name.max'      => 'Name length is less then 10',
            'name.min'      => 'Name is at least 5.',
            'name.name'     => 'This name is already exit'
        ];
    }
}
