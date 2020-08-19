<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title' => 'bail|min:5|required|max:100',//'title' refers to input type textbox on http://laravel.test/posts/create and not the column in DB, here is established the the field is required and limited to 100 characters.
            //if we add bail whenever the first rule fails, it won't proceed to validate the others.
            'content' => 'required|min:10'//same as above.
        ] ;
    }
}
