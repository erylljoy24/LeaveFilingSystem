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
      $list1 = array();
      $list2 = array();
      $list3 = array();

      $leave = Leave::all();

      foreach ($leave as $key => $value) {
        if ($value->isAccepted == 0) {
          $list1[] = $value;
        } elseif ($value->isAccepted == 1) {
          $list2[] = $value;
        } else {
          $list3[] = $value;
        }

      }

      return view('admin.admin_template', compact('list1', 'list2', 'list3'));
    }
}
