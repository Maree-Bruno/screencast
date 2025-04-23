<?php

namespace Animal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loss extends Model
{
    protected $fillable = ['lost_at', 'postal_code', 'country_id', 'pet_id', 'pet_owner_id'];
    protected $casts = [
        'lost_at' => 'datetime',
    ];
    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function pet():BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
    public function pet_owner():BelongsTo
    {
        return $this->belongsTo(PetOwner::class);
    }


}
