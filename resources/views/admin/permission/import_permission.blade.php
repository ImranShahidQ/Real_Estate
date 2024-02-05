@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <nav class="page-breadcrumb">
        <a href="{{route('download')}}" class="btn btn-inverse-danger">Download Excel File</a>
    </nav>
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Import Permission</h6>

                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="import_file" class="form-label">Excel File Import</label>
                                <input type="file" name="import_file" class="form-control" id="import_file" autocomplete="off">
                            </div>

                            <button type="submit" class="btn btn-inverse-warning">Upload</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection