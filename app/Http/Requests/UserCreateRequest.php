<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required|same:password',
            'current_password' => 'required',
            'type' => 'required',
        ];
    }

    /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */

  public function messages()
  {
      return [

            'name' => 'Name is required',
            'email' => 'Email is required',
            'password.required' => 'Password is required',
            'current_password.required' => 'Current Password is required',
            'password.regex' => 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.', 
            'type' => 'Type is required',
      ];
  }
}
