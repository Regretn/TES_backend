<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'student_section',
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
