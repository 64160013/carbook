<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'email',
        'password',
        'phonenumber',
        'signature_name',
        'is_admin',
        'department_id',  // Added department_id
        'division_id',    // Added division_id
    ];

    // Fields that should be hidden
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting attributes
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship with posts
    public function posts()
    {
        return $this->hasMany(PostModel::class)->latest();
    }

    // Generate image URL
    public function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->name}";
    }

    // Relationship with Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relationship with Division
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
