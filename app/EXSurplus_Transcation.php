<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EXSurplus_Transcation extends Model
{
    protected $table ='tbl_ex_surplus_transcations';
    protected $primaryKey = 'id';
    protected  $fillable= ['refNumber','type','expiryDate','status','user_id','dzongkhag_id','gewog_id','remarks'];
    public $timestamps = false;



    public function dzongkhag() 
    {

        return $this->belongsTo(Dzongkhag::class, 'dzongkhag_id','id');

    }

    public function gewog() 
    {

        return $this->belongsTo(Gewog::class, 'gewog_id','id');

    }
}
