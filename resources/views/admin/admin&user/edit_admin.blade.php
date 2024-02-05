@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Admin</h6>

                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('update.admin',$user->id) }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Admin Name</label>
                                <input type="text" name="name" class="form-control" id="name" autocomplete="off" value="{{$user->name}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Admin User Name</label>
                                <input type="text" name="username" class="form-control" id="username" autocomplete="off" value="{{$user->username}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Admin Email</label>
                                <input type="email" name="email" class="form-control" id="email" autocomplete="off" value="{{$user->email}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Admin Phone No.</label>
                                <input type="number" name="phone" class="form-control" id="phone" autocomplete="off" value="{{$user->phone}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Admin Address</label>
                                <input type="text" name="address" class="form-control" id="address" autocomplete="off" value="{{$user->address}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="role" class="form-label">Role Name</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="" selected="" disabled="">Select Role</option>
                                    @foreach($role as $roles)
                                    <option value="{{$roles->id}}" {{$user->hasRole($roles->name) ? 'selected' : ''}}>{{$roles->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update Admin</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                username: {
                    required: true,
                },
                email: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                address: {
                    required: true,
                },
                password: {
                    required: true,
                },

            },
            messages: {
                name: {
                    required: 'Please Enter Admin Name',
                },
                username: {
                    required: 'Please Enter Admin UserName',
                },
                email: {
                    required: 'Please Enter Admin Email',
                },
                phone: {
                    required: 'Please Enter Admin Phone',
                },
                address: {
                    required: 'Please Enter Admin Address',
                },
                password: {
                    required: 'Please Enter Admin Password',
                },

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection