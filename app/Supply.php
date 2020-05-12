<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $guarded = [];

    public function transaction()
    {
       // return this->belongsTo(Transaction::class);
    }
}
