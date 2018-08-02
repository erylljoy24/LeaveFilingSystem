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
      return view('admin.admin_template');
    }
}
