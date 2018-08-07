<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Leave;
use App\Job;
use App\Admin;

class AdminTablesSortingController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function sortByStatus($status)
    {
      // dd($status);
      $leave = \DB::table('leaves')
                ->join('users', 'leaves.user_id', '=', 'users.id')
                ->where('isAccepted', '=', $status)
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

      return view('admin.admin-view-request-sort', compact('leave', 'list1', 'jobs'));
    }
}
