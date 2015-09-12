@extends('frontend.layouts.default')
@include ('frontend.includes.format')
@section('content')
    @section('title')
        {{$post->title}}
    @endsection
<div id="all">

        <div id="content">
            <div class="container">

                <div class="col-sm-12">

                    <ul class="breadcrumb">

                        <li><a href="index.html">Home</a>
                        </li>
                        <li><a href="{{url('news')}}">Tin tức</a>
                        </li>
                        <li>{{$post->title}}</li>
                    </ul>
                </div>
                <div class="col-md-3">

                    <div class="panel panel-default sidebar-menu">

                        @include('frontend.includes.sidebar')

                    </div>

                    <div class="banner">
                        <a href="#">
                            <img src="{{asset('assets/frontend/img/banner.jpg')}}" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>
                

                <div class="col-sm-6" id="blog-post">


                    <div class="box">

                        <h1>{{$post->title}}</h1>
                        <p class="author-date">By 
                            <a href="#"><?php 
                                        foreach($auth as $author){
                                            if($author->id==$post->author_id)
                                                echo $author->name;
                                        } ?> 
                            </a> | {{$post->created_at}}</p>
                        
                        <div id="post-content">
                            <?php echo $post->content ?>
                        </div>
                        <!-- /#post-content -->
                        <div class="box">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#xemthem">Xem thêm</a></li>
                                <li><a data-toggle="tab" href="#comment">Binh luan (<?php echo $count; ?> )</a></li>
                            </ul>
                            <div class="tab-content">
                                    <div id ="xemthem" class="tab-pane fade in active"S>
                                         <?php foreach($news as $new){
                                            $slug = convert_vi_to_en($new->title);
                                        ?>
                                        <div class="news">
                                            <a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}">{{$new->title}}</a>
                                        </div>


                                        <?php } ?>
                                        <center><p class="read-more"><a href="{{url('news')}}" class="btn btn-default">xem thêm</a>
                                                </p>
                                        </center>
                                    </div>
                                    <div id="comment" class="tab-pane fade">
                                        <div id="comments" data-animate="fadeInUp">

                                            @foreach($review as $showreview)
                                            <div class="col-sm-3 col-md-2 text-center-xs">
                                                <p>
                                                    <img src="{{asset('assets/frontend/img/blog-avatar2.jpg')}}" class="img-responsive img-circle" alt="">
                                                </p>
                                            </div>
                                            <div class="col-sm-9 col-md-10">
                                                <div class="row comment">
                                                    <a href="#"><h5>{{$showreview->name}}</h5></a>
                                                    <p class="posted"><i class="fa fa-clock-o"></i> {{$showreview->created_at}}</p>
                                                    <p><em>{{$showreview->content}}</em></p>
                                                    <?php
                                                      if(isset(Auth::user()->role_id)){
                                                        if(Auth::user()->role_id == 1){
                                                          echo ("<a href='" . Asset('del-review-news'). "/" . $showreview->id .  "'>Xóa bình luận</a>");
                                                        }
                                                      }else{
                                                        echo ("");
                                                      }
                                                    ?>
                                                </div>
                                            </div>
                                            @endforeach
                                            <!-- /.comment -->

                                        </div>
                                        <!-- /#comments -->

                                        <div id="comment-form" data-animate="fadeInUp">

                                            <h4>Leave comment</h4>

                                            <?php echo  Form::open(array('url' => URL::to('review-news/'.$post['id'].'/1.html'))) ; ?>
                                            <?php

                                                      if(isset(Auth::user()->email)){
                                                        $name   = Auth::user()->name;
                                                        $email  = Auth::user()->email; 
                                                      }else{
                                                        $name   = "";
                                                        $email  = "";
                                                      }

                                                    ?>
                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="name">Name <span class="required">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="email">Email <span class="required">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="comment">Comment <span class="required">*</span>
                                                            </label>
                                                            <textarea class="form-control" id="comment" rows="4" name="content"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-comment-o"></i> Post comment</button>
                                                    </div>
                                                </div>


                                            <?php echo Form::close() ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- /#comment-form -->

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /#blog-post -->

                <div class="col-sm-3">
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Tin tức khác</h3>
                        </div>

                        <div class="panel-body">

                            <?php foreach($news as $new){
                                $slug = convert_vi_to_en($new->title);
                            ?>
                            <div class="box">
                                <div class="row">
                                    <div class="image">
                                        <a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}">
                                            <img src="{{asset('upload/news/'.$new->image)}}" class="img-responsive" alt="{{$new->title}}">
                                        </a>
                                    </div>
                                    <h4><center><a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}">{{$new->title}}</a></center></h4>
                                    <p class="author-category">By <a href="#"><em><?php 
                                        foreach($auth as $author){
                                            if($author->id==$new->author_id)
                                                echo $author->name;
                                        }
                                    ?></em></a>
                                    </p>
                                    <hr>
                                    <p class="date-comments">
                                        <a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}"><i class="fa fa-calendar-o"></i> {{$new->created_at}}</a>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <center><p class="read-more"><a href="{{url('news')}}" class="btn btn-default">xem thêm</a>
                        </p></center>

                    </div>
                </div>


            </div>
            <!-- /.container -->
        </div>
    </div>
@stop