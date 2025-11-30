<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
       use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function ProductTransaction(){
        return $this->belongsTo(ProductTransaction::class);
    }
}
