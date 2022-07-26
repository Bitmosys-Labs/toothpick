@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Immunization Documents </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user_immunizations') }}">user_immunization</a></li>
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
                    <form role="form" action="{{ route('admin.user_immunizations.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="imm_id">Imm_id</label><input type="text" value = "{{$user_immunization->imm_id}}"  name="imm_id" id="imm_id" class="form-control" ></div><div class="form-group">
                                    <label for="user_id">User_id</label><input type="text" value = "{{$user_immunization->user_id}}"  name="user_id" id="user_id" class="form-control" ></div><div class="form-group">
                                    <label for="picture">Picture</label><input type="file" value = "{{$user_immunization->picture}}"  name="picture" id="picture" class="form-control" ></div><div class="form-group">
                                    <label for="status">Status</label><input type="text" value = "{{$user_immunization->status}}"  name="status" id="status" class="form-control" ></div><div class="form-group">
                                    <label for="validity">Validity</label><input type="date" value = "{{$user_immunization->validity}}"  name="validity" id="validity" class="form-control" ></div><div class="form-group">
                                    <label for="feedback">Feedback</label><input type="text" value = "{{$user_immunization->feedback}}"  name="feedback" id="feedback" class="form-control" ></div><div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$user_immunization->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$user_immunization->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$user_immunization->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$user_immunization->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.user_immunizations') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
