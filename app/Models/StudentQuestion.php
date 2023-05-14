<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuestion extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable =
    [
        'teacher_question',

    ];
}
