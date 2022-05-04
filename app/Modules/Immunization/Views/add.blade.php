@extends('admin.layout.main')
@section('content')

    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Add Immunizations </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.immunizations') }}">immunization</a></li>
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
                    <form role="form" action="{{ route('admin.immunizations.store') }}"  method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="type">Type</label><input type="text" name="type" id="type" class="form-control" ></div><div class="form-group">
                                <label for="staff_id">Staff</label>
                                <div class="container">
                                    <div class="row">
                                        @foreach($staffs as $staff)
                                            <div class="col-sm">
                                                <lable>{{$staff->type}}</lable>
                                                <input type="checkbox" name="staff_id[]" value="{{$staff->id}}" id="staff_id">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                    <label for="requirement">Required?</label>
                                        <select type="text" name="requirement" id="requirement" class="form-control" required>
                                            <option value="" disabled selected>Select Requirement</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div><div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id"/>
                        </div>
                        {{ csrf_field() }}
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.immunizations') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
