<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqDocument extends Model
{
    use HasFactory;

    protected $table = 'req_document';

    protected $fillable = [
        'companion_name',
        'objective',
        'related_project',
        'location',
        'car_pickup',
        'reservation_date',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'sum_companion',
        'car_type',
    ];
}
