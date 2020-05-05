<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
  protected $table = 'tbl_permissions';
  protected $fillable = ['id','name','label'];
  public $timestamps=false;

  public function roles() {

    return $this->belongsToMany(Role::class);
  }
}
