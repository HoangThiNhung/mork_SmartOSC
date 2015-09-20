@extends('frontend.layouts.default')

@section('content')
<!-- slider -->
    @section('title')
        Oreju
    @endsection

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
<!-- -->
<div id="all">

        <div id="content">
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

        @include ('frontend.includes.format')
        <?php
            // foreach($hotPro as $row){
            //     $slug = convert_vi_to_en($row->name);
            // }
        ?>

            <div class="container">
                    <div id="main-slider" style="width:100%">

                    @foreach($slider as $row)
                        <div class="item">
                            <img src="{{asset('upload/slider/'.$row->image)}}" alt="" class="img-responsive" height="100">
                            <!-- <div class="carousel-caption">
                                        <h1>{{$row->tittle}}</h1>
                                        <h2>--- &hearts;&hearts;---</h2>
                                        <h3>{{$row->exception}}</h3>
                                        <h4>{{$row->description}}</h4>
                                        <button class="btn btn-default"><a href="#"> {{$row->btn_name}}</a></button>
                                        <h2>--- &diams; &diams; &diams; ---</h2>
                                        <h3></h3>
                                </div> -->
                        </div>
                    @endforeach
                    </div>
            </div>

            <div id="advantages">

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>

                                <h3><a href="#">We love our customers</a></h3>
                                <p>Chúng tôi luôn cung cấp những sản phẩm và dịch vụ tốt nhất</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>

                                <h3><a href="#">Best prices</a></h3>
                                <p>Với giá cả hợp lý, bạn có thể thoải mái lựa chọn, mua sắm những sản phẩn bạn yêu thích</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>

                                <h3><a href="#">100% satisfaction guaranteed</a></h3>
                                <p>Chính sách đổi trả hàng trong vòng 15 ngày luôn làm hài lòng các khách hàng</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

            <!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>Sản phẩm nổi bật</h2>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="product-slider">

                    <?php foreach($hotPro as $row){
                    $slug = convert_vi_to_en($row->name)
                    ?>
                        

                        <div class="item">
    
                            <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                                    <img src="{{Asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                                    <img src="{{Asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}" class="invisible">
                                        <img src="{{Asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
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
                                    <?php if($row->status){
                                    ?>
                                    
                                        <?php 
                                    }
                                    ?>
                                    <!-- /.text -->
                            
                            </div>
                            <!-- /.product -->
                        </div>
                        <?php 
                        }
                        ?>

                    </div>
                    <!-- /.product-slider -->
                </div>
                <div class="container">
                    <div class="product-slider">

                    <?php foreach($hotman as $row){
                    $slug = convert_vi_to_en($row->name)
                    ?>

                        <div class="item">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                                <img src="{{Asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                                <img src="{{Asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}" class="invisible">
                                    <img src="{{Asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">{{$row->name}}</a></h3>
                                    <p class="price">{{price_formate( $row->price )}} VND</p>
                                    <p class="buttons">
                                        <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <?php if($row->status){
                                ?>
                                
                                    <?php 
                                }
                                ?>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
                        <?php
                    }
                    ?>

                    </div>
                    <!-- /.product-slider -->
                </div>
                <!-- /.container -->

            </div>
            <!-- /#hot -->

            <!-- *** HOT END *** -->

            <!-- *** GET INSPIRED ***
 _________________________________________________________ -->
            <!-- <div class="container" data-animate="fadeInUpBig">
                <div class="col-md-12">
                    <div class="box slideshow">
                        <h3>Get Inspired</h3>
                        <p class="lead">Get the inspiration from our world class designers</p>
                        <div id="get-inspired" class="owl-carousel owl-theme">
                            <div class="item">
                                <a href="#">
                                    <img src="{{asset('/assets/frontend/img/getinspired1.jpg')}}" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="{{asset('/assets/frontend/img/getinspired2.jpg')}}" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="{{asset('/assets/frontend/img/getinspired3.jpg')}}" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- *** GET INSPIRED END *** -->

            <!-- *** BLOG HOMEPAGE ***
 _________________________________________________________ -->

            <div class="box text-center" data-animate="fadeInUp">
                <div class="container">
                    <div class="col-md-12">
                        <h3 class="text-uppercase">Tin tức mới nhất</h3>

                        <p class="lead">Điểm tin thời trang thế giới tuần qua <a href="{{url('news')}}"> Xem ngay!</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="container">

                <div class="col-md-12" data-animate="fadeInUp">

                    <div id="blog-homepage" class="row">
                        <?php 
                            foreach($news as $new){
                                $slug = convert_vi_to_en($new->title);
                        ?>
                        <div class="col-sm-6">
                            <div class="post">
                                <h4><a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}">{{$new->title}}</a></h4>
                                <p class="author-category">By <a href="#">
                                <?php 
                                    foreach ($auth as $author) {
                                        # code...
                                        if($author->id==$new->author_id)
                                            echo $author->name;
                                    }
                                ?></a>
                                </p>
                                <hr>
                                <p class="intro">{{$new->description}}</p>
                                <p class="read-more"><a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}" class="btn btn-primary">Continue reading</a>
                                </p>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                    <!-- /#blog-homepage -->
                </div>
            </div>
            <!-- /.container -->

            <!-- *** BLOG HOMEPAGE END *** -->


        </div>
@stop