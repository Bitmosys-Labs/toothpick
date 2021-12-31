@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Messages </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.messages') }}">message</a></li>
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
{{--                    <form role="form" action="{{ route('admin.messages.update') }}"  method="post">--}}
{{--                        <div class="box-body">--}}
{{--                            {{method_field('PATCH')}}--}}
{{--                            <div class="form-group">--}}
{{--                                    <label for="full_name">Full_name</label><input type="text" value = "{{$message->full_name}}"  name="full_name" id="full_name" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="email">Email</label><input type="text" value = "{{$message->email}}"  name="email" id="email" class="form-control" ></div><div class="form-group">--}}
{{--                                <label for="message">Message</label><textarea type="text"  name="message" id="message" class="form-control" >{{$message->message}}</textarea></div><div class="form-group">--}}
{{--                                    <label for="status">Status</label><input type="text" value = "{{$message->status}}"  name="status" id="status" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="deleted_at">Deleted_at</label><input type="text" value = "{{$message->deleted_at}}"  name="deleted_at" id="deleted_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="created_at">Created_at</label><input type="text" value = "{{$message->created_at}}"  name="created_at" id="created_at" class="form-control" ></div><div class="form-group">--}}
{{--                                    <label for="updated_at">Updated_at</label><input type="text" value = "{{$message->updated_at}}"  name="updated_at" id="updated_at" class="form-control" ></div>--}}
{{--<input type="hidden" name="id" id="id" value = "{{$message->id}}" />--}}
{{--                            {{ csrf_field() }}--}}
{{--                        </div>--}}
{{--                        <div class="box-footer">--}}
{{--                            <button type="submit" class="btn btn-primary">Save</button>--}}
{{--                            <a href="{{ route('admin.messages') }}" class="btn btn-danger">Cancel</a>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                    <h2>Subject: {{$message->subject}}</h2>
                    <h4>Email: {{$message->email}}</h4>
                    <h4>Name: {{$message->full_name}}</h4><br>
                    <h5>Message:</h5>
                    {{$message->message}}<br><br>
                    <a type="button" class="btn btn-primary" href="#" id="replyButton">
                        Reply <i class="fa fa-mail-reply"></i>
                    </a>
                    <form role="form" action="{{route('admin.messages.reply', $message->id)}}"  method="post" id="replyForm">
                        <br>
                        @csrf
                        <div class="form-group">
                            <label for="message">Reply</label>
                            <textarea type="text"  name="reply" id="reply" rows="5" class="form-control" ></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Send</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#reply').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
            ],
        });
        $('#replyForm').hide();
        $("#replyButton").click(function(){
            $('#replyForm').show();
        });
    </script>
@endsection
