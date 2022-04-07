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
                                    <label for="user_id">User_id</label><input type="text" value = "{{$practice->user_id}}"  name="user_id" id="user_id" class="form-control" ></div><div class="form-group">
                                    <label for="owners_name">Owners_name</label><input type="text" value = "{{$practice->owners_name}}"  name="owners_name" id="owners_name" class="form-control" ></div><div class="form-group">
                                    <label for="payment">Payment</label><input type="text" value = "{{$practice->payment}}"  name="payment" id="payment" class="form-control" ></div><div class="form-group">
                                    <label for="postcode">Postcode</label><input type="text" value = "{{$practice->postcode}}"  name="postcode" id="postcode" class="form-control" ></div><div class="form-group">
                                    <label for="address">Address</label><input type="text" value = "{{$practice->address}}"  name="address" id="address" class="form-control" ></div><div class="form-group">
                                    <label for="emergency_contact">Emergency_contact</label><input type="text" value = "{{$practice->emergency_contact}}"  name="emergency_contact" id="emergency_contact" class="form-control" ></div><div class="form-group">
                                    <label for="gdc_no">Gdc_no</label><input type="text" value = "{{$practice->gdc_no}}"  name="gdc_no" id="gdc_no" class="form-control" ></div><div class="form-group">
                                    <label for="contact">Contact</label><input type="text" value = "{{$practice->contact}}"  name="contact" id="contact" class="form-control" ></div><div class="form-group">
                                    <label for="latitude">Latitude</label><input type="text" value = "{{$practice->latitude}}"  name="latitude" id="latitude" class="form-control" ></div><div class="form-group">
                                    <label for="longitude">Longitude</label><input type="text" value = "{{$practice->longitude}}"  name="longitude" id="longitude" class="form-control" ></div><div class="form-group">
                            {{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$practice->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$practice->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$practice->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$practice->id}}" />
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
