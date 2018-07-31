@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hello {{Auth::user()->email}}
                  <a href="/home/fileLeave"><button class="btn btn-primary btn-md" style="float: right">File Leave</button></a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Subject</th>
                          <th>Reason</th>
                          <th>Status</th>
                          <th>Posted</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($leaves as $key => $leave)
                            <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $leave->subject }}</td>
                              <td>{{ $leave->leave_reason }}</td>


                              <td> 
                                @if($leave->isAccepted == 0)
                                  Pending
                                @else 
                                  Accepted
                                @endif
                              </td>


                              <td>{{ $leave->created_at }}</td>
                            <tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
