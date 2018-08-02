@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                Lorem Ipsum
              </div>

              <div class="card-body">
                <form role="form" method="POST" action="/home/fileLeave">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label>Subject</label>
                    <input class="form-control" name="leave_subject" placeholder="Subject"/>
                  </div>
                  <div class="form-group">
                    <label>Leave Reason</label>
                    <textarea class="form-control" name="leave_reason" placeholder="Reason of leave"></textarea>
                  </div>

                  <button type="submit" class="btn btn-danger">Submit</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
