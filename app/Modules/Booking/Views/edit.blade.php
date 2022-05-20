@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Bookings </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.bookings') }}">booking</a></li>
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
                    <form role="form" action="{{ route('admin.bookings.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="practice_id">Practice</label>
                                        <select name="practice_id" id="practice_id" class="form-control" style="width: 100%" required>
                                            @if($booking->practice_id)
                                                <option value="{{$booking->practice_id}}">{{$booking->practice->user->name}}</option>
                                            @endif
                                        </select>
                                    </div><div class="form-group">
                                    <label for="staff_id">Staff</label>
                                        <select  name="staff_id" id="staff_id" class="form-control" >
                                            @foreach($staffs as $staff)
                                                @if($staff->id == $booking->staff_id)
                                                    <option value="{{$staff->id}}" selected>{{$staff->type}}</option>
                                                @else
                                                    <option value="{{$staff->id}}">{{$staff->type}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div><div class="form-group">
{{--                                    <label for="slug">Slug</label><input type="text" value = "{{$booking->slug}}"  name="slug" id="slug" class="form-control" ></div><div class="form-group">--}}
                                    <label for="date">Date</label><input type="date" value = "{{$booking->date}}"  name="date" id="date" class="form-control" required></div><div class="form-group">
                                    <label for="from">From</label><input type="time" value = "{{$booking->from}}"  name="from" id="from" class="form-control" required></div><div class="form-group">
                                    <label for="to">To</label><input type="time" value = "{{$booking->to}}"  name="to" id="to" class="form-control" required></div><div class="form-group">
                                    <label for="hourly_rate">Hourly Rate in £</label><input type="text" value = "{{$booking->hourly_rate}}"  name="hourly_rate" id="hourly_rate" class="form-control" required></div><div class="form-group">
                                    <label for="parking">Parking</label>
                                        <select value = "{{$booking->parking}}"  name="parking" id="parking" class="form-control" >
                                            @foreach($parkings as $parking)
                                                @if($parking->id == $booking->parking)
                                                    <option value="{{$parking->id}}" selected>{{$parking->type}}</option>
                                                @else
                                                    <option value="{{$parking->id}}">{{$parking->type}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div><div class="form-group">
                                    <label for="other">Additional Parking Information</label><textarea type="text" name="other" id="other" class="form-control" >{!! $booking->other !!}</textarea></div><div class="form-group">
                                    <label for="parking">Is there anyone specific you like to work with?</label>
                                        <select type="text" name="work_with" id="work_with" class="form-control" required>
                                            @if($booking->work_with)
                                                <option value="{{$booking->work_with}}" selected>{{$booking->work_with}}</option>
                                            @endif
                                                <option value="Any">Any</option>
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
                                        <label for="other">Additional Information</label>
                                        <textarea type="text" name="additional" id="additional" class="form-control">{{$booking->additional}}</textarea>
                                    </div><div class="form-group">
                                <h5>Assign Staff</h5>

                                <div class="container">
                                            <div class="row">
                                                    <div class="col-sm-3">
                                                        <label for="fulltime">Full Time </label><br><input type="checkbox" name="fulltime" value="check" id="fulltime">
                                                    </div>
                                                <div class="col-sm-3">
                                                    <label for="parttime">Part Time </label><br><input type="checkbox" name="parttime" value="check" id="parttime">
                                                </div>
                                            </div>
                                        </div>
                                <select name="nurse" id="nurse" class="form-control" style="width: 100%">
                                    @if($booking->booking_status)
                                        <option value="{{$booking->booking_status->user->id}}">{{$booking->booking_status->user->name}}</option>
                                    @endif
                                </select></div><div class="form-group"></div><div class="form-group">
                            <input type="hidden" name="id" id="id" value = "{{$booking->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.bookings') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
{{--                    <button type="button" class="btn btn-danger float-right">Cancel</button>--}}
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
        $(document).ready(function(){
            $("#nurse").select2({
                placeholder: "Select Nurse",
                minimumInputLength: 0,
                ajax: {
                    url: '{{route('admin.booking.assignNurse')}}',
                    dataType: 'json',
                    type: "GET",
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term, full_time: $('input[name="fulltime"]:checked').val(), part_time: $('input[name="parttime"]:checked').val()
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
        $('#other').summernote({
            height: 100
        });
    </script>
@endsection
