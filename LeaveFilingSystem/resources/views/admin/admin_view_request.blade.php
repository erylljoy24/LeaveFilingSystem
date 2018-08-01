@extends('admin.admin')


@section('content')
  <h1>{{ $leave->subject }}</h1>
  <p>{{ $leave->leave_reason }}</p>
@endsection
