<?php
namespace App\Domains\Guardians\Models;

use App\Domains\Addresses\Models\Address;
use App\Domains\Children\Models\Child;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'relationship',
        'address_id'
    ];

    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
