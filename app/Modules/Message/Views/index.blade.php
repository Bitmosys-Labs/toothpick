@extends('admin.layout.main')
@section('content')

<div class="page-content container-fluid">

	<div class="page-header">
        <h1 class="page-title">Messages</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Messages</a></li>
        </ol>
        <div class="page-header-actions">

            <a href="{{ route('admin.messages.create') }}"  class="btn btn-sm btn-primary btn-outline btn-round"  title="create">
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
                <table style="width: 100% !important" id="message-datatable" class="table table-hover dataTable table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
							<th >Full_name</th>
<th >Email</th>
<th >subject</th>
{{--<th >Status</th>--}}
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
        dataTable = $('#message-datatable').DataTable({
        dom: 'Bfrtip',
        "serverSide": true,
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'ajax' : { url: "{{ route('admin.messages.getdatajson') }}",type: 'POST', data: {'_token': '{{ csrf_token() }}' } },

            columns: [
                { data: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },name: "sn", searchable: false },
                { data: "full_name",name: "full_name"},{ data: "email",name: "email"},{ data: "subject",name: "subject"},
                // { data: "status",name: "status"},
                // { data: "deleted_at",name: "deleted_at"},{ data: "created_at",name: "created_at"},{ data: "updated_at",name: "updated_at"},

                { data: function(data,b,c,table) {
                var buttons = '';

                // buttons += "<a class='btn btn-sm btn-success btn-outline'  title='Edit' href='"+site_url+"/edit/"+data.id+"'><i class='icon wb-pencil' aria-hidden='true'></i></a>&nbsp;&nbsp";
                buttons += "<a class='btn btn-sm btn-success btn-outline'  title='View' href='"+site_url+"/edit/"+data.id+"'><i class='icon wb-eye' aria-hidden='true'></i></a>&nbsp;&nbsp";
                if(data['status'] == 1)
                {
                    buttons += "<a class='btn btn-sm btn-primary btn-outline'  title='Mark Not Read' href='"+site_url+"/toggle/"+data.id+"'><i class='fa fa-envelope-open' aria-hidden='true'></i></a>&nbsp;&nbsp";
                }else{
                    buttons += "<a class='btn btn-sm btn-danger btn-outline'  title='Mark Read' href='"+site_url+"/toggle/"+data.id+"'><i class='fa fa-envelope' aria-hidden='true'></i></a>&nbsp;&nbsp";
                }
                // buttons += "<a class='btn btn-sm btn-danger btn-outline' onclick='return confirm(\"are you sure you want to delete this data?\")' href='"+site_url+"/delete/"+data.id+"' ><i class='icon wb-trash' aria-hidden='true'></i></a>&nbsp;&nbsp";

                return buttons;
                }, name:'action',searchable: false},
            ],
        });
    });
</script>
@endsection
