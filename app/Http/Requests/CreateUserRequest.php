<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name'=>'required|max:50',
            'username'=>'required|max:50|unique:users,username',
            'user_password'=>'required|max:30|min:4',
            'user_role'=>'required',
            'user_email'=>'required|email|max:40|unique:users,email',
            'user_phone'=>'required|min:11|max:15|unique:users,phone',
        ];
    }
}
