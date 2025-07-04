<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $userId = $this->route('admin');

        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:6|max:255|unique:users,username,' . $userId,
            'password' => $this->isMethod('post') ? 'required|min:8' : 'nullable|min:8',
        ];
    }
}
