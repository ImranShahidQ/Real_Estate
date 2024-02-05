@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<style>
    .form-check-label{
        text-transform: capitalize;
    }
</style>

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add Roles In Permission</h6>

                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('store.role.permission') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="role_id" class="form-label">Roles Name</label>
                                <select name="role_id" id="role_id" class="form-select">
                                    <option value="" selected="" disabled="">Select Group</option>
                                    @foreach($role as $roles)
                                    <option value="{{$roles->id}}">{{$roles->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                                <label for="checkDefaultmain" class="form-check-label">Permission All</label>
                            </div>
                            <hr>
                            @foreach($permission_group as $group)
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="checkDefault">
                                        <label for="checkDefault" class="form-check-label">{{$group->group_name}}</label>
                                    </div>
                                </div>
                                <div class="col-9">
                                    @php
                                    $permissions = App\Models\User::getpermissionByGroupName($group->group_name)
                                    @endphp
                                    @foreach($permissions as $permission)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" name="permission[]" id="checkDefault {{$permission->id}}" value="{{$permission->id}}">
                                        <label for="checkDefault {{$permission->id}}" class="form-check-label">{{$permission->name}}</label>
                                    </div>
                                    @endforeach
                                    <br>
                                </div>
                            </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary me-2">Save Role</button>
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

            },
            messages: {
                name: {
                    required: 'Please Enter Role Name',
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
<script>
    $('#checkDefaultmain').click(function(){
        if ($(this).is(':checked')) {
            $('input[type=checkbox]').prop('checked',true);
        }else{
            $('input[type=checkbox]').prop('checked',false);
        }
    });
</script>

@endsection