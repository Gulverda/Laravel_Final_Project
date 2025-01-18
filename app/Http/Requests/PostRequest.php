<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    // ავტორიზაციის შემოწმება
    public function authorize()
    {
        return true;
    }

    // ვალიდაციის წესები
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }

    // ვალიდაციისთვის მომხმარებლისთვის შეტყობინებები
    public function messages()
    {
        return [
            'title.required' => 'სათაურის შევსება აუცილებელია.',
            'title.string' => 'სათაური უნდა იყოს ტექსტური.',
            'title.max' => 'სათაური არ უნდა აღემატებოდეს 255 სიმბოლოს.',
            'content.required' => 'შინაარსი აუცილებელია.',
            'content.string' => 'შინაარსი უნდა იყოს ტექსტური.',
            'tags.array' => 'თაგები უნდა იყოს მასივი.',
            'tags.*.exists' => 'არჩეული თაგი არ არის ვალიდური.',
        ];
    }
}
