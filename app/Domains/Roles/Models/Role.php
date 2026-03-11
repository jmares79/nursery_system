<?php

namespace App\Domains\Roles\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(
            User::class
        );
    }
}
