<?php

namespace App\Http\Controllers\Transaction;

use App\Charts\BarChart;
use App\Charts\BottleChart;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Issue;
use App\Models\User;
use App\Models\BReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Trait_;
use App\Charts\DoughnutChart;
use App\Charts\PieChart;
use App\Models\Product;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    function home()
    {
        if(Auth::user()->role == 'Admin')
        {
            $issued = Issue::count('id');
            $returns = BReturn::count('id');
            $deposits = Issue::sum('deposit');
            $credits = BReturn::sum('AmountReturned');

            $Rdeposits = Issue::groupBy('issueDate')
                        ->selectRaw('sum(deposit) as sum, issueDate')
                        ->pluck('sum', 'issueDate');
            $RCredits = BReturn::groupBy('returnDate')
                        ->selectRaw('sum(AmountReturned) as sum, returnDate')
                        ->pluck('sum', 'returnDate');
        }

        if(Auth::user()->role == 'Teller')
        {
            $issued = Issue::where('teller_id', '=', Auth::user()->id)->count('id');
            $returns = BReturn::where('teller_id', '=', Auth::user()->id)->count('id');
            $deposits = Issue::where('teller_id', '=', Auth::user()->id)->sum('deposit');
            $credits = BReturn::where('teller_id', '=', Auth::user()->id)->sum('AmountReturned');

            $Rdeposits = Issue::where('teller_id', '=', Auth::user()->id)
                        ->groupBy('issueDate')
                        ->selectRaw('sum(deposit) as sum, issueDate')
                        ->pluck('sum', 'issueDate');
            $RCredits = BReturn::where('teller_id', '=', Auth::user()->id)
                        ->groupBy('returnDate')
                        ->selectRaw('sum(AmountReturned) as sum, returnDate')
                        ->pluck('sum', 'returnDate');

            
        }

        if(Auth::user()->role == 'User')
        {
            $issued = Issue::where('customer_id', '=', Auth::user()->id)->count('id');
            $returns = BReturn::where('customer_id', '=', Auth::user()->id)->count('id');
            $deposits = Issue::where('customer_id', '=', Auth::user()->id)->sum('deposit');
            $credits = BReturn::where('customer_id', '=', Auth::user()->id)->sum('AmountReturned');

            $Rdeposits = Issue::where('customer_id', '=', Auth::user()->id)
                ->groupBy('issueDate')
                ->selectRaw('sum(deposit) as sum, issueDate')
                ->pluck('sum', 'issueDate');
            $RCredits = BReturn::where('customer_id', '=', Auth::user()->id)
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
                            
        
                            $Bissued = Transaction::whereNotNull('issueDate')
                            ->groupBy('issueDate')
                            ->selectRaw('count(issueDate) as count, issueDate')
                            ->pluck('count', 'issueDate');
    
                $Breturns =  Transaction::whereNotNull('returnDate')
                            ->groupBy('returnDate')
                            ->selectRaw('count(returnDate) as count, returnDate')
                            ->pluck('count', 'returnDate');

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

        //$returns = DB::table('issues')
        //            ->leftJoin('returns', 'issues.id', '=', 'returns.issue_id')
        //            ->select('issues.barcode as barcode', 'returns.returnDate as returnDate')
         //           ->whereNotNull('returnDate')
           //         ->count();

        return view('user.dashboard', compact('issued', 'returns', 'deposits', 'credits', 'chart', 'BottleChart', 'Doughnut'));
    }
    function index()
    {
        $issues = Issue::all();
        $users = User::where('role', '=', 'User')->get();

        return view('user.return', compact('issues', 'users'));
    }

    function store(Request $request)
    {
        foreach($request->barcodes as $key=>$barcode){
            $issue = new Issue();
            $issue->barcode = $barcode;
            $issue->deposit = $request->deposit[$key];
            $issue->customer_id = $request->customer_id;
            $issue->teller_id = Auth::user()->id;
            $issue->issueDate = date('Y-m-d');
            $issue->save();
        }

        return redirect()->route('user.issue');
    }

    function return(Request $request)
    {
        foreach($request->barcodes as $key=>$barcode){
            $breturn = new BReturn();
            $breturn->issue_id = $barcode;
            $breturn->AmountReturned = $request->deposit[$key];
            $breturn->returnDate = date('Y-m-d');
            $breturn->customer_id = $request->customer_id;
            $breturn->teller_id = Auth::user()->id;
            $breturn->save();
        }

        return redirect()->route('user.return');
    }

    function trialReturn(){
        $transactions = Transaction::all();
        $users = User::where('role', '=', 'User')->get();

        return view('user.trial', compact('transactions', 'users'));
    }
}
