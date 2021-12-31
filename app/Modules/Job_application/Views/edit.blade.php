@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Job_applications </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.job_applications') }}">job_application</a></li>
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
                    <form role="form" action="{{ route('admin.job_applications.update') }}" enctype="multipart/form-data" method="post">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
{{--                                    <label for="full_name">Full_name</label><input type="text" value = "{{$job_application->full_name}}"  name="full_name" id="full_name" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="phone">Phone</label><input type="text" value = "{{$job_application->phone}}"  name="phone" id="phone" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="email">Email</label><input type="text" value = "{{$job_application->email}}"  name="email" id="email" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="job_id">Job_id</label><input type="text" value = "{{$job_application->job_id}}"  name="job_id" id="job_id" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="no_of_days">No_of_days</label><input type="text" value = "{{$job_application->no_of_days}}"  name="no_of_days" id="no_of_days" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="drive">Drive</label><input type="text" value = "{{$job_application->drive}}"  name="drive" id="drive" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="access_to_car">Access_to_car</label><input type="text" value = "{{$job_application->access_to_car}}"  name="access_to_car" id="access_to_car" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="postcode">Postcode</label><input type="text" value = "{{$job_application->postcode}}"  name="postcode" id="postcode" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="cv">Cv</label><input type="file" accept="image/png, image/gif, image/jpeg" value = "{{$job_application->cv}}"  name="cv" id="cv" class="form-control" ></div><div class="form-group">--}}
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Question</th>
                                            <th scope="col">Answer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{$job_application->full_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>{{$job_application->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$job_application->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Job</td>
                                            <td>{{$job_application->job_id}}</td>
                                        </tr>
                                        <tr>
                                            <td>Available Per Week</td>
                                            <td>{{$job_application->no_of_days}} Days</td>
                                        </tr>
                                        <tr>
                                            <td>Drive</td>
                                            @if($job_application->access_to_car == 1)
                                                <td>Yes</td>
                                            @else
                                                <td>No</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Access To Car</td>
                                            @if($job_application->access_to_car == 1)
                                                <td>Yes</td>
                                            @else
                                                <td>No</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Postcode</td>
                                            <td>{{$job_application->postcode}}</td>
                                        </tr>
                                        <tr>
                                            <td>CV</td>
                                            <td><a target="_blank" href="{{asset('uploads/resume/'.$job_application->cv)}}">view</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" >
                                        @if($job_application->status == 0)
                                            <option value="0" selected>Pending</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Rejected</option>
                                        @elseif($job_application->status == 1)
                                            <option value="0">Pending</option>
                                            <option value="1" selected>Approved</option>
                                            <option value="2">Rejected</option>
                                        @elseif($job_application->status == 2)
                                            <option value="0">Pending</option>
                                            <option value="1">Approved</option>
                                            <option value="2" selected>Rejected</option>
                                        @endif
                                    </select>
                                </div>
                            <div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$job_application->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$job_application->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$job_application->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$job_application->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.job_applications') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
