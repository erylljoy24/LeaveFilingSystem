<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Leave;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $leaves = Leave::where('user_id', '=', $user->id)->get();
        // dd($leaves);
        return view('home', compact('user', 'leaves'));
    }

    public function showForm()
    {
      return view('file-leave');
    }

    public function storeLeave(Request $request)
    {
      $user = Auth::user();

      $leave = new Leave;
      $leave->user_id = $user->id;
      $leave->subject = $request->get('leave_subject');
      $leave->leave_reason = $request->get('leave_reason');
      // dd($leave);
      $leave->save();
      return redirect('home');
    }

    public function deleteLeave($id)
    {
      // dd($id);
      \DB::table('leaves')->delete($id);
      return redirect('home');
    }
}
