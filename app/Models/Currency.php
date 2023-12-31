<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'currencys';
    protected $primaryKey = 'currency_id';
    
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'symbol_at_right',
        'currency_status'
    ];

}