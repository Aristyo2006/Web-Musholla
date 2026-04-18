<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',
        'badge',
        'is_featured',
        'order',
        'campaign_id',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
