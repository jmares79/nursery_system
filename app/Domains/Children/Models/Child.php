<?php

namespace App\Domains\Children\Models;

use App\Domains\Guardians\Models\Guardian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'first_name',
        'last_name',
        'nickname',
        'gender',
        'date_of_birth',
        'allergies',
        'special_educational_needs',
        'medical_notes',
        'dietary_requirements',
        'additional_languages',
        'religion',
        'ethnic_origin',
        'funding_type',
        'start_date',
        'end_date',
        'room_id',
        'address_id',
        'notes',
        'is_active'
    ];

    protected $appends = ['full_name'];

    public function guardians(): BelongsToMany
    {
        return $this->belongsToMany(Guardian::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
