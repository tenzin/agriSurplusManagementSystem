<?php

namespace App;
use App\Gewog;

use Illuminate\Database\Eloquent\Model;

class Gewog extends Model
{
    protected $table = 'tbl_gewogs';
    protected $primaryKey = 'id';
    protected $fillable= ['code','dzongkhag_id','gewog','latitude','longitude'];
    public $timestamps = false;
}
