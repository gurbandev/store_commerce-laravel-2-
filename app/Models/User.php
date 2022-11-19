<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = false;


    public function products()
    {
        return $this->hasMany(Product::class)
            ->orderBy('id', 'desc');
    }


    public function isAdmin()
    {
        if ($this->is_admin) {
            return true;
        } else {
            return false;
        }
    }
}
