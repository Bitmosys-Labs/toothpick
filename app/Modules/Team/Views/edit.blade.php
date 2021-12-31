@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Teams </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.teams') }}">team</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
            <div class="page-header-actions">
            </div>
        </div>
        <div class="panel">
            <header class="panel-heading">
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <form role="form" action="{{ route('admin.teams.update') }}" enctype="multipart/form-data" method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="image">Image</label><input type="file" accept="image/png, image/gif, image/jpeg" value = "{{$team->image}}"  name="image" id="image" class="form-control" ></div><div class="form-group">
                                    <label for="designation">Designation</label><input type="text" value = "{{$team->designation}}"  name="designation" id="designation" class="form-control" ></div><div class="form-group">
                                    <label for="name">Name</label><input type="text" value = "{{$team->name}}"  name="name" id="name" class="form-control" ></div><div class="form-group">
{{--                                    <label for="description">Description</label><input type="text" value = "{{$team->description}}"  name="description" id="description" class="form-control" ></div><div class="form-group">--}}
                                    <label for="link">Link</label><input type="text" value = "{{$team->link}}"  name="link" id="link" class="form-control" ></div><div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$team->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$team->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$team->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$team->id}}" />
                            {{ csrf_field() }}
                        </div>
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
