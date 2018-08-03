@extends('admin.layout.admin-header')


@section('admin-section')
<div id="wrapper">
  <ul class="sidebar navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="/admin/home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
    </li>
  </ul>
  <div id="content-wrapper">
    <div class="container-fluid">
      <div id="letter-container">
        <h1>{{ $leave->subject }}</h1>
        <p>{{ $leave->leave_reason }}</p>
      </div>

      <div>
        <form id="form-inline" action="{{url('/admin/reject', [$leave->id])}}" method="POST">
           {{method_field('PUT')}}
           {{ csrf_field() }}
           <input type="submit" class="btn btn-danger" value="Reject"/>
        </form>
        <form id="form-inline" action="{{url('/admin/approve', [$leave->id])}}" method="POST">
           {{method_field('PUT')}}
           {{ csrf_field() }}
           <input type="submit" class="btn btn-primary" value="Approve"/>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
