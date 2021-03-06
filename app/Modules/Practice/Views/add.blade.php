@extends('admin.layout.main')
@section('content')

    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Add Practices </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.practices') }}">practice</a></li>
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
                    <form role="form" action="{{ route('admin.practices.store') }}"  method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="full_name">Practice Name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" required>
                            </div><div class="form-group">
                                <label for="owners_name">Owners Name</label>
                                <input type="text" name="owners_name" id="owners_name" class="form-control" required>
                            </div><div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div><div class="form-group">
                                <label for="email">Phone</label>
                                <input type="tel" name="phone" id="phone" class="form-control" required>
                            </div><div class="form-group">
                                <label for="email">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div><div class="form-group">
                                <label for="email">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div><div class="form-group">
                                <label for="payment">Payment Deadline in Days</label>
                                <input type="number" name="payment" id="payment" value="15" class="form-control" required>
                            </div><div class="form-group">
                            {{--                                    <label for="deleted_at">Deleted_at</label><input type="text" name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id"/>
                        </div>
                        {{ csrf_field() }}
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
