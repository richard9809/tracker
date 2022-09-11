<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Trait_;
use App\Charts\DoughnutChart;

class TransactionController extends Controller
{
    function home()
    {
        if(Auth::user()->role == 'Admin')
        {
            $issued = Transaction::whereNotNull('issueDate')->count('id');
            $returns = Transaction::whereNotNull('returnDate')->count('id');
            $deposits = Transaction::sum('deposit');
            $credits = Transaction::sum('AmountReturned');
        }

        if(Auth::user()->role == 'Teller')
        {
            $issued = Transaction::where('teller_id', '=', Auth::user()->id)->whereNotNull('issueDate')->count('id');
            $returns = Transaction::where('teller_id', '=', Auth::user()->id)->whereNotNull('returnDate')->count('id');
            $deposits = Transaction::where('teller_id', '=', Auth::user()->id)->sum('deposit');
            $credits = Transaction::where('teller_id', '=', Auth::user()->id)->sum('AmountReturned');
        }

        if(Auth::user()->role == 'User')
        {
            $issued = Transaction::where('user_id', '=', Auth::user()->id)->whereNotNull('issueDate')->count('id');
            $returns = Transaction::where('user_id', '=', Auth::user()->id)->whereNotNull('returnDate')->count('id');
            $deposits = Transaction::where('user_id', '=', Auth::user()->id)->sum('deposit');
            $credits = Transaction::where('user_id', '=', Auth::user()->id)->sum('AmountReturned');
        }

        $chart = new DoughnutChart;
        $chart->labels(['Issued', 'Returned']);
        $chart->dataset('issues', 'doughnut', $issued->values());
        $chart->dataset('returns', 'doughnut', $returns->values());

        return view('user.dashboard', ['issued' => $issued, 'returns' => $returns, 'deposits' => $deposits, 'credits' => $credits, 'chart' => $chart]);
    }
    function index()
    {
        $transactions = Transaction::all();
        $users = User::where('role', '=', 'User')->get();

        return view('user.return', compact('transactions', 'users'));
    }

    function store(Request $request)
    {
        foreach($request->barcodes as $key=>$barcode){
            $transaction = new Transaction();
            $transaction->barcode = $barcode;
            $transaction->deposit = $request->deposit[$key];
            $transaction->customer_id = $request->customer_id;
            $transaction->teller_id = Auth::user()->id;
            $transaction->issueDate = date('Y-m-d');
            $transaction->save();
        }

        return redirect()->route('user.issue');
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
