@extends('frontend.layouts.default')
@section('content')
@include('frontend.includes.format')
<div id="all">

    <div id="content">
        <div class="container">

            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a>
                    </li>
                    <li>Shopping cart</li>
                </ul>
            </div>

            <div class="col-md-9" id="basket">

                <div class="box">

                    <?php echo  Form::open(array('url' => URL::to('update-cart'))) ; ?> 

                        <h1>Giỏ hàng</h1>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                            
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
                                 $numberproduct = count($data);
                        ?>
                        <p class="text-muted">Bạn có <em>" <?php echo $numberproduct ?> "</em> sản phẩm trong giỏ hàng</p>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Màu sắc</th>
                                        <th>Size</th>
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
                                            <input type="number" value="{{$showdata['quantity']}}" class="form-control" name="quantity{{$showdata['id']}}">
                                        </td>
                                        <td>    <?php 
                                                    foreach($colors as $col){
                                                        if($col->id==$showdata['color']){
                                                            echo $col->name;
                                                        }
                                                    }
                                                ?>
                                        </td>
                                        <td>
                                                <?php 
                                                    foreach ($sizes as $key) {
                                                        # code...
                                                        if($key->id ==$showdata['size']){
                                                            echo $key->name;
                                                        }
                                                    }
                                                ?>
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
                        <!-- /.table-responsive -->

                        <div class="box-footer">
                            <div class="pull-left">
                                <a href="{{url('/')}}" class="btn btn-default"><i class="fa fa-chevron-left"></i> tiếp tục mua sắm</a>
                            </div>
                            <div class="pull-right">
                                <!-- <button class="btn btn-default" type="submit"><i class="fa fa-refresh"></i> Update basket</button> -->
                                <input type="submit" class="btn btn-default" value="Update basket">
                                <a href="{{url('/checkout')}}" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>

                    <?php echo Form::close() ?>

                </div>
                <!-- /.box -->


                <div class="row same-height-row">
                        <div class="col-md-2 col-sm-6">
                            
                                <div class="box same-height">
                                    <h3 style="color:green">Có thể bạn sẽ thích</h3>
                                </div>
                            
                        </div>
                        <?php foreach($all as $row){
                            $slug = convert_vi_to_en($row->name);
                            ?>
                            <div class="col-md-2 col-sm-6">
                            
                                <div class="product same-height">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                                    <img src="{{asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                                    <img src="{{asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}" class="invisible">
                                        <img src="{{asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                    </a>
                                    <div class="text">
                                    <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                        <h3>{{$row->name}}</h3>
                                    </a>
                                        <p class="price">{{price_formate( $row->price )}} VND</p>
                                    </div>
                                </div>
                                <!-- /.product -->
                            </div>
                            <?php }
                            ?>

                    </div>


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


                <div class="box">
                    <div class="box-header">
                        <h4>Coupon code</h4>
                    </div>
                    <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                    <form>
                        <div class="input-group">

                            <input type="text" class="form-control">

                            <span class="input-group-btn">

    			<button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>

    		    </span>
                        </div>
                        <!-- /input-group -->
                    </form>
                </div>

            </div>
            <!-- /.col-md-3 -->

        </div>
        <!-- /.container -->
    </div>
</div>
@stop