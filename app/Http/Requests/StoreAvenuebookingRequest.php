<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvenuebookingRequest extends FormRequest
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
    public function rules()
    {
        return [
            'day_id' => 'required|exists:days,id', // Ensure the day_id is selected and exists in the days table
            'size' => 'required|integer|min:1|max:12', // Ensure size is an integer between 1 and 12
        ];
    }


}
