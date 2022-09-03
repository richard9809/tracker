<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Trait_;

class TransactionController extends Controller
{
    function index()
    {
        $transactions = Transaction::all();
        $users = User::all();

        return view('teller.return', compact('transactions', 'users'));
    }

    function store(Request $request)
    {
        foreach($request->barcodes as $key=>$barcode){
            $transaction = new Transaction();
            $transaction->barcode = $barcode;
            $transaction->deposit = $request->deposit[$key];
            $transaction->user_id = $request->customer_id;
            $transaction->teller_id = Auth::user()->id;
            $transaction->issueDate = date('Y-m-d');
            $transaction->save();
        }

        return redirect()->route('teller.issue');
    }

    function return(Request $request)
    {
        Transaction::where('barcode', '=', $request->barcodes)->update([
            'returnDate' => date('Y-m-d'),
            'AmountReturned' => $request->deposit,
            'return_customer' => $request->customer_id,
            'return_teller' => Auth::user()->id
        ]);
        
        return redirect()->route('teller.returnProduct');
    }
}
