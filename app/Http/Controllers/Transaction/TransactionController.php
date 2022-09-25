<?php

namespace App\Http\Controllers\Transaction;

use App\Charts\BarChart;
use App\Charts\BottleChart;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Trait_;
use App\Charts\DoughnutChart;
use App\Charts\PieChart;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

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

            $Rdeposits = Transaction::groupBy('issueDate')
                        ->selectRaw('sum(deposit) as sum, issueDate')
                        ->pluck('sum', 'issueDate');
            $RCredits = Transaction::groupBy('returnDate')
                        ->selectRaw('sum(AmountReturned) as sum, returnDate')
                        ->pluck('sum', 'returnDate');

            $Bissued = Transaction::whereNotNull('issueDate')
                        ->groupBy('issueDate')
                        ->selectRaw('count(issueDate) as count, issueDate')
                        ->pluck('count', 'issueDate');

            $Breturns =  Transaction::whereNotNull('returnDate')
                        ->groupBy('returnDate')
                        ->selectRaw('count(returnDate) as count, returnDate')
                        ->pluck('count', 'returnDate');

            

        }

        if(Auth::user()->role == 'Teller')
        {
            $issued = Transaction::where('teller_id', '=', Auth::user()->id)->whereNotNull('issueDate')->count('id');
            $returns = Transaction::where('teller_id', '=', Auth::user()->id)->whereNotNull('returnDate')->count('id');
            $deposits = Transaction::where('teller_id', '=', Auth::user()->id)->sum('deposit');
            $credits = Transaction::where('return_teller', '=', Auth::user()->id)->sum('AmountReturned');

            $Rdeposits = Transaction::where('teller_id', '=', Auth::user()->id)
                        ->groupBy('issueDate')
                        ->selectRaw('sum(deposit) as sum, issueDate')
                        ->pluck('sum', 'issueDate');
            $RCredits = Transaction::where('teller_id', '=', Auth::user()->id)
                        ->groupBy('returnDate')
                        ->selectRaw('sum(AmountReturned) as sum, returnDate')
                        ->pluck('sum', 'returnDate');

            
        }

        if(Auth::user()->role == 'User')
        {
            $issued = Transaction::where('customer_id', '=', Auth::user()->id)->whereNotNull('issueDate')->count('id');
            $returns = Transaction::where('customer_id', '=', Auth::user()->id)->whereNotNull('returnDate')->count('id');
            $deposits = Transaction::where('customer_id', '=', Auth::user()->id)->sum('deposit');
            $credits = Transaction::where('return_customer', '=', Auth::user()->id)->sum('AmountReturned');

            $Rdeposits = Transaction::where('customer_id', '=', Auth::user()->id)
                ->groupBy('issueDate')
                ->selectRaw('sum(deposit) as sum, issueDate')
                ->pluck('sum', 'issueDate');
            $RCredits = Transaction::where('customer_id', '=', Auth::user()->id)
                ->groupBy('returnDate')
                ->selectRaw('sum(AmountReturned) as sum, returnDate')
                ->pluck('sum', 'returnDate');
        }

        $BottlesIssued = Transaction::whereNull('returnDate')
                            ->groupBy('returnDate')
                            ->selectRaw('count(returnDate) as count, returnDate')
                            ->pluck('count');

            $BottlesReturned = Transaction::whereNotNull('returnDate')
                            ->groupBy('returnDate')
                            ->selectRaw('count(returnDate) as count, returnDate')
                            ->pluck('count');

        $chart = new BarChart;
        $chart->labels($Rdeposits->keys());
        $chart->dataset('Deposits', 'bar', $Rdeposits->values())->backgroundColor('red');
        $chart->dataset('Credits', 'bar', $RCredits->values())->backgroundColor('green');

        $BottleChart = new BarChart;
        $BottleChart->labels($Bissued->keys());
        $BottleChart->dataset('Issued', 'bar', $Bissued->values())->backgroundColor('red');
        $BottleChart->dataset('Returns', 'bar', $Breturns->values())->backgroundColor('green');

        $Doughnut = new BarChart;
        $Doughnut->labels($BottlesIssued->keys());
        $Doughnut->dataset('Issued', 'doughnut', $BottlesIssued->values())->backgroundColor('red');
        $Doughnut->dataset('Returns', 'doughnut', $BottlesReturned->values())->backgroundColor('green');

        return view('user.dashboard', compact('issued', 'returns', 'deposits', 'credits', 'chart', 'BottleChart', 'Doughnut'));
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
