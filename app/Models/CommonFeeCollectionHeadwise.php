<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonFeeCollectionHeadwise extends Model
{
    use HasFactory;

    protected $table = 'common_fee_collection_headwises';

    protected $guarded = [];

    public $timestamps = false;

    public function common_fee()
    {
        return $this->hasOne('App\Models\CommonFeeCollection');
    }
}
