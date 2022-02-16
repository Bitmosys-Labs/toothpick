@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Timesheets </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.timesheets') }}">timesheet</a></li>
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
                    <form role="form" action="{{ route('admin.timesheets.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="booking_id">Booking_id</label><input type="text" value = "{{$timesheet->booking_id}}"  name="booking_id" id="booking_id" class="form-control" ></div><div class="form-group">
                                    <label for="slug">Slug</label><input type="text" value = "{{$timesheet->slug}}"  name="slug" id="slug" class="form-control" ></div><div class="form-group">
                                    <label for="start_time">Start_time</label><input type="text" value = "{{$timesheet->start_time}}"  name="start_time" id="start_time" class="form-control" ></div><div class="form-group">
                                    <label for="end_time">End_time</label><input type="text" value = "{{$timesheet->end_time}}"  name="end_time" id="end_time" class="form-control" ></div><div class="form-group">
                                    <label for="lunch_time">Lunch_time</label><input type="text" value = "{{$timesheet->lunch_time}}"  name="lunch_time" id="lunch_time" class="form-control" ></div><div class="form-group">
                                    <label for="approved_by">Approved_by</label><input type="text" value = "{{$timesheet->approved_by}}"  name="approved_by" id="approved_by" class="form-control" ></div><div class="form-group">
                                    <label for="signature">Signature</label><input type="text" value = "{{$timesheet->signature}}"  name="signature" id="signature" class="form-control" ></div><div class="form-group">
                                    <label for="payable_amount">Payable_amount</label><input type="text" value = "{{$timesheet->payable_amount}}"  name="payable_amount" id="payable_amount" class="form-control" ></div><div class="form-group">
                                    <label for="vat">Vat</label><input type="text" value = "{{$timesheet->vat}}"  name="vat" id="vat" class="form-control" ></div><div class="form-group">
                                    <label for="status">Status</label><input type="text" value = "{{$timesheet->status}}"  name="status" id="status" class="form-control" ></div><div class="form-group">
                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$timesheet->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">
                                    <label for="created_at">Created_at</label><input type="text" value = "{{$timesheet->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">
                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$timesheet->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>
<input type="hidden" name="id" id="id" value = "{{$timesheet->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.timesheets') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
