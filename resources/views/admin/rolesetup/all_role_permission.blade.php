@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Roles And Permissions</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Role And Permission</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Roles And Permissions</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Roles Name</th>
                                    <th>Permissions Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($role as $key => $roles)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$roles->name}}</td>
                                    <td>
                                        @foreach($roles->permissions as $prem)
                                        <span class="badge bg-danger">{{$prem->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('edit.role.permission',$roles->id)}}" class="btn btn-inverse-warning">Edit</a>
                                        <a href="{{route('delete.role.permission',$roles->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection