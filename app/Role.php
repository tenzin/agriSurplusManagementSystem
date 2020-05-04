<?php

namespace App;
use App\Role;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'tbl_roles';
    protected $primaryKey = 'id';
    protected $fillable= ['role'];
    public $timestamps = false;
}
