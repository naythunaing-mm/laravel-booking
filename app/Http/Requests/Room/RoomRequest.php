<?php

namespace App\Http\Requests\room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomRequest extends FormRequest
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
            'name'           => ['required','string',
                                Rule::unique('room','name')
                                ->whereNull('deleted_at')
                                ->ignore($this->id) 
                                ],
            'occupancy'      => ['required','integer'],
            'bed'            => ['required','integer'],
            'size'           => ['required','integer'],
            'view'           => ['required','integer'],
            'price'          => ['required','numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'extraBed'       => ['required','numeric', 'regex:/^\d+(\.\d{1,2})?$/'], 
            'specialfeature' => ['required','array'],
            'amenity'        => ['required','array'], 
            'detail'         => ['required','string'],
            'description'    => ['required','string'],       
        ];
            
    }
    public function messages(){
        return [
            'name.required'           => 'Please fill Room Name',
            'name.unique'             => 'This name is already exit',
            'occupancy.required'      => 'Please fill Room Occupancy',
            'bed.required'            => 'Please choose Bed Type',
            'size.required'           => 'Please fill Room Size',
            'view,required'           => 'Please choose Room View',
            'price.required'          => 'Please fill Price Per Day',
            'extraBed'                => 'Please fill extra bed price',
            'specialfeature.array'    => 'Please Choose Special Feature',  
            'specialfeature.required' => 'Please Choose Special Feature',    
            'amenity.array'           => 'Please choose Amenity',
            'amenity.required'        => 'Please choose Amenity',
            'detail.required'         => 'Please fill Room Detail',
            'description.required'    => 'Please fill Room Description'
        ];
    }
    
}
