<?php

namespace Animal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetType extends Model
{
    protected $fillable = ['code'];

    public function pet():hasMany
    {
        return $this->hasMany(Pet::class);
    }
}
