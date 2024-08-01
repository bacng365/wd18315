<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ];

        //Ex01
        // return [
        //     'name' => 'required|max:100',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|min:8|confirmed' // Hoac dung 'same'
        // ];

        //Ex02
        // return [
        //     'email' => 'required|email|unique:users,email,'.$this->userId,
        //     'age' => 'nullable|integer|min:18|max:100',
        //     'avatar' => 'nullable|file|image|mimes:jpeg,jpg,png|max:2048'
        // ];

        //Ex03
        // return [
        //     'is_shipping_address_same' => 'required|bollean',
        //     'shipping_address' => 'required_if:is_shipping_address_same,true',
        // ];

        //Ex04
        // return [
        //     'user_id' => 'required|exists:users,id',
        //     'vote_star' => 'required|min:1|max:5',
        //     'feedback' => 'required|min:50|max:500'
        // ];

        //Ex05
        // return [
        //     'name' => 'required|string|min:5|max:20',
        //     'birth_day' => 'required|date|date_format:d/m/Y',
        //     'province' => 'nullable|string',
        //     'district' => 'required_if:province,!null'
        // ];

        //Ex06
        // return [
        //     'username' => 'required|unique:users,username',
        //     'phone_number' => 'nullable|regex:/^(+?[\d\s-()]{7,15})$/',
        // ];

    }

    public function messages() {
        return [
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Email chưa được đăng ký',
            'password.required' => 'Không được để trống email',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự'
        ];
    }
}
