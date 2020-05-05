<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $table='tbl_units';
    protected $primaryKey = 'id';
    protected $fillable = ['unit'];
    public $timestamps = false;
}
