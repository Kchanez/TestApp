<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                //'photo' => 'required|max:2048|mimes:png,jpg',
                'name' => 'required|max:20|unique:offers,name',
                'price' => 'required|numeric',
                'details' => 'required|max:100',
            ];
    }

    public function messages()
    {
        return [
           // 'photo.required'=>trans(key:'messages.offer photo required'),
            'name.required'=>trans(key:'messages.offer name required'),
            'name.required' =>trans(key:'messages.offer name required'),
            'name.unique' =>trans(key: 'messages.offer name must be unique'),
            'price.numeric' =>trans(key:'messages.offer price must be a number'),
            'price.required' =>trans(key:'messages.offer price must be required'),
            'details.required' =>trans(key:'messages.offer details must be required'),
        ];
    }
}
