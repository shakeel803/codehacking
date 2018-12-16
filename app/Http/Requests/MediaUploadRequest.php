<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MediaUploadRequest extends Request
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
        return [
            'file'=>'required|mimes:jpeg,jpg,png,gif|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'file.required' =>'Please select a picture to upload',
            'file.mimes'    =>'Please select an image of type jpeg, jpg, png or gif only.'
        ];
    }
}
