<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    
    public function productType()
   {
       return $this->belongsTo(ProductType::class,'productType_id','id');
   }

   public function product()
   {
       return $this->belongsTo(Product::class,'product_id','id');
   }

}
