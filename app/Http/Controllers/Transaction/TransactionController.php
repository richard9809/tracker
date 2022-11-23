<?php

namespace App\Http\Controllers\Transaction;

use App\Charts\BarChart;
use App\Charts\BottleChart;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Issue;
use App\Models\User;
use App\Models\BReturn;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Facades\Invoice;
use Yajra\Datatables\Datatables;

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

        

        $chart = new BarChart;
        $chart->labels($Rdeposits->keys());
        $chart->dataset('Deposits', 'bar', $Rdeposits->values())->backgroundColor('red');
        $chart->dataset('Credits', 'bar', $RCredits->values())->backgroundColor('green');

        

        //$returns = DB::table('issues')
        //            ->leftJoin('returns', 'issues.id', '=', 'returns.issue_id')
        //            ->select('issues.barcode as barcode', 'returns.returnDate as returnDate')
         //           ->whereNotNull('returnDate')
           //         ->count();

        return view('user.dashboard', compact('issued', 'returns', 'deposits', 'credits', 'chart'));
    }
    function index()
    {
        $issues = Issue::all();
        $customers = Customer::all();

        return view('user.return', compact('issues', 'customers'));
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
        $users = User::where('role', '=', 'User');

        return view('user.trial', compact('transactions', 'users'));
    }

    function report(Request $request){
        // $returned = BReturn::join('customers', 'returns.customer_id', '=', 'customers.id')
        //                 ->join('issues', 'returns.issue_id', '=', 'issues.id')
        //                 ->where('teller_id', '=', Auth::user()->id)
        //                 ->select('issues.barcode as Barcode', 'returns.AmountReturned', 'customers.name as Customer', 'returns.returnDate')
        //                 ->get();
        
        // return $returned;
        
        if(Auth::user()->role == 'Admin'){
            if($request->ajax()){
                $data = Customer::select('name', 'email', 'telephone', 'county');
                return Datatables::of($data)->make(true);
            }
        }

        return view('user.reports');
    }

    function issueReports(Request $request){

        if($request->ajax()){
            if(Auth::user()->role == 'Admin'){
                $issues = Issue::join('users', 'issues.teller_id', '=', 'users.id')
                    ->join('customers', 'issues.customer_id', '=', 'customers.id')
                    ->select('issues.barcode','issues.deposit', 'customers.name as Customer', 'users.fname as Teller', 'issues.issueDate');
                return Datatables::of($issues)->make(true);
            }
            if(Auth::user()->role == 'Teller'){
                $issues = Issue::join('users', 'issues.teller_id', '=', 'users.id')
                    ->join('customers', 'issues.customer_id', '=', 'customers.id')
                    ->where('teller_id', '=', Auth::user()->id)
                    ->select('issues.barcode','issues.deposit', 'customers.name as Customer', 'users.fname as Teller', 'issues.issueDate');
                return Datatables::of($issues)->make(true);
            }
        }
        return view('user.reports');
    }

    function returnReports(Request $request){
        if($request->ajax()){
            if(Auth::user()->role == 'Admin'){
                $returned = BReturn::join('users', 'returns.teller_id', '=', 'users.id')
                        ->join('customers', 'returns.customer_id', '=', 'customers.id')
                        ->join('issues', 'returns.issue_id', '=', 'issues.id')
                        ->select('issues.barcode as Barcode', 'returns.AmountReturned', 'customers.name as Customer', 'users.fname as Teller', 'returns.returnDate');
                return Datatables::of($returned)->make(true);
            }

            if(Auth::user()->role == 'Teller'){
                $returned = BReturn::join('users', 'returns.teller_id', '=', 'users.id')
                        ->join('customers', 'returns.customer_id', '=', 'customers.id')
                        ->join('issues', 'returns.issue_id', '=', 'issues.id')
                        ->select('issues.barcode as Barcode', 'returns.AmountReturned', 'customers.name as Customer', 'users.fname as Teller', 'returns.returnDate')
                        ->where('teller_id', '=', Auth::user()->id);
                return Datatables::of($returned)->make(true);
            }
        }
        return view('user.reports');
    }
}
