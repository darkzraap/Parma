<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductTransaction extends Model
{
       use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function transactionDetails() : HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->belongsTo(cart::class);
    }
}
