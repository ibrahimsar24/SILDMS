<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'lecture_id','user_id'
    ];
    public $timestamps = false;
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
