<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile_image' => 'nullable|mimes:jpeg,png',
            'username'      => 'required|max:20',
            'zip'           => 'required|size:8',
            'address'       => 'required',
            'building_name' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'profile_image.mimes' => 'jpegもしくは.pngファイルをアップロードしてください',

            'username.required' => 'お名前を入力してください',
            'username.max' => 'お名前は20文字以内で入力してください',

            'zip.required' => '郵便番号を入力してください',
            'zip.size' => '郵便番号はハイフンを含めて8文字で入力してください',

            'address.required' => '住所を入力してください',
        ];
    }
}
