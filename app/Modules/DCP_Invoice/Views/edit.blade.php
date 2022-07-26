@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">DCP Invoice Details</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.timesheets') }}">timesheet</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
            <div class="page-header-actions">
            </div>
        </div>
        <div class="panel">
            <form action="{{route('admin.payableHours')}}" method="post" style="padding: 30px;">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="values_till_date">Total Payable Hours Till Date</label>
                        <input type="date" class="form-control" name="till_date" required><br>
                        <input type="hidden" name="user_id" value="{{$id}}">

                        <button type="submit" class="btn btn-success">Get</button><br>
                        <h2 id="Total_Hours"></h2>
                    </div>
                </div>
            </form>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Slug</th>
                    <th scope="col">Date</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Lunch Time</th>
                    <th scope="col">Total Hours</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>

                        @foreach($timesheets as $timesheet)
                            @if($timesheet->booking->booking_status->user_id == $id)
                                <tr>
                                    <th scope="row">{{$timesheet->slug}}</th>
{{--                                    <td>{{$timesheet->created_at}}</td>--}}
                                    <td>{{\Carbon\Carbon::parse($timesheet->created_at)->format('d/m/Y')}}</td>
                                    <td>{{$timesheet->start_time}}</td>
                                    <td>{{$timesheet->end_time}}</td>
                                    <td>{{$timesheet->lunch_time}}</td>
                                    <td>{{$timesheet->total_hours}}</td>
                                    <td>
                                        @if($timesheet->status == 0)
                                            Conflicted
                                        @elseif($timesheet->status == 1)
                                            Pending
                                        @else
                                            Paid
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
