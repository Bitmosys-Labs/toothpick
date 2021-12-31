@extends('admin.layout.main')
@section('content')

    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Add Teams </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.teams') }}">team</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <div class="page-header-actions">
            </div>
        </div>
        <div class="panel">
            <header class="panel-heading">
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <form role="form" action="{{ route('admin.teams.store') }}" enctype="multipart/form-data"  method="post">
                        <div class="box-body">
                            <div class="form-group">
                                    <label for="image">Image</label><input type="file" accept="image/png, image/gif, image/jpeg" name="image" id="image" class="form-control" ></div><div class="form-group">
                                    <label for="designation">Designation</label><input type="text" name="designation" id="designation" class="form-control" ></div><div class="form-group">
                                    <label for="name">Name</label><input type="text" name="name" id="name" class="form-control" ></div><div class="form-group">
{{--                                    <label for="description">Description</label><input type="text" name="description" id="description" class="form-control" ></div><div class="form-group">--}}
                                    <label for="link">Link To Linkedin Profile (optional)</label><input type="text" name="link" id="link" class="form-control" ></div><div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id"/>
                        </div>
                        {{ csrf_field() }}
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.teams') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
