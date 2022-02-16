@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Additionals </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.additionals') }}">additional</a></li>
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
                    <form role="form" action="{{ route('admin.additionals.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <label for="receipt_id">Receipt_id</label><input type="text" value = "{{$additional->receipt_id}}"  name="receipt_id" id="receipt_id" class="form-control" ></div><div class="form-group">
                                    <label for="amount">Amount</label><input type="text" value = "{{$additional->amount}}"  name="amount" id="amount" class="form-control" ></div><div class="form-group">
                                    <label for="purpose">Purpose</label><input type="text" value = "{{$additional->purpose}}"  name="purpose" id="purpose" class="form-control" ></div><div class="form-group">
                                    <label for="receipt">Receipt</label><input type="text" value = "{{$additional->receipt}}"  name="receipt" id="receipt" class="form-control" ></div><div class="form-group">
                                    <label for="status">Status</label><input type="text" value = "{{$additional->status}}"  name="status" id="status" class="form-control" ></div><div class="form-group">
                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$additional->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">
                                    <label for="created_at">Created_at</label><input type="text" value = "{{$additional->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">
                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$additional->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>
<input type="hidden" name="id" id="id" value = "{{$additional->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.additionals') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
