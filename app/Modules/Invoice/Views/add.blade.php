@extends('admin.layout.main')
@section('content')

    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Add Invoices </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.invoices') }}">invoice</a></li>
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
                    <form role="form" action="{{ route('admin.invoices.store') }}"  method="post">
                        <div class="box-body">
                            <div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="slug">Slug</label><input type="text" name="slug" id="slug" class="form-control" ></div><div class="form-group">--}}
                                    <label for="practice_id">Practice_id</label><select name="practice_id" id="practice_id" class="form-control" style="width: 100%" required>
                                </select></div><div class="form-group">
                                    <label for="issue_date">Issue_date</label><input type="date" name="issue_date" id="issue_date" class="form-control" required></div><div class="form-group">
                                    <label for="due_date">Due_date</label><input type="date" name="due_date" id="due_date" class="form-control" required></div><div class="form-group">
                                    <label for="total">Total</label><input type="number" step="0.01" min="0" name="total" id="total" class="form-control" required></div><div class="form-group">
                                    <label for="remarks">Remarks</label><textarea type="text" name="remarks" id="remarks" class="form-control"></textarea></div><div class="form-group">
                                    <label for="status">Status</label><select name="status" id="status" class="form-control" required>
                                    <option value="0" selected>Pending</option>
                                    <option value="1">Paid</option>
                                    <option value="2">Undefined</option>
                                </select></div><div class="form-group">
{{--                                    <label for="created_at">Created_at</label><input type="text" name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id"/>
                        </div>
                        {{ csrf_field() }}
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.invoices') }}" class="btn btn-danger">Cancel</a>
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
@endsection
