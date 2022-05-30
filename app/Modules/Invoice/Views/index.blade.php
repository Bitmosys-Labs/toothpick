@extends('admin.layout.main')
@section('content')

<div class="page-content container-fluid">

	<div class="page-header">
        <h1 class="page-title">Invoices</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Invoices</a></li>
        </ol>
        <div class="page-header-actions">

            <a href="{{ route('admin.invoices.create') }}"  class="btn btn-sm btn-primary btn-outline btn-round"  title="create">
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
                <table style="width: 100% !important" id="invoice-datatable" class="table table-hover dataTable table-striped">
                    <thead>
                        <tr>
{{--                            <th>SN</th>--}}
{{--							<th >Deleted_at</th>--}}
<th >No</th>
<th >Practice_id</th>
<th >Issue_date</th>
<th >Due_date</th>
<th >Total</th>
{{--<th >Remarks</th>--}}
<th >Status</th>
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
        dataTable = $('#invoice-datatable').DataTable({
        dom: 'Bfrtip',
        "serverSide": true,
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'ajax' : { url: "{{ route('admin.invoices.getdatajson') }}",type: 'POST', data: {'_token': '{{ csrf_token() }}' } },

            columns: [
                // { data: function (data, type, row, meta) {
                //     return meta.row + meta.settings._iDisplayStart + 1;
                // }, name: "sn", searchable: false },
                // { data: "deleted_at",name: "deleted_at"},
                { data: "slug",name: "slug"},
                { data: function(data){
                    return data.name
                    },name: "users.name"},
                { data: "issue_date",name: "invoice.issue_date"},
                { data: "due_date",name: "invoice.due_date"},
                { data: "total",name: "invoice.total"},
                // { data: "remarks",name: "remarks"},
                { data: function (data){
                    if(data.status == 0){
                        return "Pending";
                    }else if(data.status == 1){
                        return "Paid";
                    }else{
                        return "Undefined";
                    }
                    },name: "status", searchable: false},
                // { data: "created_at",name: "created_at"},{ data: "updated_at",name: "updated_at"},

                { data: function(data,b,c,table) {
                var buttons = '';

                buttons += "<a class='btn btn-sm btn-success btn-outline'  title='Edit' href='"+site_url+"/edit/"+data.id+"'><i class='icon wb-pencil' aria-hidden='true'></i></a>&nbsp;&nbsp";

                buttons += "<a class='btn btn-sm btn-danger btn-outline' onclick='return confirm(\"are you sure you want to delete this data?\")' href='"+site_url+"/delete/"+data.id+"' ><i class='icon wb-trash' aria-hidden='true'></i></a>&nbsp;&nbsp";

                return buttons;
                }, name:'action',searchable: false},
            ],
        });
    });
</script>
@endsection
