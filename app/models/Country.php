<?php

namespace Animal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = ['code'];

    public function pet_owners():hasMany
    {
        return $this->hasMany(PetOwner ::class);
    }

    public function loss():hasMany
    {
        return $this->hasMany(Loss::class);
    }
}
