<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Laravel\Sanctum\HasApiTokens;


class Student extends AuthenticatableUser

{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable =
    [
        'student_section',
        'section_id',
        'student_lrn',

    ];

    public function sections()
    {
        return $this->belongsTo(Section::class);
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
