@extends('frontend.layouts.default')
@section('content')
@include('frontend.includes.format')

    @section('title')
        <?php 
            foreach($cat as $row){
                if($id==$row->id){
                    echo $row->name;
                }
            }
        ?>
    @endsection
<div id="all">
        <?php
            // foreach($category as $row){
            //     $slug = convert_vi_to_en($row->name);
            // }
        ?>

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>
                            <?php 
                                foreach($cat as $row){
                                    if($id==$row->id){
                                        echo $row->name;
                                    }
                                }
                            ?>
                        </li>
                    </ul>
                </div>

                

                <div class="col-md-10">
<!--                     <div class="box">
                        <h1>Ladies</h1>
                        <p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p>
                    </div> -->

                    <!-- <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing <strong>12</strong> of <strong>25</strong> products
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-number">
                                                <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">12</a>  <a href="#" class="btn btn-default btn-sm">24</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <strong>Sort by</strong>
                                                <select name="sort-by" class="form-control">
                                                    <option>Price</option>
                                                    <option>Name</option>
                                                    <option>Sales first</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->


                    <div class="row products">
                    <?php foreach($category as $row){
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
                                
                            <?php 
                                }
                            ?>
                            
                            </div>
                            <!-- /.product -->
                        
                        </div>
                        <?php
                    }
                    ?>
                    </div>

                <center>{!! $category->render() !!}</center>
                </div>
                <!-- /.col-md-9 -->
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