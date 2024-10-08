<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'division'; // ระบุชื่อของตารางที่ถูกต้อง
    protected $primaryKey = 'division_id';
    protected $fillable = ['name'];
}
