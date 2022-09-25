<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    function showUsers(){
        if(Auth::user()->role == 'Admin'){
            $users = User::all();
        }

        if(Auth::user()->role == 'Teller'){
            $users = User::where('role', '=', 'User')->get();
        }

        return view('user.users', compact('users'))
                    ->with('i', (request()->input('page', 1) -1) *5);
    }

    function store(Request $request){
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

        return redirect()->route('user.users');
    }

    function edit($id){
        $user = User::find($id);

        return view('user.updateUser', ['user' => $user]);
    }

    public function update(Request $request){
        $user = User::find($request->id);

        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->county = $request->county;
        $user->role = $request->role;
        $user->save();

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
