<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EXSurplus extends Model
{
    protected $table = 'tbl_ex_surplus';
    protected $primaryKey = 'id';
    protected $fillable= ['refNumber','productType_id','product_id','quantity','unit_id','tentativePickupDate','price','status','remarks','harvestDate'];
    public $timestamps = true;

    public function productType()
    {
        return $this->belongsTo(ProductType::class,'productType_id','id');
    }

    public function product()
   {
       return $this->belongsTo(Product::class,'product_id','id');
   }

   public function unit()
   {
        return $this->belongsTo(Unit::class, 'unit_id');
   }
//    public function dzongkhag()
//    {
//        return $this->belongsTo(Dzongkhag::class,'dzongkhag_id');
//    }
   public function gewog()
   {
    return $this->belongsTo(Gewog::class,'gewog_id');
  }
     //link to transaction table using refNumber.
     public function transaction()
     {
         return $this->belongsTo(Transaction::class,'refNumber','refNumber');
     }
}
