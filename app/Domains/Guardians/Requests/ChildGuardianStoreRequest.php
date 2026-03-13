<?php

namespace App\Domains\Guardians\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildGuardianStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'guardian_id' => 'required|exists:guardians,id',
            'relationship' => 'nullable|string',
            'is_authorised_pickup' => 'boolean'
        ];
    }
}
