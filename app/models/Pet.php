<?php

namespace Animal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    protected $fillable = ['name','chip', 'gender', 'age', 'race', 'tatoo', 'description', 'photo_path', 'pet_type_id'];



    public function pet_type():BelongsTo
    {
        return $this->belongsTo(PetType::class);
    }
    public function loss():hasMany
    {
        return $this->hasMany(Loss::class);
    }
}
