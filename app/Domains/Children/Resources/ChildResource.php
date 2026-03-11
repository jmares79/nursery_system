<?php

namespace App\Domains\Children\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->first_name.' '.$this->last_name,
            'nickname' => $this->nickname,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'allergies' => $this->allergies,
            'dietary_requirements' => $this->dietary_requirements,
            'medical_notes' => $this->medical_notes,
            'special_educational_needs' => $this->special_educational_needs,
            'religion' => $this->religion,
            'ethnic_origin' => $this->ethnic_origin,
            'additional_languages' => $this->additional_languages,
            'funding_type' => $this->funding_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'notes' => $this->notes,
        ];
    }
}
