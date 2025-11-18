<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProductTransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // GUNAKAN hasRole() bukan hasRoles()
        if ($user->hasRole('buyer')) {
            $product_transactions = $user->product_transactions()->orderBy('id', 'DESC')->get();
        } else {
            $product_transactions = ProductTransaction::orderBy('id', 'DESC')->get();
        }

        // JANGAN pakai string di sini!
        return view('admin.product_transactions.index', [
            'product_transactions' => $product_transactions
        ]);
    }

    public function show(ProductTransaction $productTransaction)
    {
        return view('admin.product_transactions.details');
    }
}
