<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Cultivation extends Model
{
    protected $table = 'tbl_cultivations';
    protected $primaryKey = 'id';

    public function c_unit()
    {
        return $this->belongsTo(Cunit::class, 'c_units');
    }
    public function e_unit()
    {
        return $this->belongsTo(Unit::class, 'e_units');
    }

    public function product()
   {
       return $this->belongsTo(Product::class,'product_id');
   }
}
