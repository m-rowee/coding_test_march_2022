<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditUserFormRequest extends FormRequest
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
            'username' => ['required', Rule::unique('users')->ignore(auth()->user()->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],
            'phone_number' => 'required',
        ];
    }
}
