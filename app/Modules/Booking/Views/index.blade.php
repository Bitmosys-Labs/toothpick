@extends('admin.layout.main')
@section('content')

<div class="page-content container-fluid">

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
                        return 'Nurse Sent'
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

                // buttons += "<a class='btn btn-sm btn-danger btn-outline' onclick='return confirm(\"are you sure you want to delete this data?\")' href='"+site_url+"/delete/"+data.id+"' ><i class='icon wb-trash' aria-hidden='true'></i></a>&nbsp;&nbsp";

                return buttons;
                }, name:'action',searchable: false},
            ],
        });
    });
</script>
@endsection
