@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">

        <div class="page-header">
            <h1 class="page-title">Edit Roles</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Role</a></li>
            </ol>
            <div class="page-header-actions">
            </div>
        </div>

        <div class="panel">
            <header class="panel-heading">
            </header>
            <div class="panel-body">
                <form role="form" action="{{ route('admin.roles.update',$role->id )}}" method="post">
                    <div class="box-body">
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{$role->name}}" name="name" id="name"
                                   class="form-control">
                            @if ($errors->has('name'))
                                <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                            @endif
                        </div>
                        <input type="hidden" name="id" id="id" value="{{$role->id}}"/>
                        {{ csrf_field() }}
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.roles') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
