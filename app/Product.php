<?php

namespace App;

use App\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';
    protected $fillable= ['product'];
    public $timestamps = false;
}
