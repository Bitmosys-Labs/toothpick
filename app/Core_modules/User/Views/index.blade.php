@extends('admin.layout.main')
@section('content')
<div class="page-content container-fluid">

	<div class="page-header">
        <h1 class="page-title">Users</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Users</a></li>
        </ol>
        <div class="page-header-actions">

            <a href="javascript::void(0)" id="create-user-button" class="btn btn-sm btn-primary btn-outline btn-round"  title="create">
                <i class="icon wb-plus" aria-hidden="true"></i>
                <span class="hidden-sm-down">Create</span>
            </a>

        </div>
    </div>
    <!-- Main content -->
    <div class="panel">
        <header class="panel-heading">
        </header>
        <div class="panel-body">
            <div class="table-responsive">
                <table style="width: 100% !important" id="user-datatable" class="table table-hover dataTable table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Roles</th>

                            <!-- <th >Is Banned</th> -->
                            <!-- <th >Last Login</th> -->
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
<div id="user-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add/Edit Users</h4>
            </div>
            <div class="modal-body">
                <form id ='form-users'>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" >
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" >
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" >
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" >
                        @if ($errors->has('confirm_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Role</label>
                        <select class="form-control" name="roles">
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
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
<script type="text/javascript">
    $(document).on('click','#create-user-button', function () {
        $('#user-modal').modal('show');
    });

    var dataTable;
    $(function(){
        dataTable = $('#user-datatable').DataTable({
            dom: 'Bfrtip',
            // scrollX: true,
            "serverSide": true,
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ],
      		'ajax' : { url: "{{ route('admin.users.getdatajson') }}",type: 'POST', data: {'_token': '{{ csrf_token() }}' } },

                columns: [
                    { data: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },name: "id", searchable: false },
                    { data: "name",name: "name"},
                    { data: "username",name: "username"},
                    { data: "email",name: "email"},
                    { data: "roles",name: "roles"},
                    // { data: function (data, type, row, meta) {
                    //     a = '';
                    //     if(data.banned == 0){
                    //         a = '<input type="checkbox"  disabled>';
                    //     }else{
                    //         a = '<input type="checkbox" checked disabled>';
                    //     }
                    //     return a;
                    // },name: "banned", searchable: false },
                    // { data: "ip_address",name: "ip_address"},

                    { data: function(data,b,c,table) {
                        var buttons = '';
                        console.log(data.login_attempts);
                        if(data.id == 1001 || data.id == 1002){

                        }else{
                            buttons += "<a href='javascript::void(0)' data-toggle='modal' data-target='#user-modal' class='btn btn-sm btn-success btn-outline'  title='Edit' onclick='edit("+table.row+")'><i class='icon wb-pencil' aria-hidden='true'></i></a>&nbsp;&nbsp";

                            buttons += "<a onclick='removedemo("+data.id+")' href='javascript::void(0)' class='btn btn-sm btn-danger btn-outline'  title='Delete' ><i class='icon wb-trash' aria-hidden='true'></i></a>&nbsp;&nbsp";

                            // buttons += "<a target='_blank' href=''  class='btn btn-sm btn-warning btn-outline'  title='Assign User Permission' ><i class=' icon wb-link-intact' aria-hidden='true'></i></a>&nbsp;&nbsp";

                            // if (data.banned == true) {
                            //     buttons += '<a href="javascript:void(0)" onclick="toggleUser(' + table.row + ', \'UNLOCK\'); return false;" title="Unban/Unlock User" class="btn btn-sm btn-default btn-outline"><i class="icon wb-unlock"></i></a>&nbsp;&nbsp';
                            // } else {
                            //      buttons += '<a href="javascript:void(0)" onclick="toggleUser(' + table.row + ',  \'LOCK\'); return false;" title="Ban/Lock User" class="btn btn-sm btn-default btn-outline"><i class="icon wb-lock"></i></a>&nbsp;&nbsp';
                            // }

                            // if (data.login_attempts >= 4) {
                            //      resetLogin = '<a href="javascript:void(0)" onclick="resetLoginAttempts(' + table.row + '); return false;" title="Reset Login Attemps" class="btn btn-sm btn-default btn-outline"><i class="icon wb-loop"></i></a>';
                            //  }

                        }


                        return buttons;
                    }, name:'action',searchable: false},
                ],
            });
    });

    function edit(index){
        var row = dataTable.row(index).data();

        $('#id').val(row.id);
        $("#form-users").find('input:checkbox').prop('checked',false);
        $("#form-users").find('input:text,select,textarea').val(function(i,v){

            /*if(row.gender == 'M')
            {
                $('input:radio[name=gender][id=radio_1]').prop('checked',true);
            }else{
                $('input:radio[name=gender][id=radio_2]').prop('checked',true);
            }*/
            return row[this.name];
        });
        // $('select').selectpicker('render');


    }


    function save()
    {
        $.ajax({
            url: "{{ route('admin.users.store') }}",
            data: $('#form-users').serialize(),
            dataType: 'json',
            success: function(result){
                if(result.success)
                {
                    $('#user-modal').modal('hide');
                    $('#form-users')[0].reset();
                    dataTable.ajax.reload( null, false );
                }
            },
            type: 'POST'
        });
    }

    // function toggleUser(index, toggle) {

    //     if( confirm("Are you sure to " + toggle + " this user ?") == true) {
    //         var row = dataTable.row(index).data();
    //         // var row =  $("#jqxGridUser").jqxGrid('getrowdata', index);

    //         if (row) {
    //             $.ajax({
    //                type: 'POST',
    //                data: {id: row.id, toggle: toggle },
    //                 success: function (result) {
    //                     var result = eval('('+result+')');
    //                     if (result.success) {
    //                         dataTable.ajax.reload( null, false );

    //                     }
    //                 },
    //                 error: function(result) {
    //                     return commit(false);
    //                 }
    //             });
    //        }
    //    }
    // }


</script>
@endsection
