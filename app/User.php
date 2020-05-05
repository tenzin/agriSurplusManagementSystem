<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','cid','name','dzongkhag_id','gewog_id','address','contact_number',
        'role_id','isActive','isAdmin','isStaff','username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {

        return $this->belongsTo(Role::class, 'role_id','id');
  
    }
  
    public function hasRole($role) {
  
        if(is_string($role)) {
           //return $this->role->contains('name',$role);
            return $this->role->role==$role;
        }
  
  
        //return !! $role->intersect($this->role)->count();
  
        foreach ($role as $r) {
            if ($this->hasRole($r->role)) {
  
                return true;
            }
  
  
        }
        return false;
  
  
    }
  

    public function sendPasswordResetNotification($token)
      {
          $this->notify(new ResetPassword($token));
      }
}
