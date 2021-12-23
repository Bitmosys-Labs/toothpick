@extends('admin.layout.main')
@section('content')
    <div class="page-content container-fluid">

        <div class="page-header">
            <h1 class="page-title">Roles</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Role</a></li>
            </ol>
            <div class="page-header-actions">

                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary btn-outline btn-round" title="create">
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
                    <table style="width: 100% !important" id="role-datatable"
                           class="table table-hover dataTable table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
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


    <script language="javascript" type="text/javascript">
        var dataTable;
        var site_url = window.location.href;
        var role_url = '{{ route('admin.assign_permission.edit','id') }}';
        $(function () {

            dataTable = $('#role-datatable').DataTable({
                dom: 'Bfrtip',
                // scrollX: true,
                "serverSide": true,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                'ajax': {
                    url: "{{ route('admin.roles.getdatajson') }}",
                    type: 'POST',
                    data: {'_token': '{{ csrf_token() }}'}
                },

                columns: [
                    {
                        data: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }, name: "sn", searchable: false
                    },
                    {data: "name", name: "name"},
                    {data: "created_at", name: "created_at"},
                    {data: "updated_at", name: "updated_at"},

                    {
                        data: function (data, b, c, table) {
                            var buttons = '';
                            if (data.id != 1) {
                                buttons += "<a class='btn btn-sm btn-success btn-outline' href='" + site_url + "/edit/" + data.id + "' type='button' ><i class='icon wb-pencil' aria-hidden='true'></i></a>&nbsp";

                                buttons += "<a href='" + site_url + "/delete/" + data.id + "' class='btn btn-sm btn-danger btn-outline'  title='Delete' ><i class='icon wb-trash' aria-hidden='true'></i></a>&nbsp";

                                buttons += "<a  href='" + role_url.replace('id',data.id) + "' class='btn btn-sm btn-warning btn-outline'  title='Assign Permission' ><i class=' icon wb-link-intact' aria-hidden='true'></i></a>&nbsp";
                            }

                            return buttons;
                        }, name: 'action', searchable: false
                    },
                ],
            });
        });
    </script>
@endsection
