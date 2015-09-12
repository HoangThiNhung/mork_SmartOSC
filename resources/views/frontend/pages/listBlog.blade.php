@extends('frontend.layouts.default')
@include ('frontend.includes.format')
@section('content')
    @section('title')
        Tin tức
    @endsection

<div id="all">

        <div id="content">
            <div class="container">
                <!-- *** LEFT COLUMN ***
		     _________________________________________________________ -->

                <div class="col-sm-9" id="blog-listing">

                    <ul class="breadcrumb">

                        <li><a href="#">Home</a>
                        </li>
                        <li>Blog listing</li>
                    </ul>


                    <div class="box">

                        <h1>Tin tức mới nhất</h1>
                        
                    </div>

                    <div class="post">
                        <?php foreach($news as $new){
                            $slug = convert_vi_to_en($new->title);
                            ?>
                        <div class="box">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2><a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}">{{$new->title}}</a></h2>
                                    <p class="author-category">By <a href="#"><?php 
                                        foreach($author as $auth){
                                            if($auth->id==$new->author_id)
                                                echo $auth->name;
                                        }
                                    ?></a>
                                    </p>
                                    <hr>
                                    <p class="date-comments">
                                        <a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}"><i class="fa fa-calendar-o"></i> {{$new->created_at}}</a>
                                    </p>
                                    <p class="intro"><em>{{$new->description}}</em></p>
                                    <p class="read-more"><a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}" class="btn btn-primary">Continue reading</a>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <div class="image">
                                        <a href="{{url('news/'.$new->id.'-'.$slug.'.html')}}">
                                            <img src="{{asset('upload/news/'.$new->image)}}" class="img-responsive" alt="Example blog post alt">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                       
                    </div>
                    <center>{!! $news->render() !!}</center>

                </div>
                <!-- /.col-md-9 -->

                <!-- *** LEFT COLUMN END *** -->


                <div class="col-md-3">
                    <!-- *** BLOG MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Blog</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="blog.html">About us</a>
                                </li>
                                <li class="active">
                                    <a href="blog.html">Fashion</a>
                                </li>
                                <li>
                                    <a href="blog.html">News and gossip</a>
                                </li>
                                <li>
                                    <a href="blog.html">Design</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** BLOG MENU END *** -->

                    <div class="banner">
                        <a href="#">
                            <img src="{{asset('assets/frontend/img/banner.jpg')}}" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop