@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Role</li>
        </ol>
        @if(Auth::user()->can('add.role'))
        <a href="{{route('add.role')}}" class="btn btn-inverse-info">Add Role</a>
        @endif
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Role</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Role Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($role as $key => $roles)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$roles->name}}</td>
                                    <td>
                                        @if(Auth::user()->can('edit.role'))
                                        <a href="{{route('edit.role',$roles->id)}}" class="btn btn-inverse-warning">Edit</a>
                                        @endif
                                        @if(Auth::user()->can('delete.role'))
                                        <a href="{{route('delete.role',$roles->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
                                        @endif
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