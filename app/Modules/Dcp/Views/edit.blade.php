@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Dcps </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dcps') }}">dcp</a></li>
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
                    <form role="form" action="{{ route('admin.dcps.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="user_id">User_id</label><input type="text" value = "{{$dcp->user_id}}"  name="user_id" id="user_id" class="form-control" ></div><div class="form-group">
                                    <label for="staff_id">Staff_id</label><input type="text" value = "{{$dcp->staff_id}}"  name="staff_id" id="staff_id" class="form-control" ></div><div class="form-group">
                                    <label for="gdc_no">Gdc_no</label><input type="text" value = "{{$dcp->gdc_no}}"  name="gdc_no" id="gdc_no" class="form-control" ></div><div class="form-group">
                                    <label for="postcode">Postcode</label><input type="text" value = "{{$dcp->postcode}}"  name="postcode" id="postcode" class="form-control" ></div><div class="form-group">
                                    <label for="address">Address</label><input type="text" value = "{{$dcp->address}}"  name="address" id="address" class="form-control" ></div><div class="form-group">
                                    <label for="latitude">Latitude</label><input type="text" value = "{{$dcp->latitude}}"  name="latitude" id="latitude" class="form-control" ></div><div class="form-group">
                                    <label for="longitude">Longitude</label><input type="text" value = "{{$dcp->longitude}}"  name="longitude" id="longitude" class="form-control" ></div><div class="form-group">
                                    <label for="country">Country</label><input type="text" value = "{{$dcp->country}}"  name="country" id="country" class="form-control" ></div><div class="form-group">
                                    <label for="emergency_contact">Emergency_contact</label><input type="text" value = "{{$dcp->emergency_contact}}"  name="emergency_contact" id="emergency_contact" class="form-control" ></div><div class="form-group">
                                    <label for="relation_to_emergency_contact">Relation_to_emergency_contact</label><input type="text" value = "{{$dcp->relation_to_emergency_contact}}"  name="relation_to_emergency_contact" id="relation_to_emergency_contact" class="form-control" ></div><div class="form-group">
                                    <label for="travel">Travel</label><input type="text" value = "{{$dcp->travel}}"  name="travel" id="travel" class="form-control" ></div><div class="form-group">
                                    <label for="hourly_rate">Hourly_rate</label><input type="text" value = "{{$dcp->hourly_rate}}"  name="hourly_rate" id="hourly_rate" class="form-control" ></div><div class="form-group">
                                    <label for="status">Status</label><input type="text" value = "{{$dcp->status}}"  name="status" id="status" class="form-control" ></div><div class="form-group">
                                    <label for="employment_history">Employment_history</label><input type="text" value = "{{$dcp->employment_history}}"  name="employment_history" id="employment_history" class="form-control" ></div><div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$dcp->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$dcp->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$dcp->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$dcp->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.dcps') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
