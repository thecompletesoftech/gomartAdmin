<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'coupans';
    protected $primaryKey = 'coupan_id';
    
    protected $fillable = [
        'coupan_code',
        'discount',
        'expiry_date',
        'discount_type',
        'store_id',
        'coupan_status',
        'coupon_image',
        'coupon_desc'
    ];

}