@extends('admin.layout.main')
@section('content')
    <!-- CSS only -->
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">--}}
{{--    <!-- JavaScript Bundle with Popper -->--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>--}}
<div class="page-content container-fluid">
    <div id="assign-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Assign Nurse</h4>
                </div>
                <div class="modal-body">
                    <form id ='form-users'>

{{--                        <div class="form-group">--}}
{{--                            <label for="username">Username</label>--}}
{{--                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" >--}}

{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="email">Email</label>--}}
{{--                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" >--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="password">Password</label>--}}
{{--                            <input type="password" name="password" id="password" class="form-control" >--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="confirm_password">Confirm Password</label>--}}
{{--                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" >--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="confirm_password">Role</label>--}}
{{--                            <select class="form-control" name="roles">--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <input type="hidden" name="id" id="id"/>
                        {{ csrf_field() }}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-green waves-effect" onClick="save()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
	<div class="page-header">
        <h1 class="page-title">Bookings</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Bookings</a></li>
        </ol>
        <div class="page-header-actions">

            <a href="{{ route('admin.bookings.create') }}"  class="btn btn-sm btn-primary btn-outline btn-round"  title="create">
                <i class="icon wb-plus" aria-hidden="true"></i>
                <span class="hidden-sm-down">Create</span>
            </a>

        </div>
    </div>

    <div class="panel">
        <header class="panel-heading">
        </header>
        <div class="panel-body">
            <div class="table-responsive">
                <table style="width: 100% !important" id="booking-datatable" class="table table-hover dataTable table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
							<th >Practice_id</th>
<th >Staff_id</th>
<th >Date</th>
{{--<th >Slug</th>--}}
{{--<th >Date</th>--}}
{{--<th >From</th>--}}
{{--<th >To</th>--}}
{{--<th >Hourly_rate</th>--}}
{{--<th >Parking</th>--}}
{{--<th >Additional</th>--}}
<th >Status</th>
{{--<th >Deleted_at</th>--}}
{{--<th >Created_at</th>--}}
{{--<th >Updated_at</th>--}}

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>

                </table>
            </div>
                    <!-- /.box-body -->
        </div>
                <!-- /.box -->
    </div>
</div>


<script>
    var dataTable;
    var site_url = window.location.href;

    $(function(){
        dataTable = $('#booking-datatable').DataTable({
        dom: 'Bfrtip',
        "serverSide": true,
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'ajax' : { url: "{{ route('admin.bookings.getdatajson') }}",type: 'POST', data: {'_token': '{{ csrf_token() }}' } },

            columns: [
                { data: function (data, type, row, meta) {
                    return data.slug
                },name: "booking.slug"},
                { data: function(data){
                    return data.name;
                    },name: "users.name"},
                { data: function(data){
                    return data.type
                    },name: "staff.type"},
                { data: function(data){
                        return data.date
                    },name: "booking.date"},
                // { data: "slug",name: "slug"},{ data: "date",name: "date"},{ data: "from",name: "from"},{ data: "to",name: "to"},{ data: "hourly_rate",name: "hourly_rate"},{ data: "parking",name: "parking"},{ data: "additional",name: "additional"},
                { data: function(data){
                    if(data.status == 0){
                        return 'Pending'
                    }
                    else if(data.status == 1){
                        return 'Assigned'
                    }
                    else if(data.status == 2){
                        return 'Confirmed'
                    }
                    else if(data.status == 3){
                        return 'Completed'
                    }
                    else if(data.status == 4){
                        return 'Canceled'
                    }
                    },name: "status", searchable: false},
                // { data: "deleted_at",name: "deleted_at"},{ data: "created_at",name: "created_at"},{ data: "updated_at",name: "updated_at"},
                { data: function(data,b,c,table) {
                var buttons = '';
                buttons += "<a class='btn btn-sm btn-success btn-outline'  title='Edit' href='"+site_url+"/edit/"+data.id+"'><i class='icon wb-pencil' aria-hidden='true'></i></a>&nbsp;&nbsp";
                // if(data.status == 1 || data.status == 2){
                //     buttons += "<button class='btn btn-sm btn-success btn-outline'  title='Assign' onclick='buttonClick("+data.id+")'><i class='fa fa-user' aria-hidden='true'></i></button>&nbsp;&nbsp";
                // }

                // buttons += "<a class='btn btn-sm btn-danger btn-outline' onclick='return confirm(\"are you sure you want to delete this data?\")' href='"+site_url+"/delete/"+data.id+"' ><i class='icon wb-trash' aria-hidden='true'></i></a>&nbsp;&nbsp";

                return buttons;
                }, name:'action',searchable: false},
            ],
        });
    });
</script>

<script>
    function buttonClick(id) {
        $.ajax({
            type:'GET',
            url:'{{route('admin.booking.getNurse')}}',
            dataType: "json",
            async: false,
            data:{
                id: id,
            },
            success:function(data) {
                console.log(data);
                outputTags = '<div class="form-group">  <div class="container"> <div class="row"> <div class="col-sm-3"> <label for="fulltime">Full Time </label><br><input type="checkbox" name="fulltime" value="check" id="fulltime"> </div> <div class="col-sm-3"> <label for="parttime">Part Time </label><br><input type="checkbox" name="parttime" value="check" id="parttime"> </div> </div> </div> <select name="nurse" id="nurse" class="form-control" style="width: 100%"> <option value="'+ data.user_id +'" selected>'+ data.user_name +'</option> </select> </div>';
                $("#form-users").append(outputTags);
            }
        });
        $("#nurse").select2({
            placeholder: "Select Nurse",
            minimumInputLength: 0,
            ajax: {
                url: '{{route('admin.booking.assignNurse')}}',
                dataType: 'json',
                type: "GET",
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term, full_time: $('input[name="fulltime"]:checked').val(), part_time: $('input[name="parttime"]:checked').val(), booking_date: $('input[name="bookingdate"]:checked').val(),
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
        $('#assign-modal').modal('show');
    }
    // $(document).on('click','#create-user-button', function () {
    //     $('#user-modal').modal('show');
    // });

    {{--$(document).ready(function(){--}}
    {{--    $("#nurse").select2({--}}
    {{--        placeholder: "Select Nurse",--}}
    {{--        minimumInputLength: 0,--}}
    {{--        ajax: {--}}
    {{--            url: '{{route('admin.booking.assignNurse')}}',--}}
    {{--            dataType: 'json',--}}
    {{--            type: "GET",--}}
    {{--            delay: 250,--}}
    {{--            data: function (params) {--}}
    {{--                return {--}}
    {{--                    searchTerm: params.term, full_time: $('input[name="fulltime"]:checked').val(), part_time: $('input[name="parttime"]:checked').val(), booking_date: $('input[name="bookingdate"]:checked').val(),--}}
    {{--                };--}}
    {{--            },--}}
    {{--            processResults: function (response) {--}}
    {{--                return {--}}
    {{--                    results: response--}}
    {{--                };--}}
    {{--            },--}}
    {{--            cache: true--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}
</script>
@endsection
