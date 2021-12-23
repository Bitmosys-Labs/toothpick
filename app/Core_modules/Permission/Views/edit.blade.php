@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">

        <div class="page-header">
            <h1 class="page-title">Edit Permissions</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Permission</a></li>
            </ol>
            <div class="page-header-actions">
            </div>
        </div>

        <div class="panel">
            <header class="panel-heading">
            </header>
            <div class="panel-body">
                <form role="form" action="{{ route('admin.permissions.update',$permission->id) }}" method="post">
                    <div class="box-body">
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{$permission->name}}" name="name" id="name" class="form-control">
                            @if ($errors->has('name'))
                                <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="display_name">Display_name</label>
                            <input type="text" value="{{$permission->display_name}}" name="display_name"
                                   id="display_name" class="form-control">
                            @if ($errors->has('display_name'))
                                <span class="help-block">
                            <strong>{{ $errors->first('display_name') }}</strong>
                        </span>
                            @endif
                        </div>

                        <input type="hidden" name="id" id="id" value="{{$permission->id}}"/>
                        {{ csrf_field() }}
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.permissions') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
