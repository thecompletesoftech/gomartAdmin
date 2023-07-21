<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items';
    protected $primaryKey = 'item_id';
    
    protected $fillable = [
        'category_name',
        'store_id',
        'item_name',
        'item_price',
        'dis_item_price',
        'item_image',
        'item_publish',
        'item_description',
    ];

}