<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;
    
    public function fee_category()
    {
    return $this->hasOne('App\Models\FeeCategory');
    }

    public function fee_collection_type()
    {
    return $this->hasOne('App\Models\FeeCollectionType');
    }
    public function branch()
    {
    return $this->hasOne('App\Models\Branch');
    }
}
