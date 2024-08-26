<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'car_info';
    protected $fillable = [   
        'icon_id',   
        'car_category',
        'car_regnumber',
        'car_province',

    ];
}
