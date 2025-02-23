<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferrerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'referrer_name',
        'referrer_number',
        'vendor_id',
        'vendor_name',
        'date',
        'amount',
        'commission_rate'
    ];
}
