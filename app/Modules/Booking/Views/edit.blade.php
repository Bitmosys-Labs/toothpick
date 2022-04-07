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
                                    <label for="practice_id">Practice_id</label><input type="text" value = "{{$booking->practice_id}}"  name="practice_id" id="practice_id" class="form-control" ></div><div class="form-group">
                                    <label for="staff_id">Staff_id</label><input type="text" value = "{{$booking->staff_id}}"  name="staff_id" id="staff_id" class="form-control" ></div><div class="form-group">
                                    <label for="slug">Slug</label><input type="text" value = "{{$booking->slug}}"  name="slug" id="slug" class="form-control" ></div><div class="form-group">
                                    <label for="date">Date</label><input type="text" value = "{{$booking->date}}"  name="date" id="date" class="form-control" ></div><div class="form-group">
                                    <label for="from">From</label><input type="text" value = "{{$booking->from}}"  name="from" id="from" class="form-control" ></div><div class="form-group">
                                    <label for="to">To</label><input type="text" value = "{{$booking->to}}"  name="to" id="to" class="form-control" ></div><div class="form-group">
                                    <label for="hourly_rate">Hourly_rate</label><input type="text" value = "{{$booking->hourly_rate}}"  name="hourly_rate" id="hourly_rate" class="form-control" ></div><div class="form-group">
                                    <label for="parking">Parking</label><input type="text" value = "{{$booking->parking}}"  name="parking" id="parking" class="form-control" ></div><div class="form-group">
                                    <label for="additional">Additional</label><input type="text" value = "{{$booking->additional}}"  name="additional" id="additional" class="form-control" ></div><div class="form-group">
                                    <label for="status">Status</label><input type="text" value = "{{$booking->status}}"  name="status" id="status" class="form-control" ></div><div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$booking->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$booking->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$booking->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$booking->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.bookings') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
