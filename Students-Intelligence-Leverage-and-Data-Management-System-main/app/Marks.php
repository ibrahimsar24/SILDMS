<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;
//    protected $fillable = [
//        'sem','batch','branch_id'
//    ];
    protected $guarded = [];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//    public function courses()
//    {
//        return $this->hasMany(Course::class);
//    }
}
