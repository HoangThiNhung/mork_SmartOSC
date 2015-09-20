@extends('backend.layouts.admin')
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      General Form Elements
      <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>
  </section>
  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h2 class="box-title">Order Detail</h2>
        </div><!-- /.box-header -->
        <!-- form start -->
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                        <tr>
                            <td>ID Order :</td>
                            <td><?php echo $order->id; ?></td>
                        </tr>
                        <tr>
                            <td>Name :</td>
                            <td><?php echo $order->name; ?></td>
                        </tr>
                        <tr>
                            <td>Email :</td>
                            <td><?php echo $order->email; ?></td>
                        </tr>
                        <tr>
                            <td> Phone :</td>
                            <td><?php echo $order->phone; ?></td>
                        </tr>
                        <tr>
                            <td>Address :</td>
                            <td><?php echo $order->address; ?></td>
                        </tr>
                        {!! Form::model($order,['method' => 'PATCH','route'=>['admin.order.update',$order->id],'class'=>'form-horizontal']) !!}
                        <tr>
                            <td>Status :</td>
                            <td>
                                
                                <?php $new=$confirm=$cancel=$final=""; ?>
                                @if($order->status == 0)
                                    <?php $new="selected"; ?>
                                @elseif($order->status == 1)
                                  <?php $confirm="selected";?>
                                @elseif($order->status==2)</a>
                                    <?php $final="selected"; ?>
                                @else
                                    <?php $cancel="selected"; ?>
                                @endif
                                <select name="status">
                                    <option <?php echo $new; ?> value="0">Waiting</option>
                                    <option <?php echo $confirm; ?> value="1">Confirmed</option>
                                    <option <?php echo $final; ?> value="2">Shipped</option>
                                    <option <?php echo $cancel; ?> value="3">Cancel</option>
                                </select> 
                                                             
                            </td>
                        </tr>
                        <tr>
                            <td>Shipped Date</td>
                            <td><input type="date" value="<?php echo $order->shipped_date?>" name="shipped_date"></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td> {!!  Form::submit('Submit',['class'=>'btn btn-warning']) !!}
                                {!! Form::close() !!}  
                          </td>
                        </tr>
                    </table>

                    <h5><b>List Product</b></h5>
                    <table class="table table-striped table-bordered table-hover dataTable no-footer">
                        <tr>
                            <th>ID Product</th>
                            <th>Name Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>SUB Total</th>

                        </tr>
                        <?php $totalprice = 0; ?>
                        @foreach($detail as $showdata)
                        <tr>
                            <td><?php echo $showdata->product_id; ?></td>
                            <td>
                                 <?php  echo $showdata->name; ?></td>
                            <td><?php echo $showdata->quantity; ?></td>
                            <td><?php echo $showdata->price; ?> VND</td>
                            <td><?php 
                            if($showdata->color_id==0)
                              echo "N/A";
                            foreach ($color as $key) {
                              # code...
                              if ($key->id==$showdata->color_id) 
                              
                                  echo $key->name;
                              
                                # code...
                              
                            }?></td>
                            <td><?php 
                            if($showdata->size_id==0)
                              echo "N/A";
                            foreach ($size as $key) {
                              if ($key->id==$showdata->size_id) {

                                  echo $key->name;
                              }
                            } ?></td>
                            <td><?php echo $showdata->price*$showdata->quantity; ?> VND</td>
                            <?php $totalprice = $totalprice + $showdata->price*$showdata->quantity; ?>                        
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="7">
                                <p class="text-right"><b>Sub Total : <?php echo $totalprice; ?> VNĐ</b></p>
                                <p class="text-right"><b>Shipping : <?php echo "20000" ?> VNĐ</b></p>
                                <p class="text-right" style="color:red; font-size:24px;"><b>Total : <?php echo $totalprice+20000; ?> VNĐ</b></p>
                            </td>
                        </tr>
                    </table>
            </div><!-- /.box-body -->
      </div>
  </section>
</div>
@stop