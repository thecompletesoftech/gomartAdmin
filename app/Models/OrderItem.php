<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_items';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'order_id',
        'item_id',
        'item_name',
        'item_image',
        'item_price',
        'store_id',
        'category_id',
        'quantity',
        'item_publish',
        'item_description',
        'dis_item_price'
    ];

    
}