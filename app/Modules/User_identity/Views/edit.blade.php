@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit User_identities </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user_identities') }}">user_identity</a></li>
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
                    <form role="form" action="{{ route('admin.user_identities.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="ide_id">Ide_id</label><input type="text" value = "{{$user_identity->ide_id}}"  name="ide_id" id="ide_id" class="form-control" ></div><div class="form-group">
                                    <label for="user_id">User_id</label><input type="text" value = "{{$user_identity->user_id}}"  name="user_id" id="user_id" class="form-control" ></div><div class="form-group">
                                    <label for="picture">Picture</label><input type="text" value = "{{$user_identity->picture}}"  name="picture" id="picture" class="form-control" ></div><div class="form-group">
                                    <label for="status">Status</label><input type="text" value = "{{$user_identity->status}}"  name="status" id="status" class="form-control" ></div><div class="form-group">
                                    <label for="validity">Validity</label><input type="text" value = "{{$user_identity->validity}}"  name="validity" id="validity" class="form-control" ></div><div class="form-group">
                                    <label for="feedback">Feedback</label><input type="text" value = "{{$user_identity->feedback}}"  name="feedback" id="feedback" class="form-control" ></div><div class="form-group">
                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$user_identity->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">
                                    <label for="created_at">Created_at</label><input type="text" value = "{{$user_identity->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">
                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$user_identity->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>
<input type="hidden" name="id" id="id" value = "{{$user_identity->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.user_identities') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
