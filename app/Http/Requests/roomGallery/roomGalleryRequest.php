<?php

namespace App\Http\Requests\roomGallery;

use Illuminate\Foundation\Http\FormRequest;

class roomGalleryRequest extends FormRequest
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
            
            'id'             => ['required','integer'], 
            'file'         => ['required','file','mimes:jpg,png,gif,jepg'],    
        ];
            
    }
    public function messages(){
        return [
            
            'id.required'      => 'Please fill Room Detail',
            'file.required'    => 'Please fill Room Image',
            'file.mimes'       => 'This room image is must be JPG, PNG, GIF, JEPG',
        ];
    }
    
}
