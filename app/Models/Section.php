<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable =
    [
        'section_id',
        'section_name',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function users()
    {
        return $this->belongsToMany(Student::class);
    }
}
