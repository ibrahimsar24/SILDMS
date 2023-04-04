<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
