<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
