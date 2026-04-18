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
        'show_name',
        'show_email',
        'show_message',
        'show_address',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'end_date' => 'date',
        'show_name' => 'boolean',
        'show_email' => 'boolean',
        'show_message' => 'boolean',
        'show_address' => 'boolean',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
