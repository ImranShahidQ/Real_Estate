@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Amenities</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Amenities</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Amenities</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Amenities Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($amenitie as $key => $amenities)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$amenities->amenities_name}}</td>
                                    <td>

                                        @if(Auth::user()->can('edit.amenitie'))
                                        <a href="{{route('edit.amenitie',$amenities->id)}}" class="btn btn-inverse-warning">Edit</a>
                                        @endif
                                        @if(Auth::user()->can('delete.amenitie'))
                                        <a href="{{route('delete.amenitie',$amenities->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
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