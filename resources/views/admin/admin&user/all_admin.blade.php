@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admins</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Admins</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Admin</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone No.</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alladmin as $key => $alladmins)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$alladmins->name}}</td>
                                    <td>{{$alladmins->email}}</td>
                                    <td>{{$alladmins->phone}}</td>
                                    <td>{{$alladmins->address}}</td>
                                    <td>
                                        @foreach($alladmins->roles as $role)
                                        <span class="badge badge-pill bg-danger">{{$role->name}}</span>
                                        @endforeach
                                    </td>
                                    <td><img src="{{(!empty($alladmins->photo)) ? url('upload/admin_images/'.$alladmins->photo) : url('upload/no_image.jpg')}}" style="width: 70px; height: 70px;"></td>
                                    <td>
                                        <a href="{{route('edit.admin',$alladmins->id)}}" class="btn btn-inverse-warning">Edit</a>
                                        <a href="{{route('delete.admin',$alladmins->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
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