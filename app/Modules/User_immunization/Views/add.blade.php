@extends('admin.layout.main')
@section('content')

    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Add Immunization Documents </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user_immunizations') }}">user_immunization</a></li>
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
                    <form role="form" action="{{ route('admin.user_immunizations.store') }}"  method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="imm_id">Immunization</label>
                                <select  name="imm_id" id="imm_id" class="form-control" required>
                                    <option value="" disabled selected>Select A Immunization</option>
                                    @foreach($immunizations as $imm)
                                        <option value="{{$imm->type}}">{{$imm->type}}</option>
                                    @endforeach
                                </select>
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control" style="width: 100%">
                                </select>
                            </div><div class="form-group">
                                <label for="picture">Picture</label><input type="file" name="picture" id="picture" class="form-control" ></div><div class="form-group">
                                <label for="status">Status</label>
                                <select type="text" name="status" id="status" class="form-control" required>
                                    <option value="0">Pending</option>
                                    <option value="1">Approved</option>
                                </select>
                            </div><div class="form-group">
                                <label for="validity">Validity</label><input type="date" name="validity" id="validity" class="form-control" ></div><div class="form-group">
                                <label for="feedback">Feedback</label><textarea name="feedback" id="feedback" class="form-control" ></textarea></div><div class="form-group">
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" name="updated_at" id="updated_at" class="form-control" ></div>--}}
<input type="hidden" name="id" id="id"/>
                        </div>
                        {{ csrf_field() }}
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
        $("#user_id").select2({
            placeholder: "Select User",
            minimumInputLength: 2,
            ajax: {
                url: '{{route('admin.user_comps.get.dcp')}}',
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

        $('#feedback').summernote({
            height: 100
        });
    </script>
@endsection
