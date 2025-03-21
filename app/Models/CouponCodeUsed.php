<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponCodeUsed extends Model
{
    use HasFactory;

    protected $fillable = ['deal_id', 'coupon_code', 'user_id', 'ip_address', 'copied_at', 'used_at'];
}
