<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        // აღნიშნეთ თუ კლიენტმა შეიძლება მიაღწიოს ამ მოთხოვნას
        return true;
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
            'title.required' => 'თქვენ უნდა მიუთითოთ სათაური',
            'content.required' => 'თქვენ უნდა მიუთითოთ შინაარსი',
        ];
    }

    // დავამატოთ ვალიდაციისთვის საჭირო წინასწარ დამუშავება
    public function prepareForValidation()
    {
        // მაგალითად, წაშლილია ყველა ზედმეტი ცარიელი ადგილი
        $this->merge([
            'title' => trim($this->title),
            'content' => trim($this->content),
        ]);
    }
}
