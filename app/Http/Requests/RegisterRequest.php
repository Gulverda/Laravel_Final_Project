<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    // ავტორიზაციის გადამოწმება
    public function authorize()
    {
        return true;
    }

    // ვალიდაციის წესები
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    // გამორჩეული შეცდომის შეტყობინებები
    public function messages()
    {
        return [
            'name.required' => 'სახელი აუცილებელია.',
            'email.required' => 'მეილი აუცილებელია.',
            'email.email' => 'გთხოვთ, შეიყვანოთ ვალიდური მეილი.',
            'email.unique' => 'ეს მეილი უკვე აღებულია.',
            'password.required' => 'პაროლი აუცილებელია.',
            'password.min' => 'პაროლი უნდა შეიცავდეს მინიმუმ 8 სიმბოლოს.',
            'password.confirmed' => 'პაროლის დადასტურება არ ემთხვევა.',
        ];
    }
}
