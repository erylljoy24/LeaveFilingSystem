@extends('admin.admin')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hello Admin
                </div>
                <div class="card-body">

                  <table border="1">
                    <tr>
                      <th>Requested By</th>
                      <th>Request</th>
                    </tr>

                      @foreach ($leave as $key => $value)
                        <tr>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->subject }}</td>
                          {{-- <td><a href="{{ url('/admin/approve', $value->id) }}"><button class="btn btn-primary">Approve</button></a> --}}
                          {{-- <td><a href="/admin/approve/'{{ $value->id }}"><button class="btn btn-primary">Approve</button></a> --}}
                          <td>
                            <form action="{{url('/admin/reject', [$value->id])}}" method="POST">
                               {{method_field('PUT')}}
                               {{ csrf_field() }}
                               <input type="submit" class="btn btn-danger" value="Reject"/>
                            </form>
                          </td>
                          <td>
                            <form action="{{url('/admin/approve', [$value->id])}}" method="POST">
                               {{method_field('PUT')}}
                               {{ csrf_field() }}
                               <input type="submit" class="btn btn-primary" value="Approve"/>
                            </form>
                          </td>
                          <td>
                            <a href="/admin/view/{{ $value->id }}"> <button class="btn btn-primary">View</button> </a>
                          </td>
                        </tr>
                      @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
