@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Receipts </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.receipts') }}">receipt</a></li>
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
                    <form role="form" action="{{ route('admin.receipts.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="timesheet_id">Timesheet_id</label><input type="text" value = "{{$receipt->timesheet_id}}"  name="timesheet_id" id="timesheet_id" class="form-control" ></div><div class="form-group">
                                    <label for="slug">Slug</label><input type="text" value = "{{$receipt->slug}}"  name="slug" id="slug" class="form-control" ></div><div class="form-group">
                                    <label for="working_hours">Working_hours</label><input type="text" value = "{{$receipt->working_hours}}"  name="working_hours" id="working_hours" class="form-control" ></div><div class="form-group">
                                    <label for="rate">Rate</label><input type="text" value = "{{$receipt->rate}}"  name="rate" id="rate" class="form-control" ></div><div class="form-group">
                                    <label for="total">Total</label><input type="text" value = "{{$receipt->total}}"  name="total" id="total" class="form-control" ></div><div class="form-group">
                                    <label for="status">Status</label><input type="text" value = "{{$receipt->status}}"  name="status" id="status" class="form-control" ></div><div class="form-group">
                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$receipt->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">
                                    <label for="created_at">Created_at</label><input type="text" value = "{{$receipt->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">
                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$receipt->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>
<input type="hidden" name="id" id="id" value = "{{$receipt->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.receipts') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
