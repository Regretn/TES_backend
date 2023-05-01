<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class SectionUser extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'section_user';

    protected $fillable =
    [
        'user_id',
        'section_id',
    ];
}
