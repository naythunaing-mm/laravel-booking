<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'name' => [
                        'required',
                        'max:10',
                        'min:5',        
                    ],

            'password' => [
                            'required',
                            'min:5',        
                        ],          
        ];
    }
    public function messages(){
        return  [
                'name.required'     => 'Please fill Name',
                'name.max'          => 'Name length is less then 10',
                'password.required' => 'Please fill  Password',
        ];
    }
}
