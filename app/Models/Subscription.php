<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'activation_date',
        'end_date'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);  // Assuming you have a SubscriptionPlan model
    }
}
