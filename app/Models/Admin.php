<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'telephone',
        'county',
        'role',
        'password',
    ];

    public function setPasswordAttribute($pass){
        $this->attributes['password'] = Hash::make($pass);   
    }

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
