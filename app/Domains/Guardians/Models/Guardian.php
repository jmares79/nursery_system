<?php

namespace App\Domains\Guardians\Models;

use App\Domains\Addresses\Models\Address;
use App\Domains\Children\Models\Child;
use Illuminate\Database\Eloquent\Builder;
use Database\Factories\GuardianFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address_id'
    ];

    protected $attributes = [
        'address_id' => null,
    ];

    protected static function newFactory()
    {
        return GuardianFactory::new();
    }

    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class)
            ->withPivot([
                'relationship',
                'is_authorised_pickup'
            ])
            ->withTimestamps();
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (!$search || strlen($search) < 2) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        });
    }
}
