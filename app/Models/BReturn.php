<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BReturn extends Model
{
    protected $table = 'returns';

    use HasFactory;

    protected $fillable = [
        'returnDate',
        'AmountReturned',
        'issue_id',
        'customer_id',
        'teller_id'
    ];

    protected function getBarcode()
    {
        return $this->belongsTo(Issue::class);
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
