@extends('admin.layout.main')
@section('content')

    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Add Dcps </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dcps') }}">dcp</a></li>
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
                    <form role="form" action="{{ route('admin.dcps.store') }}"  method="post">
                        <div class="box-body">
                            <div class="form-group">
{{--                                    <label for="user_id">User_id</label><input type="text" name="user_id" id="user_id" class="form-control" ></div><div class="form-group">--}}
                                    <label for="staff_id">Staff Type</label>
                                        <select type="text" name="staff_id[]" id="staff_id" class="form-control" multiple="multiple" required style="width:100%;">
                                            @foreach($staffs as $staff)
                                                <option value="{{$staff->id}}">{{$staff->type}}</option>
                                            @endforeach
                                        </select>
                                    </div><div class="form-group">
                                    <label for="full_name">Full Name</label>
                                        <input type="text" name="full_name" id="full_name" class="form-control" required>
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
                                    <label for="role">Availability</label>
                                        <select type="text" name="role" id="role" class="form-control" required>
                                            <option value="" disabled selected>Select Availability</option>
                                            <option value="3">Full Time</option>
                                            <option value="2">Part Time</option>
                                        </select>
                                    </div><div class="form-group">
{{--                                    <label for="gdc_no">GDC Number</label>--}}
{{--                                        <input type="text" name="gdc_no" id="gdc_no" class="form-control" required>--}}
{{--                                    </div><div class="form-group">--}}
{{--                                    <label for="postcode">Postcode</label>--}}
{{--                                        <input type="text" name="postcode" id="postcode" class="form-control" required>--}}
{{--                                    </div><div class="form-group">--}}
{{--                                    <label for="address">Address</label>--}}
{{--                                        <input type="text" name="address" id="address" class="form-control" required></div>--}}
{{--                                    <div class="form-group">--}}
{{--                                    <label for="latitude">Latitude</label><input type="text" name="latitude" id="latitude" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="longitude">Longitude</label><input type="text" name="longitude" id="longitude" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="country">Country</label>--}}
{{--                                        <select type="text" name="country" id="country" class="form-control" required>--}}
{{--                                            <option value="">Select a Country</option>--}}
{{--                                            <option value="England">England</option>--}}
{{--                                            <option value="Scotland">Scotland</option>--}}
{{--                                            <option value="Wales">Wales</option>--}}
{{--                                            <option value="Northern Ireland">Northern Ireland</option>--}}
{{--                                        </select>--}}
{{--                                    </div><div class="form-group">--}}
{{--                                    <label for="emergency_contact">Emergency_contact</label><input type="text" name="emergency_contact" id="emergency_contact" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="relation_to_emergency_contact">Relation_to_emergency_contact</label><input type="text" name="relation_to_emergency_contact" id="relation_to_emergency_contact" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="travel">Travel</label><input type="text" name="travel" id="travel" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="hourly_rate">Hourly_rate</label><input type="text" name="hourly_rate" id="hourly_rate" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="status">Status</label><input type="text" name="status" id="status" class="form-control" ></div><div class="form-group">--}}
                                        <label for="employment_history">Employment History</label>
                                            <select type="text" name="employment_history" id="employment_history" class="form-control" style="width: 100%">
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
                            <a href="{{ route('admin.dcps') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#employment_history").select2({
                placeholder: "Select Practice",
                minimumInputLength: 2,
                ajax: {
                    url: '{{route('admin.dcps.employmentHistory')}}',
                    dataType: 'json',
                    type: "GET",
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term,
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });

        $(document).ready(function() {
            $('#staff_id').select2();
        });
    </script>
@endsection
