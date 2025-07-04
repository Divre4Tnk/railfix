<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'serial_number' => 'required|string',
            'date_in' => 'required|date',
            'date_out' => 'nullable|date|after_or_equal:date_in',
            'pic' => 'nullable|string',
            'phone' => 'nullable|string',
            'status' => 'required|in:received,on_progress,done,returned,broken',
            'description' => 'nullable|string',
        ];
    }
}
