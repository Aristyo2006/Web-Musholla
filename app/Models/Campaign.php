<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'target_amount',
        'is_active',
        'end_date',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'end_date' => 'date',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
