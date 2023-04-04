<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feereceipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'path','user_id'
    ];
    public $timestamps = false;
}
