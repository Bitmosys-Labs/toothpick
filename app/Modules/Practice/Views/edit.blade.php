@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Practices </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.practices') }}">practice</a></li>
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
                    <form role="form" action="{{ route('admin.practices.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                <label for="full_name">Practice Name</label>
                                <input type="text" name="full_name" value="{{$practice->user->name}}" id="full_name" class="form-control" required>
                            </div><div class="form-group">
                                <label for="owners_name">Owners Name</label>
                                <input type="text" name="owners_name" value="{{$practice->owners_name}}" id="owners_name" class="form-control" required>
                            </div><div class="form-group">
{{--                                <label for="email">Email</label>--}}
{{--                                <input type="email" name="email" id="email" value="{{$practice->user->email}}" class="form-control" required>--}}
{{--                            </div><div class="form-group">--}}
                                <label for="email">Phone</label>
                                <input type="tel" name="phone" id="phone" value="{{$practice->user->contact}}" class="form-control" required>
                            </div><div class="form-group">
                                <label for="payment">Payment Deadline in Days</label>
                                <input type="number" name="payment" id="payment" value="{{$practice->payment}}" class="form-control" required>
                            </div><div class="form-group">
                                <label for="role">Status</label>
                                <select type="text" name="status" id="status" class="form-control" required>
                                    @if($dcp->user->status == 0)
                                        <option value="0" selected>Incomplete profile</option>
                                        <option value="1">Waiting Approval From Admin</option>
                                        <option value="2">Operational Profile</option>
                                        <option value="3">Restricted By System</option>
                                    @elseif($dcp->user->status == 1)
                                        <option value="0">Incomplete profile</option>
                                        <option value="1" selected>Waiting Approval From Admin</option>
                                        <option value="2">Operational Profile</option>
                                        <option value="3">Restricted By System</option>
                                    @elseif($dcp->user->status == 2)
                                        <option value="0">Incomplete profile</option>
                                        <option value="1">Waiting Approval From Admin</option>
                                        <option value="2" selected>Operational Profile</option>
                                        <option value="3">Restricted By System</option>
                                    @else
                                        <option value="0">Incomplete profile</option>
                                        <option value="1">Waiting Approval From Admin</option>
                                        <option value="2">Operational Profile</option>
                                        <option value="3" selected>Restricted By System</option>
                                    @endif
                                </select>
                            </div><div class="form-group">
                            {{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$practice->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$practice->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$practice->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$practice->id}}" />
<input type="hidden" name="user_id" id="user_id" value = "{{$practice->user->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.practices') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
