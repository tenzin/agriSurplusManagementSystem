<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CASupply extends Model
{

    protected $table = 'tbl_cssupply';
    protected $primaryKey = 'id';
    protected $fillable= ['refNumber','productType_id','product_id','quantity','unit_id','tentativePickupDate','price','status','remarks','harvestDate'];
    public $timestamps = true;

    public function product()
   {
       return $this->belongsTo(Product::class,'product_id','id');
   }

   public function unit()
   {
        return $this->belongsTo(Unit::class, 'unit_id');
   }

   public function dzongkhag(){

    return $this->belongsTo(Dzongkhag::class, 'dzongkhag_id');

}

// public function user()
//     {
//         return $this->belongsToMany('App\User','user');
//     }
}
