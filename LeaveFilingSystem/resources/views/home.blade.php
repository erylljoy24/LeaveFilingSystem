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
                          <th>Actions</th>
                          <th>      </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($leaves as $key => $leave)
                            <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $leave->subject }}</td>
                              <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;">
                                {{ $leave->leave_reason }}
                              </td>
                              <td>
                                @if($leave->isAccepted == 0)
                                  Pending
                                @elseif($leave->isAccepted == 3)
                                  Rejected
                                @else
                                  Accepted
                                @endif
                              </td>
                              <td>{{ $leave->created_at }}</td>

                              @if($leave->isAccepted == 0)
                                <td style="padding-right:0">
                                  <a href="#"> <button class="btn primary">Edit</button></a>
                                  {{-- <a href="/home/cancel/{{ $leave->id }}"> <button class="btn alert-danger">Cancel</button></a> --}}
                                </td>
                                <td style="padding-left:0">
                                  <form action="{{url('/home/cancel', [$leave->id])}}" method="POST">
                                     {{method_field('DELETE')}}
                                     {{ csrf_field() }}
                                     <input type="submit" class="btn btn-danger" value="Cancel"/>
                                  </form>
                                </td>
                              @else
                                <td style="padding-right:0">

                                </td>
                                <td style="padding-left:0">

                                </td>
                              @endif

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
