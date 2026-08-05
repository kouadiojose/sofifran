<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

	protected $guard = 'admin';

    protected $fillable = ['name', 'email', 'password', 'login', 'photo', 'role_id'];


    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    
 
 	public function hasPermission($permission) {

        if( in_array( $permission, $this->role->permissions()->pluck('name')->all() ) ){
            return true ;
        }
        return false;

    }

}

