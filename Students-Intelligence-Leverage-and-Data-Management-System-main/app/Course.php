<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
