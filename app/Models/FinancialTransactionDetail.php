<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransactionDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;
    
    public function financial_transaction()
    {
    return $this->hasOne('App\Models\FinancialTransaction');
    }

    public function module()
    {
    return $this->hasOne('App\Models\Module');
    }


    public function branch()
    {
    return $this->hasOne('App\Models\Branch');
    }

}
