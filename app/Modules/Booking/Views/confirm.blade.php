@extends('admin.layout.main')
@section('content')

    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Confirm Booking</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.bookings') }}">booking</a></li>
{{--                <li class="breadcrumb-item active">Add</li>--}}
            </ol>
            <div class="page-header-actions">
            </div>
        </div>
        <div class="panel">
            <header class="panel-heading">
            </header>
            <div class="panel-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Practice</th>
                        <th scope="col">Date</th>
                        <th scope="col">Assigned</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <th scope="row"><a href="{{route('admin.bookings.edit', $booking->id)}}">{{$booking->slug}}</a></th>
                            <td>{{$booking->practice->user->name}}</td>
                            <td>{{$booking->date}}</td>
                            <td>{{$booking->booking_status->user->name}}</td>
                            <td> <span title="refresh" class="btn btn-danger" onclick="refreshClick({{$booking->id}})"><i class="fa fa-trash"></i></span></td>
                        </tr>
                        <form action="{{route('admin.booking.removeNurse')}}" method="POST" id="refreshNurse{{$booking->id}}">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{$booking->id}}">
                        </form>
                    @endforeach
                    </tbody>
                </table><hr><hr>

                <a href="{{route('admin.booking.confirm.send')}}" class="btn btn-success">Confirm</a>
            </div>
        </div>
    </div>

    <script>
        function refreshClick(id){
            $('#refreshNurse'+id).submit();
        }
    </script>
@endsection
