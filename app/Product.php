<?php

namespace App;
use App\ProductType;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tbl_products';
    protected $primaryKey = 'id';
    protected $fillable= ['productType_id','product'];
   // public $timestamps = false;

   public function productType()
   {
       return $this->belongsTo(ProductType::class,'productType_id','id');
   }

}
