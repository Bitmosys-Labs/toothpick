@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Immunization Documents </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user_immunizations') }}">user_immunization</a></li>
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
                    <form role="form" action="{{ route('admin.user_immunizations.update')}}"  method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                    <h3>Immunization: {{$user_immunization->immunization->type}} </h3>
{{--                                <input type="text" value = "{{$user_immunization->imm_id}}"  name="imm_id" id="imm_id" class="form-control" >--}}
                            </div><div class="form-group">
                                <h3>User: {{$user_immunization->dcp->user->email}} </h3>
{{--                                <input type="text" value = "{{$user_immunization->user_id}}"  name="user_id" id="user_id" class="form-control" >--}}
                            </div><div class="form-group">
                                    <label for="picture">Picture</label><input type="file" value = "{{$user_immunization->picture}}"  name="picture" id="picture" class="form-control" >
                                <a href="{{asset('public/uploads/immunization').'/'.$user_immunization->picture}}" target="_blank"><img src="{{asset('public/uploads/immunization').'/'.$user_immunization->picture}}" width="200" height="200" alt="Identity"></a>

                            </div><div class="form-group">
                                <label for="status">Status</label>
                                <select type="text" name="status" id="status" class="form-control" required>
                                    @if($user_immunization->status == 1)
                                        <option value="0">Pending</option>
                                        <option value="1" selected>Approved</option>
                                    @else
                                        <option value="0" selected>Pending</option>
                                        <option value="1">Approved</option>
                                    @endif
                                </select>
                            </div><div class="form-group">
                                <label for="validity">Validity</label><input type="date" value = "{{$user_immunization->validity}}"  name="validity" id="validity" class="form-control" ></div><div class="form-group">
                                <label for="feedback">Feedback</label><textarea type="text"  name="feedback" id="feedback" class="form-control" >{!! $user_immunization->feedback !!}</textarea></div><div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$user_immunization->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$user_immunization->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$user_immunization->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id" value = "{{$user_immunization->id}}" />
                            {{ csrf_field() }}
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.user_immunizations') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#feedback').summernote({
            height: 100
        });
    </script>
@endsection
