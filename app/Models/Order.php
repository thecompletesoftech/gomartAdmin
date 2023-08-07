<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    
    protected $fillable = [
        'user_id',
        'driver_id',
        'store_id',
        'item_name',
        'order_amount',
        'order_type',
        'order_date',
        'order_status'
    ];
}