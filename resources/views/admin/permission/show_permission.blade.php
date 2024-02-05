@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Permissions</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Permission</li>
        </ol>
        <a href="{{route('add.permission')}}" class="btn btn-inverse-info">Add Permission</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{route('import.permission')}}" class="btn btn-inverse-warning">Import</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{route('download')}}" class="btn btn-inverse-danger">Export</a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Permission</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Permission Name</th>
                                    <th>Group Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permission as $key => $permissions)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$permissions->name}}</td>
                                    <td>{{$permissions->group_name}}</td>
                                    <td>
                                        <a href="{{route('edit.permission',$permissions->id)}}" class="btn btn-inverse-warning">Edit</a>
                                        <a href="{{route('delete.permission',$permissions->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
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