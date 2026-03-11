<?php

namespace App\Domains\Children\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required','string','max:100'],
            'last_name' => ['required','string','max:100'],
            'date_of_birth' => ['required','date'],
            'status' => ['required','in:active,inactive'],
        ];
    }
}
