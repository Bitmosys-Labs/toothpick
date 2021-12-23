@extends('admin.layout.main')
@section('content')
    <section class="content-header">
        <h1>
            Add Permission_roles   
            <small></small>                    
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.permission_roles') }}">permission_role</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <form role="form" action="{{ route('admin.permission_roles.store') }}"  method="post">
                @foreach($roles as $role)
                <div class="box-body">
                    <div class="form-group">
                        <label for="role_id">{{$role->display_name}}</label>
                        <div class="form-group">
                            @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <label><input type="checkbox" name="role_permission[{{$role->id.'_'.$permission->id}}]">{{$permission->display_name}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                <input type="hidden" name="id" id="id"/>
                {{ csrf_field() }}
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.permission_roles') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $.get('{{route('admin.permission_roles.json')}}',function (data) {
                $.each(data,function (k,val) {
                    console.log(val.permission_id);
                    console.log(val.role_id);
                    $( "input[name='role_permission["+val.role_id+"_"+val.permission_id+"]'" ).attr( 'checked',true);
                });
            },'json');
        });
    </script>
@endsection
