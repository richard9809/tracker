<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'issueDate',
        'deposit',
        'returnDate',
        'AmountReturned',
        'customer_id',
        'teller_id',
        'return_customer',
        'return_teller'
    ]; 

    protected function getBarcode()
    {
        return $this->belongsTo(Product::class);
    }

    protected function getCustomer()
    {
        return $this->belongsTo(User::class);
    }

    protected function getTeller()
    {
        return $this->belongsTo(User::class);
    }
}

