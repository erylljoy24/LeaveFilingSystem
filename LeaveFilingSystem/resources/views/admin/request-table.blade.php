@extends('admin.layout.admin-header')

@section('admin-section')

  <div id="wrapper">

        <!-- Sidebar -->
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

            <!-- Breadcrumbs-->
            {{-- <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">Tables</li>
            </ol> --}}

            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header">
                <form method="POST" action="/admin/sortby">
                  {{ csrf_field() }}
                  <div class="form-group row" style="float:right; margin-bottom: 0px;margin-right:1px">
                    <label for="job" class="col-md-4 col-form-label text-md-right">Sort by: </label>
                    <div class="col-md-6">
                      <select name="job_id" class="form-control" style="width:auto" onchange='this.form.submit()'>
                        <option value="0">All</option>
                        @foreach($jobs as $job)
                          <option value="{{ $job->id }}">{{ $job->job_title }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Requested By</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Posted in</th>
                        <th style="text-align:center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($leave as $key => $value)

                        <tr>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->subject }}</td>
                          <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;">{{ $value->leave_reason }}</td>
                          <td>
                            @if($value->isAccepted == 0)
                              Pending
                            @elseif($value->isAccepted == 3)
                              Rejected
                            @else
                              Accepted
                            @endif
                          </td>
                          <td>{{ $value->created_at }}</td>
                          <td style="text-align:center">
                            <form id="form-inline" action="{{url('/admin/reject', [$value->id])}}" method="POST">
                               {{method_field('PUT')}}
                               {{ csrf_field() }}
                               <input type="submit" class="btn btn-danger" value="Reject"/>
                            </form>
                            <form id="form-inline" action="{{url('/admin/approve', [$value->id])}}" method="POST">
                               {{method_field('PUT')}}
                               {{ csrf_field() }}
                               <input type="submit" class="btn btn-primary" value="Approve"/>
                            </form>
                            <a href="/admin/view/{{ $value->id }}"> <button class="btn btn-primary">View</button> </a>
                          </td>
                        </tr>
                      @endforeach

                      {{-- <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                      </tr> --}}

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
          </div>
        </div>
      </div>
@endsection
