<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;

class Demand extends Model
{
    //
    protected $guarded = [];

    public function transaction()
    {
       // return this->belongsTo(Transaction::class);
    }
}
