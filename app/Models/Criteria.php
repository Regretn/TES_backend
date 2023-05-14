<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable =
    [
        'id',
        'criteria_name',

    ];
}
