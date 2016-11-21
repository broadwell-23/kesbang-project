<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

    	$users = User::all();
    	$counts = User::count();

    	return view('user', ['users' => $users,
    						 'counts' => $counts]);
    }

    public function store(Request $request){

    	$user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

    	return redirect()->action('UserController@index');
    }

    public function update(Request $request){

    	if($request->has('password')) {
            $pass = bcrypt($request->password);
        } else {
            $oldpass = User::where('id', $request->id)->first();
            $pass = $oldpass->password;
        }

        $user = User::find($request->id);

    	$user->name = $request->name;
        $user->email = $request->email;
        $user->password = $pass;

        $user->save();

    	return redirect()->action('UserController@index');
    }

    public function destroy(Request $request){

    	User::find($request->id)->delete();

    	return redirect()->action('UserController@index');
    }
}
