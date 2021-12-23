@extends('admin.layout.main')
@section('content')
    <section class="content-header">
        <h1>
            Edit Users
            <small></small>                    
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.users')}}">User</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <form role="form" action="{{ route('admin.users.update',$user->id) }}" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" value = "{{$user->username}}" name="username" id="username" class="form-control" >
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" value = "{{$user->email}}"  name="email" id="email" class="form-control" >
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    (Note: Provide password if you want to change it)
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" >
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" >
                        @if ($errors->has('confirm_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Role</label>
                        <select class="form-control" name="roles">
                            @foreach($roles as $role)
                            <option value="{{$role->id}}" {{$user_role->role_id == $role->id ? 'selected':''}}>{{$role->display_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" value = "{{$user->id}}" name="id" id="id"/>
                    {{ csrf_field() }}
                    {{ method_field('PATCH')}}
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.users') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
