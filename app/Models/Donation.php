<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'campaign_id',
        'donator_name',
        'email',
        'donator_address',
        'amount',
        'notes',
        'status',
        'proof_path',
        'order_id',
        'snap_token',
        'payment_type',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
    
    /**
     * Get the user that made the donation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
