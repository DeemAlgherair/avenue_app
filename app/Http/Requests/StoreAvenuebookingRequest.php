<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

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
            'start_date' => [ 
                'required', 
                'date', 
                function ($attribute, $value, $fail) { 
                    $startDate = Carbon::parse($value); 
     
                    // Check if start_date is today or in the future 
                    if ($startDate->lt(today())) { 
                        return $fail('The start date must be today or in the future.'); 
                    } 
                }, 
            ], 
            'end_date' => [ 
                'required', 
                'date', 
                'after_or_equal:start_date', 
                function ($attribute, $value, $fail) { 
                    $endDate = Carbon::parse($value); 
     
                    // Check if end_date is after start_date 
                    if ($endDate->lt(Carbon::parse($this->input('start_date')))) { 
                        return $fail('The end date must be after or equal to the start date.'); 
                    } 
     
                    // Check if end_date is today or in the future 
                    if ($endDate->lt(today())) { 
                        return $fail('The end date must be today or in the future.'); 
                    } 
                }, 
            ], 
             
        ]; 
    } 



}
