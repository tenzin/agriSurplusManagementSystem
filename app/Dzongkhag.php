<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Dzongkhag extends Model
{
    protected $table = 'tbl_dzongkhags';
    protected $primaryKey = 'id';
    protected $fillable= ['code','dzongkhag','region_id'];
    public $timestamps = false;

    // public function gewog(){
    //     return $this->hasMany(Gewog::class, 'dzongkhag_id');
    // }
    public function gewogs()
    {
        return $this->hasMany(Gewog::class, 'dzongkhag_id');
    }
    
    public function regionName()
    {
        return $this->belongsto('App\Region','region_id');
    }
}
