<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviewandrating extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reviewandratings';
    protected $primaryKey = 'rating_id';
    
    protected $fillable = [
        'store_id',
        'order_id',
        'order_review',
        'order_rate',
        'name',
        'item_name'
    ];

    public function getItemname(){
        return $this->belongsTo(Item::class,'item_id');
    }

}