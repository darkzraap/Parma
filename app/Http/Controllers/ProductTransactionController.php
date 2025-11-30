<?php

namespace App\Http\Controllers;

use index;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductTransaction;
use Illuminate\Support\Facades\Auth;

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
        $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);
        return view('admin.product_transactions.details', ['productTransaction' => $productTransaction]);
    }
}
