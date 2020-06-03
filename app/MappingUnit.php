<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MappingUnit extends Model
{
    protected $table = 'tbl_unit_product_mappings';
    protected $fillable = ['id','product_id','unit_id'];
    public $timestamps=false;
}
