@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Dcps </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dcps') }}">dcp</a></li>
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
                    <form role="form" action="{{ route('admin.dcps.update')}}"  method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                <label for="staff_id">Staff Type</label>
                                    <select type="text" name="staff_id" id="staff_id" class="form-control" required>
                                        @foreach($staffs as $staff)
                                            @if($staff->id == $dcp->staff_id)
                                                <option value="{{$staff->id}}" selected>{{$staff->type}}</option>
                                            @else
                                                <option value="{{$staff->id}}">{{$staff->type}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div><div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" id="full_name" value="{{$dcp->user->name}}" class="form-control" required>
                                </div><div class="form-group">
{{--                                    <label for="email">Email</label>--}}
{{--                                    <input type="email" name="email" id="email" value="{{$dcp->user->email}}" class="form-control" required>--}}
{{--                                </div><div class="form-group">--}}
                                    <label for="email">Phone</label>
                                    <input type="tel" name="phone" id="phone" value="{{$dcp->user->contact}}" class="form-control" required>
                                </div><div class="form-group">
                                <label for="role">Availability</label>
                                <select type="text" name="role" id="role" class="form-control" required>
                                    @if($dcp->user->role == 3)
                                        <option value="3" selected>Full Time</option>
                                        <option value="2">Part Time</option>
                                    @else
                                        <option value="3">Full Time</option>
                                        <option value="2" selected>Part Time</option>
                                    @endif
                                </select>
                                <label for="role">Status</label>
                                <select type="text" name="status" id="status" class="form-control" required>
                                    @if($dcp->user->status == 0)
                                        <option value="0" selected>Incomplete profile</option>
                                        <option value="1">Waiting Approval From Admin</option>
                                        <option value="2">Operational Profile</option>
                                        <option value="3">Restricted By System</option>
                                    @elseif($dcp->user->status == 1)
                                        <option value="0">Incomplete profile</option>
                                        <option value="1" selected>Waiting Approval From Admin</option>
                                        <option value="2">Operational Profile</option>
                                        <option value="3">Restricted By System</option>
                                    @elseif($dcp->user->status == 2)
                                        <option value="0">Incomplete profile</option>
                                        <option value="1">Waiting Approval From Admin</option>
                                        <option value="2" selected>Operational Profile</option>
                                        <option value="3">Restricted By System</option>
                                    @else
                                        <option value="0">Incomplete profile</option>
                                        <option value="1">Waiting Approval From Admin</option>
                                        <option value="2">Operational Profile</option>
                                        <option value="3" selected>Restricted By System</option>
                                    @endif
                                </select>
                                </div><div class="form-group">
                                    <label for="employment_history">Employment History</label>
                                    <select type="text" name="employment_history" id="employment_history" class="form-control" style="width: 100%">
                                        @if($dcp->practice)
                                            <option value="{{$dcp->employment_history}}">{{$dcp->practice->user->name}}</option>
                                        @endif
                                    </select>
                                </div><div class="form-group">
                                <input type="hidden" name="id" id="id" value = "{{$dcp->id}}" />
                                <input type="hidden" name="user_id" id="user_id" value = "{{$dcp->user->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.dcps') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#employment_history").select2({
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
