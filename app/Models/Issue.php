<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'issueDate',
        'deposit',
        'customer_id',
        'teller_id',
        'product_id'
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
