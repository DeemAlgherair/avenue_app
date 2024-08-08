<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvenueRequest extends FormRequest
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
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|max:300|min:50',
            'size' => 'required|numeric|max:100|min:10',
<<<<<<< HEAD
            'advantages' => 'required|string|max:255',
=======
            'advantages' => 'string|max:255',

>>>>>>> 2efb48683cbab543e6b5ccf766db9866186d6380
        ];
    }
}
