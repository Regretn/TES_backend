<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable =
    [
        'user_id',
        'user_type',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
