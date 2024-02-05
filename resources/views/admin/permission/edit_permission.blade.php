@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Permission</h6>

                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('update.permission') }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$permission->id}}">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Permission Name</label>
                                <input type="text" name="name" class="form-control" id="name" autocomplete="off" value="{{$permission->name}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="group_name" class="form-label">Group Name</label>
                                <select name="group_name" id="group_name" class="form-select">
                                    <option value="" selected="" disabled="">Select Group</option>
                                    <option value="type" {{ $permission->group_name == 'type' ? 'selected' : '' }}>Property Type</option>
                                    <option value="amenities" {{ $permission->group_name == 'amenities' ? 'selected' : '' }}>Amenities</option>
                                    <option value="role" {{ $permission->group_name == 'role' ? 'selected' : '' }}>Role And Permission</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary me-2">Update Permission</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                group_name: {
                    required : true,
                }, 
                
            },
            messages :{
                name: {
                    required : 'Please Enter Permission Name',
                }, 
                group_name: {
                    required : 'Please Enter Group Name',
                },

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

@endsection