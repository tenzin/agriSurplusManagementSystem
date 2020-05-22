<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'tbl_transactions';
    protected $primaryKey = 'id';
    protected $fillable= ['refNumber','type','expiryDate','status','user_id','dzongkhag_id','gewog_id','remarks'];
    public $timestamps = false;

    // protected $table ='tbl_surplus_transacations';
    // protected $primaryKey = 'id';
    // protected protected $fillable= ['refNumber','type','expiryDate','status','user_id','dzongkhag_id','gewog_id','remarks'];
    // public $timestamps = false;

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

public function dzongkhag() {

    return $this->belongsTo(Dzongkhag::class, 'dzongkhag_id','id');

}
public function gewog() {

    return $this->belongsTo(Gewog::class, 'gewog_id','id');

}

public function scopeSearch($q, $request)
    {
        // if ($request->query('crop') && $request->has('crop')) {
        //     $q->where('productType_id', $request->query('crop'));
        // }

        if ($request->query('location') && $request->has('location')) {
            $q->where('location', $request->query('location'));
        }
    }
}
