<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;
use App\Leave;
use App\Job;

class AdminTablesController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:admin');
    }
    public function displayTable()
    {
      $leave = \DB::table('leaves')
                ->join('users', 'leaves.user_id', '=', 'users.id')
                ->where('isAccepted', '=', 0)
                ->orderBy('users.id')->get(array(
                  'users.name',
                  'leaves.id',
                  'subject',
                  'leave_reason',
                  'leaves.created_at',
                  'isAccepted'
                ));
      $list1 = array();
      $leaveAll = Leave::all();

      foreach ($leaveAll as $key => $value)
      {
        if ($value->isAccepted == 0)
        {
          $list1[] = $value;
        }
      }

      $jobs = Job::all();

      return view('admin.request-table', compact('leave', 'list1', 'jobs'));
    }

    public function sortBy(Request $request)
    {
      dd($request->get('job_id'));
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
      $leaveAll = Leave::all();

      foreach ($leaveAll as $key => $value) {
        if ($value->isAccepted == 0) {
          $list1[] = $value;
        }

      }
      return view('admin.admin-view-request', compact('leave', 'list1'));
    }

    public function searchByAjax()
    {

    }
}
