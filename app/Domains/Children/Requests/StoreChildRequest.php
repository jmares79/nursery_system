<?php

namespace App\Domains\Children\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'nickname' => 'nullable|string|max:100',
            'gender' => 'nullable|in:male,female,other,prefer_not_to_say',
            'date_of_birth' => 'required|date',
            'allergies' => 'nullable|string',
            'special_educational_needs' => 'boolean',
            'medical_notes' => 'nullable|string',
            'dietary_requirements' => 'nullable|string',
            'additional_languages' => 'nullable|string',
            'religion' => 'nullable|string',
            'ethnic_origin' => 'nullable|string',
            'funding_type' => 'in:private,government,mixed',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }
}
