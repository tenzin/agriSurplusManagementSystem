<?php

namespace App;
use App\Dzongkhag;

use Illuminate\Database\Eloquent\Model;

class Dzongkhag extends Model
{
    protected $table = 'tbl_dzongkhags';
    protected $primaryKey = 'id';
    protected $fillable= ['code','dzongkhag'];
    public $timestamps = false;
}
