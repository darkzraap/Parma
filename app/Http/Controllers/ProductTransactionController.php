<?php

namespace App\Http\Controllers;

use index;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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

    public function update(Request $request, ProductTransaction $productTransaction)
    {

        $productTransaction->update([
            'is_paid' => true,
        ]);
        return redirect()->back();
    }

    public function reback(Request $request, ProductTransaction $productTransaction)
    {
          $productTransaction->update([
            'is_paid' => false,
        ]);
        return redirect()->back();

    }


    public function store(Request $request){


        $user = Auth::user();
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'proof' => 'required|image|mimes:png,jpg,jpeg',
            'note' => 'required|string|max:65535',
            'post_code' => 'required|integer',
            'phone_number' => 'required|integer',

        ]);

        DB::beginTransaction();


        try{
            $subTotalCents = 0;
            $deliveryFeeCents = 10000 * 100;

            $cartItems = $user->carts;
            foreach($cartItems as $item){
                $subTotalCents += $item->product->price * 100;

            }
            $taxCents = (int)round(11 * $subTotalCents/100);
            $InsuranceCents = (int)round(23 * $subTotalCents/100);
            $grandTotalCents = $subTotalCents + $taxCents + $InsuranceCents + $deliveryFeeCents;

            $grandTotal = $grandTotalCents / 100;


            $validated['user_id'] = $user->id;
            $validated['total_amount'] = $grandTotal;
            $validated['is_paid'] = false;


            if($request->hasFile('proof')){
                $proofPath = $request->file('proof')->store('payment_proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $newTransaction = ProductTransaction::create($validated);

            foreach($cartItems as $item){
                TransactionDetail::create([
                    'product_transaction_id' => $newTransaction->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->price,

                ]);

                $item->delete();
            }

            DB::commit();


            return redirect()->route('product_transactions.index');


        }
         catch (\Exception $e) {
           DB::rollBack();
           $error = ValidationException::withMessages([
            'system_error' => ['System error!' .  $e->getMessage()],
           ]);
           throw $error;
        }



        }


    }



