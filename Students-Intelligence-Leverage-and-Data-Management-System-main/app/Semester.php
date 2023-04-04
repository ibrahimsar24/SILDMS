<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $fillable = [
        'number','batch','branch_id'
    ];
    public $timestamps = false;
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
