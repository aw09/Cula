<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'name', 'password'
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

    public function task()
    {
        return $this->hasMany('App\member_of_task', 'id_user');
    }
    public function card()
    {
        return $this->hasMany('App\member_of_card', 'id_user');
    }
    public function board()
    {
        return $this->hasMany('App\member_of_board', 'id_user');
    }
    public function project()
    {
        return $this->hasMany('App\member_of_project', 'id_user');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment', 'id_user');
    }
}
