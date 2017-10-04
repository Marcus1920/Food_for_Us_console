<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'=>'required|alpha',
            'surname'=>'required|alpha',
            'cellphone'=>'required',
            'email'=>'required|email'
        ];
    }
}
