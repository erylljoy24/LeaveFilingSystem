<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;
use App\Leave;

class AdminController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function home()
    {
      // $leave = Leave::where('isAccepted', '=', 0)->get();

      $leave = \DB::table('leaves')
                ->join('users', 'leaves.user_id', '=', 'users.id')
                ->where('isAccepted', '=', 0)
                ->orderBy('users.id')->get(array(
                  'users.name',
                  'leaves.id',
                  'subject',
                  'isAccepted'
                ));
      return view('admin.admin_home', compact('leave'));
    }

    public function approveRequest($id)
    {
      \DB::table('leaves')
                    ->where('id', $id)
                    ->update(['isAccepted' => 1,]);

      return redirect('/admin/home');
    }
    public function rejectRequest($id)
    {
      \DB::table('leaves')
                    ->where('id', $id)
                    ->update(['isAccepted' => 3,]);
      return redirect('/admin/home');
    }

    public function viewRequest($id)
    {
      $leave = Leave::find($id);
      return view('admin.admin_view_request', compact('leave'));
    }
}
