@extends('frontend.layouts.default')
@section('content')
@include('frontend.includes.format')
    @section('title')
        {{$product->name}}

    @endsection
<?php $slug = convert_vi_to_en($product->name)  ?>

<meta property="fb:app_id" content="1626145747637990"/>
<meta property="fb:admins" content="100004204570992"/>
<meta property="og:url"           content="{{url('product-details/'.$product->id.'-product-'.$slug.'.html')}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$product->name}}" />
<meta property="og:description"   content="{{$product->description}}" />
<!-- <meta property="og:image"         content="{{asset('upload/product/'.$product->image)}}" /> -->

<div id="fb-root">
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4&appId=481402502038511";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</div>
 <div id="all">
        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="#">
                            <?php
                                foreach($cat as $row){
                                    if($product->category_id==$row->id){
                                        echo "$row->name";
                                    }
                                }
                            ?>
                        </a>
                        </li>
                        <li>{{$product->name}}</li>
                    </ul>

                </div>


                <div class="col-md-10">

                    <div class="row" id="productMain">
                        <div class="col-sm-5">
                            <div id="mainImage">
                                <img src="{{asset('upload/multi-image/'.$img[0]->path)}}" alt="" class="img-responsive" height="678">
                            </div>

                            <?php if($product->status){
                            
                            ?>
                                <!-- <div class="ribbon sale">
                                    <div class="theribbon">{{$product->status}}</div>
                                    <div class="ribbon-background"></div>
                                </div> -->
                            <?php 
                                }
                            ?>
                            <h1></h1>
                            <div class="row" id="thumbs">
                                <center>
                                    @foreach($img as $image)
                                    <div class="col-xs-3">
                                        <a href="{{asset('upload/multi-image/'.$image->path)}}" class="thumb">
                                            <img src="{{asset('upload/multi-image/'.$image->path)}}" alt="" class="img-responsive">
                                        </a>
                                    </div>
                                    @endforeach
                                </center>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="box">
                                <h1 class="text-center" style="color:green">{{$product->name}}</h1>
                               
                                <p class="text-center">Mã SP: <span class="required"><strong>{{$product->SKU}}</strong><span></p>
                                <hr>
                                <p><em>{{$product->promotion}}</em></p>
                                
                                <p class="price" style="color:red"><strong>{{price_formate( $product->price )}} VND</strong></p>
                                <form class="form-horizontal" action="{{asset('add-cart/'.$product->id.'/1.html')}}">
                                <div class="col-sm-6">
                                    Màu sắc: <select class="form-control" name="color">
                                            <option value="">select...</option>
                                        @foreach($mapColor as $col)
                                            <option value="{{$col->color_id}}" class="form-control"><?php 
                                                foreach ($color as $colors) {
                                                    # code...
                                                    if($colors->id ==$col->color_id){
                                                        echo $colors->name;
                                                    }
                                                }
                                            ?></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    Size: <select class="form-control" name="size">
                                            <option value="">select...</option>
                                        @foreach($mapSize as $sizes)
                                            <option value="{{$sizes->size_id}}" class="form-control"><?php 
                                                foreach ($size as $key) {
                                                    # code...
                                                    if($key->id==$sizes->size_id){
                                                        echo $key->name;
                                                    }
                                                }
                                            ?>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <h4> &nbsp; &nbsp; &nbsp;</h4>
                                <p class="text-center buttons">
                                    <?php 
                                        if($product->quantity==0){

                                    ?>
                                        <a href="" class="btn btn-default"><i class="fa fa-heart"></i>Hết hàng</a>
                                    <?php
                                        }
                                        else{
                                    ?>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                    <a href="" class="btn btn-default"><i class="fa fa-heart"></i>Còn hàng</a>
                                    <?php } ?>
                                    <!-- <div class="fb-like"></div> -->
                                    <center><div class="fb-share-button" data-href="{{url('product-details/'.$product->id.'-product-'.$slug.'.html')}}" data-layout="button_count"></div>
                                    </center>


                                </p>
                            </form>


                            </div>

                        </div>
                        
                    </div>
                    
                    <div class="box" id="details">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#info">Thông tin</a></li>
                            <li><a data-toggle="tab" href="#comment">Đánh Giá (<?php echo $count; ?> )</a></li>
                            <!-- <li><a data-toggle="tab" href="#facebook"> Facebook Comment </a></li> -->
                        </ul>

                        <div class="tab-content">
                            <div id="info" class="tab-pane fade in active">
                                <p>
                                    <h1>Thông tin sản phẩm</h1>
                                    <?php echo $product->description ?>

                                    <hr>
                                    <div class="social">
                                        <h4>Show it to your friends</h4>
                                        <p>
                                            <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                            <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                                            <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                                            <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                                        </p>
                                    </div>
                                </p>
                            </div>
                            <div id="comment" class="tab-pane fade">
                                @foreach($review as $showreview)
                                  <div class="review-item clearfix" id="post_displays">
                                    <div class="review-item-submitted">
                                      <h4><strong><?php echo $showreview->name ?></strong></h4>
                                      <div class="text-muted"><em><?php echo $showreview->created_at ?></em></div>
                                      <div class="rateit" data-rateit-value="<?php echo $showreview->ratting; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                    </div>

                                    <div class="text-info">
                                        <h5><p><?php echo $showreview->content; ?></p></h5>
                                        <?php
                                      if(isset(Auth::user()->role_id)){
                                        if(Auth::user()->role_id == 1){
                                          echo ("<a href='" . Asset('del-review'). "/" . $showreview->id .  "'>Xóa bình luận</a>");
                                        }
                                      }else{
                                        echo ("");
                                      }
                                    ?>
                                          
                                    </div>
                                  </div>

                                @endforeach  
                                  <!-- BEGIN FORM-->
                                  <?php echo  Form::open(array('url' => URL::to('review-product/'.$product['id'].'/1.html'))) ; ?>   
                             
                                    <h2>Write a review</h2>

                                    <?php

                                      if(isset(Auth::user()->email)){
                                        $name   = Auth::user()->name;
                                        $email  = Auth::user()->email; 
                                      }else{
                                        $name   = "";
                                        $email  = "";
                                      }

                                    ?>

                                    <div class="form-group">
                                      <label for="name">Name <span class="required">*</span></label>
                                      <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Email</label>
                                      <input type="text" class="form-control" name="email" id="email" value="<?php echo $email ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="review">Review <span class="required">*</span></label>
                                      <textarea class="form-control" name="content" rows="8" id="review"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Rating</label>
                                      <input type="range" name="rating" value="88" step="0.25" id="backing5">
                                      <div class="rateit" data-rateit-backingfld="#backing5" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                                      </div>
                                    </div>
                                    <div class="padding-top-20">                  
                                      <button type="submit" class="btn btn-primary" id="btn_submit">Send</button>
                                    </div>
                                  <?php echo  Form::close() ; ?> 
                                </form>
                            </div>
                            <!-- <div id="facebook" class="tab-pane fade">
                                <p>
                                    
                                    <div class="fb-comments" data-href="{{url('product-details/'.$product->id.'-product-'.$slug.'.html')}}" data-numposts="10"></div>
                                    
                                </p>
                            </div> -->
                        </div>
                        <div id="facebook" >
                                <p>
                                    
                                    <div class="fb-comments" data-href="{{url('product-details/'.$product->id.'-product-'.$slug.'.html')}}" data-width="850" data-numposts="10"></div>
                                    <!-- <div class="fb-comments" data-href="{{url('product-details/'.$product->id.'-product-'.$slug.'.html')}}" data-numposts="10"></div> -->
                                </p>
                            </div>
                    </div>

                    <script type="text/javascript">
                        $('document').ready(function() {
                            $("#btn_submit").click(function(){
                                var form = $('#review');
                                var data = form.serialize();
                                $.ajax(
                                    {url: "'review-product/'.$product['id'].'/1.html'",
                                    data: data,
                                    type:"POST",
                                    success: function(result){
                                    $("#post_displays").prepend(result);
                                }});

                            });
                        });

                    </script>
                                        

                    <div class="row same-height-row">
                        <div class="col-md-2 col-sm-6">
                            
                                <div class="box same-height">
                                    <h3 style="color:green">Sản phẩm tương tự</h3>
                                </div>
                            
                        </div>
                        <?php foreach($relative as $row){
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