<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'size',
        'price',
    ];

    protected function getTransaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}