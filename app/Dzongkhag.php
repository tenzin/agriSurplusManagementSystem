<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Dzongkhag extends Model
{
    protected $table = 'tbl_dzongkhags';
    protected $primaryKey = 'id';
    protected $fillable= ['code','dzongkhag'];
    public $timestamps = false;

    // public function gewog(){
    //     return $this->hasMany(Gewog::class, 'dzongkhag_id');
    // }
}
