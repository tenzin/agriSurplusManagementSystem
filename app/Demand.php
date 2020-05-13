<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    
    protected $table = 'tbl_demands';
    protected $primaryKey = 'id';
    protected $fillable= ['refNumber','productType_id','product_id','quantity','unit_id','tentativeRequiredDate','price','status','remarks','dzongkhag_id'];
    public $timestamps = false;

//     public function productType()
//    {
//        return $this->belongsTo(ProductType::class,'productType_id','id');
//    }


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


}
