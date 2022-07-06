@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Invoices </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.invoices') }}">invoice</a></li>
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
                    <form role="form" action="{{ route('admin.invoices.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$invoice->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="slug">Slug</label><input type="text" value = "{{$invoice->slug}}"  name="slug" id="slug" class="form-control" ></div><div class="form-group">--}}
                                <label for="practice_id">Practice_id</label><select name="practice_id" id="practice_id" class="form-control" style="width: 100%" required>
                                    <option value="{{$invoice->practice_id}}" selected>{{$invoice->practice->name}}</option>
                                </select></div><div class="form-group">
{{--                                    <label for="practice_id">Practice_id</label><input type="text" value = "{{$invoice->practice_id}}"  name="practice_id" id="practice_id" class="form-control" ></div><div class="form-group">--}}
                                    <label for="issue_date">Issue_date</label><input type="date" value = "{{$invoice->issue_date}}"  name="issue_date" id="issue_date" class="form-control" required></div><div class="form-group">
                                    <label for="due_date">Due_date</label><input type="date" value = "{{$invoice->due_date}}"  name="due_date" id="due_date" class="form-control" required></div><div class="form-group">
                                    <label for="total">Total</label><input type="number" step="0.01" min="0" value = "{{$invoice->total}}"  name="total" id="total" class="form-control" required></div><div class="form-group">
                                <label for="remarks">Remarks</label><textarea type="text"  name="remarks" id="remarks" class="form-control">{{$invoice->remarks}}</textarea></div><div class="form-group">
                                    <label for="status">Status</label><select name="status" id="status" class="form-control" required>
                                    @if($invoice->status == 0)
                                        <option value="0" selected>Pending</option>
                                        <option value="1">Paid</option>
                                        <option value="2">Undefined</option>
                                    @elseif($invoice->status == 1)
                                        <option value="0">Pending</option>
                                        <option value="1" selected>Paid</option>
                                        <option value="2">Undefined</option>
                                    @else
                                        <option value="0">Pending</option>
                                        <option value="1">Paid</option>
                                        <option value="2" selected>Undefined</option>
                                    @endif
                                </select></div><div class="form-group">
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$invoice->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$invoice->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$invoice->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.invoices') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
                <h5>Invoice Number: {{$invoice->slug}}</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">Date</th>
                        <th scope="col">Details</th>
                        <th scope="col">Hours</th>
                        <th scope="col">VAT</th>
                        <th scope="col">Payable</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sum = 0;
                    $vat = 0;
                    $payable = 0;
                    ?>
                    @foreach($invoice->timesheet as $timesheet)
                        <tr>
                            <th scope="row"><a href="{{route('admin.timesheets.edit', $timesheet->id)}}">{{$timesheet->slug}}</a></th>
                            <td>{{$timesheet->booking->date}}</td>
                            <td>{{$timesheet->booking->staff->type}}</td>
                            <td>{{$timesheet->total_hours}}</td>
                            <td>{{$timesheet->vat}}</td>
                            <td>{{$timesheet->payable_amount}}</td>
                        </tr>
                        <?php
                        $vat += $timesheet->vat;
                        $payable += $timesheet->payable_amount;
                        ?>
                    @endforeach
                    </tbody>
                    <?php
                    $sum = $vat+$payable;
                    ?>
                </table>
                <h5>Subtotal: {{$payable}}</h5>
                <h5>Vat: {{$vat}}</h5>
                <h5>Total: {{$sum}}</h5>
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
