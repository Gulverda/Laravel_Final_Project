<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return true; // ამ შემთხვევაში ყველა მომხმარებლისთვის არის ნებართვა
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'სათაური აუცილებელია!',
            'content.required' => 'პოსტში შინაარსი აუცილებელია!',
        ];
    }
}
