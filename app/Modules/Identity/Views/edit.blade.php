@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Identities </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.identities') }}">identity</a></li>
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
                    <form role="form" action="{{ route('admin.identities.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="type">Type</label><input type="text" value = "{{$identity->type}}"  name="type" id="type" class="form-control" ></div><div class="form-group">
                                    <label for="staff_id">Staff</label>
                                        <select type="text" name="staff_id" id="staff_id" class="form-control" >
                                            @foreach($staffs as $staff)
                                                @if($staff->id == $identity->staff_id )
                                                    <option value="{{$staff->id}}" selected>{{$staff->type}}</option>
                                                @else
                                                    <option value="{{$staff->id}}">{{$staff->type}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div><div class="form-group">
                                    <label for="requirement">Required?</label>
                                        <select type="text"  name="requirement" id="requirement" class="form-control" required>
                                            @if($identity->requirement == 1)
                                                <option value="1" selected>Yes</option>
                                                <option value="0">no</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>no</option>
                                            @endif
                                        </select>
                                    </div><div class="form-group">
                                {{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$identity->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$identity->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$identity->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$identity->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.identities') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
