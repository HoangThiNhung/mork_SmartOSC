@extends('frontend.layouts.default')
@section('content')
@include('frontend.includes.format')
    @section('title')
        Checkout
    @endsection
<div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Checkout - Address</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="{{url('addOrder')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h1>Checkout</h1>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            <?php 
                            $data = Session::get('cart');
                            $total = 0;
                            if(!is_null($data)){
                                $num = count($data);
                            }
                            foreach($data as $showdata){
                                $total=$total + $showdata['price']*$showdata['quantity'];
                            }
                            ?>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a data-toggle="tab" href="#customer"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li><a data-toggle="tab" href="#order"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="customer" class="tab-pane fade active in">
                                    <div class="content">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Họ và tên</label>
                                                    <input type="text" class="form-control" id="name" name="name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="phone">Số điện thoại</label>
                                                    <input type="text" class="form-control" id="phone" name="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="address">Địa chỉ</label>
                                                    <input type="text" class="form-control" id="address" name="address">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">email</label>
                                                    <input type="text" class="form-control" id="email" name="email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="ship">Ship</label>
                                                    <input type="text" class="form-control" id="ship" name="ship" value="20000" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="total">Giá trị đơn hàng</label>
                                                    <input type="text" class="form-control" id="total" name="total" value="{{$total+20000}}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="box-footer">
                                            <div class="pull-left">
                                                <a href="{{url('cart')}}" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
                                            </div>
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-primary">Checkout<i class="fa fa-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>   
                                </div>

                                <div id="order" class="tab-pane fade">
                                    <div class="content">
                                        <?php 
                                            $data = Session::get('cart');
                                            $total = 0;
                                            if(!is_null($data)){
                                                 $numberproduct = count($data);
                                        ?>
            
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">Sản phẩm</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn Giá</th>
                                                        <th>Giảm giá</th>
                                                        <th colspan="2">Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $showdata)
                                                    <?php
                                                        $slug = convert_vi_to_en($showdata['name']);
                                                    ?> 
                                                    <tr>
                                                        <td>
                                                            <a href="{{url('product-details/'.$showdata['id'].'-product-'.$slug.'.html')}}">
                                                                <img src="{{asset('upload/product/'.$showdata['thumbnail'])}}" alt="{{$showdata['name']}}">
                                                            </a>
                                                        </td>
                                                        <td><a href="{{url('product-details/'.$showdata['id'].'-product-'.$slug.'.html')}}">{{$showdata['name']}}</a>
                                                        </td>
                                                        <td>
                                                            <input type="number" value="{{$showdata['quantity']}}" class="form-control">
                                                        </td>
                                                        <td><?php echo number_format($showdata['price']) ?> VNĐ</td>
                                                        <td>0 VNĐ</td>
                                                        <td><?php echo number_format($showdata['price'] * $showdata['quantity'] ) ?><span> VNĐ</span></td>
                                                        <td><a href="{{url('delete-cart/'.$showdata['id'].'.html')}}"><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                        <?php $total = $total + $showdata['price']*$showdata['quantity'] ?>
                                                    </tr>
                                                @endforeach  
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="5">Đơn hàng</th>
                                                        <th colspan="2"><?php echo number_format($total); ?> VNĐ</th>

                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                        <?php } ?>
                                        <div class="box-footer">
                                            <div class="pull-left">
                                                <a href="{{url('cart')}}" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
                                            </div>
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-primary">Checkout<i class="fa fa-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Tóm tắt đơn hàng</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Giá trị đơn hàng</td>
                                        <th><?php echo number_format($total); ?> VNĐ</th>
                                    </tr>
                                    <tr>
                                        <td>Phí ship</td>
                                        <th><?php echo number_format(20000) ?> VND</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Tổng</td>
                                        <th><?php 
                                        $all = $total + 20000;
                                        echo number_format($all)
                                        ?> VND</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
    </div>
@stop
