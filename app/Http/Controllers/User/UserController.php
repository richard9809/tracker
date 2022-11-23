<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    function showUsers(){
        $users = User::all();
        $customers = Customer::all();

        return view('user.users', compact('users', 'customers'))
                    ->with('i', (request()->input('page', 1) -1) *5);
    }

    function store(Request $request){
        if(Auth::user()->role == 'Admin'){
            $request -> validate([
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|unique:users,email,except,id',
                'telephone' => 'required',
                'county' => 'required',
                'role' => 'required',
                'password' => 'required|min:4',
                'confpassword' => 'required_with:password|same:password|min:4'
            ]);
    
            User::create($request->all());

        }else if(Auth::user()->role == 'Teller'){
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->telephone = $request->telephone;
            $customer->county = $request->county;
            $customer->createdBy = Auth::user()->id;
            $customer->save();

        }

        return redirect()->route('user.users');
    }

    function edit($id){
        $user = User::find($id);
        $customer = Customer::find($id);

        return view('user.updateUser', compact('user', 'customer'));
    }

    public function update(Request $request){
        if(Auth::user()->role == 'Admin'){
            $user = User::find($request->id);

            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->telephone = $request->telephone;
            $user->county = $request->county;
            $user->role = $request->role;
            $user->save();

        }else if(Auth::user()->role == 'Teller'){
            $customer = Customer::find($request->id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->telephone = $request->telephone;
            $customer->county = $request->county;
            $customer->save();
        }

        return redirect()->route('user.users');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.users');
    }

    function checkLogin(Request $request){
        //Validate inputs
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:4|max:30'
        ]);

        $creds = $request->only('email', 'password');
        
        if(Auth::guard('web')->attempt($creds)){
            return redirect()->route('user.userHome');
        }else{
            return redirect()->route('user.userLogin')->with('fail','Email or Password is incorrect!');
        }
    }

    function logout(){
        Auth::guard('web')->logout();

        return redirect()->route('user.userLogin');
    }
}
