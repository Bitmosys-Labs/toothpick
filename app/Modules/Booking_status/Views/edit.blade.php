@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Booking_statuses </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.booking_statuses') }}">booking_status</a></li>
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
                    <form role="form" action="{{ route('admin.booking_statuses.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="user_id">User_id</label><input type="text" value = "{{$booking_status->user_id}}"  name="user_id" id="user_id" class="form-control" ></div><div class="form-group">
                                    <label for="date">Date</label><input type="text" value = "{{$booking_status->date}}"  name="date" id="date" class="form-control" ></div><div class="form-group">
                                    <label for="canceled_by">Canceled_by</label><input type="text" value = "{{$booking_status->canceled_by}}"  name="canceled_by" id="canceled_by" class="form-control" ></div><div class="form-group">
                                    <label for="reason_for_cancel">Reason_for_cancel</label><input type="text" value = "{{$booking_status->reason_for_cancel}}"  name="reason_for_cancel" id="reason_for_cancel" class="form-control" ></div><div class="form-group">
                                    <label for="cancel_date">Cancel_date</label><input type="text" value = "{{$booking_status->cancel_date}}"  name="cancel_date" id="cancel_date" class="form-control" ></div><div class="form-group">
                                    <label for="status">Status</label><input type="text" value = "{{$booking_status->status}}"  name="status" id="status" class="form-control" ></div><div class="form-group">
                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$booking_status->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">
                                    <label for="created_at">Created_at</label><input type="text" value = "{{$booking_status->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">
                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$booking_status->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>
<input type="hidden" name="id" id="id" value = "{{$booking_status->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.booking_statuses') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
