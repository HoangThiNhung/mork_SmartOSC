<!DOCTYPE html>
<html>
  @include('backend.includes.head2')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/LTE/plugins/datatables/dataTables.bootstrap.css')}}">
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      @include('backend.includes.header2')
      @include('backend.includes.sidebar2')
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Tables
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List Order</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>address</th>
                        <th>total</th>
                        <th>status</th>
                        <th>order date</th>
                        <th>ship date</th>
                        <th width="10%">detail</th>
                      </tr>
                    </thead>
                    <tbody>
                    @include ('frontend.includes.format')
                      <?php foreach($order as $row){
                          
                      ?>
                      <tr>
                        <td>
                          {{$row->name}}
                        </td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->phone}}</td>
                        <td>
                          {{$row->address}}
                        </td>
                        <td>{{price_formate($row->total)}} VND</td>
                        <td>
                            @if($row->status==0)
                              <a href="#" style="color:orange"  >Waiting</a>
                            @elseif($row->status==1)
                              <a href="#" style="color:blue">confirmed</a> 
                            @elseif($row->status==2)
                              <a href="#" style="color:green"> Shipped</a>
                            @else
                              <a href="#" style="color:red"> Cancel</a>
                            @endif
                        </td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$row->shipped_date}}</td>
                        <td> <a href="{{route('admin.order.edit',$row->id)}}" >detail</a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      @include('backend.includes.footer2')
      @include('backend.includes.controlbar2')
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('assets/LTE/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('assets/LTE/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('assets/LTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/LTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('assets/LTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/LTE/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/LTE/dist/js/app.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/LTE/dist/js/demo.js')}}"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
