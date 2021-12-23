@extends('admin.layout.main')
@section('content')
    <section class="content-header">
        <h1>
            Add Role_users   
            <small></small>                    
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.role_users') }}">role_user</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <form role="form" action="{{ route('admin.role_users.store') }}"  method="post">
                <div class="box-body">                
                    <div class="form-group">
                                    <label for="user_id">User_id</label><input type="text" name="user_id" id="user_id" class="form-control" ></div><div class="form-group">
                                    <label for="role_id">Role_id</label><input type="text" name="role_id" id="role_id" class="form-control" ></div>
<input type="hidden" name="id" id="id"/>
                </div>
                {{ csrf_field() }}
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.role_users') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
