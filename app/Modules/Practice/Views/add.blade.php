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
                                    <label for="user_id">User_id</label><input type="text" name="user_id" id="user_id" class="form-control" ></div><div class="form-group">
                                    <label for="owners_name">Owners_name</label><input type="text" name="owners_name" id="owners_name" class="form-control" ></div><div class="form-group">
                                    <label for="payment">Payment</label><input type="text" name="payment" id="payment" class="form-control" ></div><div class="form-group">
                                    <label for="postcode">Postcode</label><input type="text" name="postcode" id="postcode" class="form-control" ></div><div class="form-group">
                                    <label for="address">Address</label><input type="text" name="address" id="address" class="form-control" ></div><div class="form-group">
                                    <label for="emergency_contact">Emergency_contact</label><input type="text" name="emergency_contact" id="emergency_contact" class="form-control" ></div><div class="form-group">
                                    <label for="gdc_no">Gdc_no</label><input type="text" name="gdc_no" id="gdc_no" class="form-control" ></div><div class="form-group">
                                    <label for="contact">Contact</label><input type="text" name="contact" id="contact" class="form-control" ></div><div class="form-group">
                                    <label for="deleted_at">Deleted_at</label><input type="text" name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">
                                    <label for="created_at">Created_at</label><input type="text" name="created_at" id="created_at" class="form-control" ></div><div class="form-group">
                                    <label for="updated_at">Updated_at</label><input type="text" name="updated_at" id="updated_at" class="form-control" ></div>
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
