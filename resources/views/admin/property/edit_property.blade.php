@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Property</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.property') }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$property->id}}">
                            <div class="mb-3">
                                <label for="type_name" class="form-label">Property Type Name</label>
                                <input type="text" name="type_name" class="form-control @error('type_name') is-invalid @enderror" id="type_name" autocomplete="off" value="{{$property->type_name}}">
                                @error('type_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="type_icon" class="form-label">Property Type Icon</label>
                                <input type="text" name="type_icon" class="form-control @error('type_icon') is-invalid @enderror" id="type_icon" autocomplete="off" value="{{$property->type_icon}}">
                                @error('type_icon')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary me-2">Update Property</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection