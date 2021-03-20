<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type',
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

    public function isSuperAdmin($value='')
    {
        return $this->user_type == 'super_admin';
    }

    public function isAdmin()
    {
        return $this->user_type == 'super_admin' || $this->user_type == 'admin';
    }

    public function isCustomer()
    {
        return $this->user_type == 'customer';
    }

    public function isMadrassa()
    {
        return $this->user_type == 'madrassa';
    }

    public function isStaff()
    {
        return $this->user_type == 'staff';
    }

    public function hasRole($role)
    {
        if(($role == 'super_admin' || $role == 'admin') && ($this->user_type == 'super_admin' || $this->user_type == 'admin'))
            return true;
        else
            return $this->user_type == $role;
    }

    public function getParentUser()
    {
        if($this->parent_id == null)
            return $this->id;
        else
            return $this->parent_id;
    }
}
