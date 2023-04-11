<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasFactory, Notifiable;

    protected $fillable =
    [
        'user_id',
        'teacher_id',
        'user_name',
        'password',
        'email',
        'image',
        'role_id',
        'description',
        'section_id',
        'section_type',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
    public function sections()
    {
        return $this->belongsTo(Section::class);
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
