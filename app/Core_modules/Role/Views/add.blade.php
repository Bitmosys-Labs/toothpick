@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">

        <div class="page-header">
            <h1 class="page-title">Roles</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Role</a></li>
            </ol>
            <div class="page-header-actions">

                <a href="{{ '' }}" class="btn btn-sm btn-primary btn-outline btn-round" title="create">
                    <i class="icon wb-plus" aria-hidden="true"></i>
                    <span class="hidden-sm-down">Create</span>
                </a>

            </div>
        </div>

        <div class="panel">
            <header class="panel-heading">
            </header>
            <div class="panel-body">
                <form role="form" action="{{ route('admin.roles.store') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <input type="hidden" name="id" id="id"/>
                    </div>
                    {{ csrf_field() }}
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
