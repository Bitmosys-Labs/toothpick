@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">

        <div class="page-header">
            <h1 class="page-title">Assign Permissions</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Assign Permissions</a></li>
            </ol>
        </div>

        <div class="panel">
            <header class="panel-heading">
            </header>
            <div class="panel-body">

                <div class="role-title">
                    <h2>{{ ucfirst($role->name) }}</h2>
                </div>
                <span> Choose Permissions </span><br/><br/>
                <form role="form" action="{{ route('admin.assign_permission.update') }}" method="post">
                    {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        <div class="col-md-12">
                            <div class="row">
                        @foreach($permissions as $key =>$permission)
                            <div class="col-md-4">
                                <input type="checkbox" id="permission-{{$key}}" value="{{ $permission->id }}" name="permission[]" {{ in_array($permission->id,$selected_permission) ? 'checked' : ''}}>
                                <label for="permission-{{$key}}">{{$permission->display_name}}</label>
                            </div>
                        @endforeach
                    </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.roles') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
