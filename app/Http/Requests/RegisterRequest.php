<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailDomainUnique;

class RegisterRequest extends FormRequest
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

    public function rules()
{
    return [
        'name' => ['required','string','max:120'],
        'email' => ['required','string','email','max:120',Rule::unique('users')->where(function ($query) {
            $domain = substr($this->input('email'), strpos($this->input('email'), '@') + 1);
            $query->whereRaw("SUBSTRING_INDEX(email, '@', -1) = ?", $domain);
        }),
        new EmailDomainUnique(),'unique:users,email',
        'not_regex:/@gmail\.com$/i',
    ],
        'password' => 'required|string|min:8|max:20|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])/|confirmed',
    ];
}

public function messages()
{
    return [
        'name.required' => 'The name field is required.',
        'email.unique' => 'This email is already registered.',
        'email.email' => 'The email must be a valid email address.',
        'email.max' => 'The email must not be greater than :max characters.',
        'email.not_regex' => 'Email addresses from @gmail.com are not allowed.',
        'password.min' => 'The password must be at least :min characters.',
        'password.max' => 'The password must not be greater than :max characters.',
        'password.regex' => 'The password must contain at least one digit, one lowercase, one uppercase, and one special character.',
    ];
}


}
