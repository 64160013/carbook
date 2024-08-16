<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';
    protected $fillable = ['division_name'];

    // ความสัมพันธ์กับ User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

