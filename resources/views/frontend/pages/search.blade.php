@extends('frontend.layouts.default')
@section('content')
@include('frontend.includes.format')
    @section('title')
        tìm kiếm
    @endsection

<div id="all">
        <?php
            $key = $_GET['keyword'];
        ?>

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Tìm kiếm</li>
                    </ul>
                </div>

               

                <div class="col-md-10">
                    <div class="box">
                        <h1>Kết quả tìm kiếm từ khóa <em>"<?php echo $key ?>"</em></h1>
                    </div>

                    <div class="row products">
                    <?php foreach($data as $row){
                        $slug = convert_vi_to_en($row->name);

                        ?>
                        <div class="col-md-4 col-sm-6">

                            <div class="product">
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
                                    <img src="{{asset('upload/product/'.$row->image)}}                                                                                                                                                                                                                                                                                                                                        " alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">{{$row->name}}</a></h3>
                                    <p class="price">{{price_formate( $row->price )}} VND</p>
                                    <form class="form-horizontal" action="{{asset('add-cart/'.$row->id.'/1.html')}}">
                                        <input type="hidden" value="0" name="color">
                                        <input type="hidden" value="0" name="size">
                                        <center><button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button></center><br>
                                    </form>
                                </div>
                                <!-- /.text -->
                                <?php if($row->status){
                            
                            ?>
                                <!-- <div class="ribbon sale">
                                    <div class="theribbon">{{$row->status}}</div>
                                    <div class="ribbon-background"></div>
                                </div> -->
                            <?php 
                                }
                            ?>
                            
                            </div>
                            <!-- /.product -->
                        
                        </div>
                    <?php } ?>
                    </div>

                <center>{!! $data->render() !!}</center>
                </div>
                <!-- /.col-md-10 -->
                 <div class="col-md-2">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    @include('frontend.includes.sidebar')

                    <!-- *** MENUS AND FILTERS END *** -->

                </div>
            </div>
            <!-- /.container -->
        </div>
@stop