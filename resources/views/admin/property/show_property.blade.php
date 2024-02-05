@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Properties</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Property</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Property</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Property Type Name</th>
                                    <th>Property Type Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($property as $key => $properties)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$properties->type_name}}</td>
                                    <td>{{$properties->type_icon}}</td>
                                    <td>
                                        @if(Auth::user()->can('edit.property'))
                                        <a href="{{route('edit.property',$properties->id)}}" class="btn btn-inverse-warning">Edit</a>
                                        @endif
                                        @if(Auth::user()->can('delete.property'))
                                        <a href="{{route('delete.property',$properties->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
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