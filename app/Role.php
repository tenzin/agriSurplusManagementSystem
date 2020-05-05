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


public function users()
{
    return $this->hasMany(User::class);
}

    public function permissions() {

    	return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }

    public function givePermissionTo(Permission $permission) {

    	return $this->permissions()->save($permission);
    }

    
}
