@extends('admin.layout.main')
@section('content')
<div class="page-content container-fluid">

  <div class="page-header">
      <div class="content">
          <div class="page-title">
            <div class="title_left">
              <h3>Generate Modules</h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">

                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
              <form id="generate-module-form" method="post">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                            <h2>Table Lists</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                  <div class="col-md-2">
                                      <label for="">Prefix</label>
                                  </div>
                                  <div class="col-md-10">
                                      <input id="prefix" class="form-control" type="text" name="prefix" >
                                  </div>
                            </div>
                            <hr>
                            <hr>
                            <hr>
                            <div class="row">
                                @foreach($tables as $table)
                                    <div class="col-md-4">
                                        <input id="table-{{ $table->$db_name}}" type="radio" name="table_check" value="{{ $table->$db_name}}">
                                        <label for="table-{{ $table->$db_name}}">{{ $table->$db_name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="x_content">
                            <div class="row">
                                <button type="button" onclick="generate()" class="btn btn-success btn-flat">Generate</button>
                            </div>
                        </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
  <div class="page-header">

      <div class="content" id="result-row" hidden>
          <div class="row">
              <div class="col-md-12" >
                  <div class="x_panel">
                      <div class="x_title" id="results">
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
    <script type="text/javascript">
        function generate()
        {
            $.ajax({
              url:"{{ route('tool.generate') }}",
              type:'post',
              data:$('#generate-module-form').serialize(),
              dataType:'html',
              success:function(data){
                $('#result-row').show();
                $('#results').html(data);
              }
            });

            return false;
        }
    </script>
@endsection
