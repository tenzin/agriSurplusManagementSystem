<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $table = 'tbl_regions';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
