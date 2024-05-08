<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_name',
        'subscription_description',
        'subscription_price'
    ];

    public function userSubscription()
    {
        return $this->hasMany(UserSubscription::class);
    }

}
