<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLogin()
    {
      return view('admin.admin-login');
    }

    public function login(Request $request)
    {
      // dd($request->get('email'));
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
    	{
    		return redirect()->intended('/admin/home');
    	}

    	return redirect('/admin');
    }
}
