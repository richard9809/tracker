<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teller extends Authenticatable
{
    use HasFactory;

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

    protected function getTransactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
