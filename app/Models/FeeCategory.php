<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;
    
    public function branch()
    {
    return $this->hasOne('App\Models\Branch');
    }
}
