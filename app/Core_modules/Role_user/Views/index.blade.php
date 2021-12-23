@extends('admin.layout.main')
@section('content')
	<section class="content-header">
		<h1>
			Role_users		
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Role_users</a></li>

		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<a href="{{ route('admin.role_users.create') }}" class="btn bg-green waves-effect"  title="create">Create</a>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="role_user-datatable" class="table table-striped table-bordered">
							<thead>
								<th>SN</th>
								<th >User_id</th>
<th >Role_id</th>

								<th>Action</th>
							</thead>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<script language="javascript" type="text/javascript">
		var dataTable; 
		var site_url = window.location.href;
		$(function(){
			dataTable = $('#role_user-datatable').DataTable({
				dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
		      	"<'row'<'col-sm-12'tr>>" +
		      	"<'row'<'col-sm-4'i><'col-sm-8 text-right'p>>",
		      	serverSide: true,
		      	processing: true,
	      		'ajax' : { url: "{{ route('admin.role_users.getdatajson') }}",type: 'POST', data: {'_token': '{{ csrf_token() }}' } },
				columns: [
					{ data: function (data, type, row, meta) {
				        return meta.row + meta.settings._iDisplayStart + 1;
			      	},name: "sn", searchable: false },
					{ data: "user_id",name: "user_id"},
            { data: "role_id",name: "role_id"},
            
					{ data: function(data,b,c,table) { 
					var buttons = '';

					buttons += "<a class='btn bg-red waves-effect' href='"+site_url+"/edit/"+data.id+"' type='button' >Edit</a>&nbsp"; 

					buttons += "<a href='"+site_url+"/delete/"+data.id+"' class='btn bg-red waves-effect' >Delete</a>";

					return buttons;
					}, name:'action',searchable: false},
				]
			});
		});

		
	</script>
@endsection
