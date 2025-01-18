<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ];
    }

    // გამორჩეული შეცდომის შეტყობინებები
    public function messages()
    {
        return [
            'email.required' => 'მეილი აუცილებელია.',
            'email.email' => 'გთხოვთ, შეიყვანოთ ვალიდური მეილი.',
            'email.max' => 'მეილი არ უნდა აღემატებოდეს 150 სიმბოლოს.',
            'password.required' => 'პაროლი აუცილებელია.',
        ];
    }
}
