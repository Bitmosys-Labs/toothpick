@extends('admin.layout.main')
@section('content')

    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Add Bookings </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.bookings') }}">booking</a></li>
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
                    <form role="form" action="{{ route('admin.bookings.store') }}"  method="post">
                        <div class="box-body">
                            <div class="form-group">
                                    <label for="practice_id">Practice</label>
                                        <select name="practice_id" id="practice_id" class="form-control" style="width: 100%" required>
                                        </select>
                                    </div><div class="form-group">
                                    <label for="staff_id">Staff</label>
                                    <select name="staff_id" id="staff_id" class="form-control" required>
                                        <option value="" disabled selected>Please select a staff</option>
                                        @foreach($staffs as $staff)
                                            <option value="{{$staff->id}}">{{$staff->type}}</option>
                                        @endforeach
                                    </select>
                                    </div><div class="form-group">
{{--                                    <label for="slug">Slug</label><input type="text" name="slug" id="slug" class="form-control" ></div><div class="form-group">--}}
                                    <label for="date">Date</label><input type="date" name="date" id="date" class="form-control" required></div><div class="form-group">
                                    <label for="from">From</label><input type="time" name="from" id="from" class="form-control" required></div><div class="form-group">
                                    <label for="to">To</label><input type="time" name="to" id="to" class="form-control" required></div><div class="form-group">
{{--                                    <label for="hourly_rate">Hourly_rate</label><input type="text" name="hourly_rate" id="hourly_rate" class="form-control" ></div><div class="form-group">--}}
                                    <label for="parking">Parking</label>
                                        <select type="text" name="parking" id="parking" class="form-control" required>
                                            <option value="">select Parking Info</option>
                                            @foreach($parkings as $parking)
                                                <option value="{{$parking->id}}">{{$parking->type}}</option>
                                            @endforeach
                                        </select>
                                    </div><div class="form-group">
                                <label for="additional">Additional Parking Information</label><textarea type="text" name="additional" id="additional" class="form-control"></textarea></div><div class="form-group">
                                <label for="parking">Is there anyone specific you like to work with?</label>
                                    <select type="text" name="work_with" id="work_with" class="form-control" required>
                                        <option value="Any" selected>Any</option>
                                        <option value="General Dentist">General Dentist</option>
                                        <option value="Orthodontic">Orthodontic</option>
                                        <option value="Implantologist">Implantologist</option>
                                        <option value="Endodontist">Endodontist</option>
                                        <option value="Periodontist">Periodontist</option>
                                        <option value="Oral surgeon">Oral surgeon</option>
                                        <option value="Therapist">Therapist</option>
                                        <option value="Hyg">Hyg</option>
                                        <option value="Invisalign">Invisalign</option>
                                        <option value="Reception">Reception</option>
                                    </select>
                                </div><div class="form-group">
{{--                                    <label for="status">Status</label><input type="text" name="status" id="status" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id"/>
                        </div>
                        {{ csrf_field() }}
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.bookings') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#practice_id").select2({
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
    </script>

    <script>
        $('#additional').summernote({
            height: 100
        });
    </script>
@endsection
